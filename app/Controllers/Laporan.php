<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\StokInModel;
use App\Models\StokOutModel;
use App\Models\SatuanModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PermintaanModel;

class Laporan extends BaseController
{
    protected $BarangModel;
    protected $PermintaanModel;
    protected $StokInModel;
    protected $StokOutModel;
    public function __construct()
    {
        $this->PermintaanModel = new PermintaanModel();
        $this->BarangModel = new BarangModel();
        $this->StokInModel = new StokInModel();
        $this->StokOutModel = new StokOutModel();
    }

    public function index()
    {
        $permintaan_all = $this->PermintaanModel->getpermintaanall();
        $data = [
            'title' => 'Laporan',
            'permintaan' => $permintaan_all
        ];
        return view('/pages/laporan/index', $data);
    }
    public function cetakstokin()
    {
        $data = [
            'title' => 'Cetak Stok Masuk',
        ];
        return view('/pages/laporan/cetakstokin', $data);
    }
    public function cetak_stok_in_periode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');
        $StokInModel = new StokInModel();

        $datalaporan = $StokInModel->laporanperperiode($tglawal, $tglakhir);

        $data = [
            'datalaporan' => $datalaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,

        ];

        return view('/pages/laporan/cetakstokinperperiode', $data);
    }
    public function cetakstokout()
    {
        $data = [
            'title' => 'Cetak Stok Keluar',
        ];
        return view('/pages/laporan/cetakstokout', $data);
    }
    public function cetak_laporan_periode_stok_out()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');
        $StokOutModel = new StokOutModel();
        $datalaporanstokout = $StokOutModel->laporanperperiode($tglawal, $tglakhir);
        $data = [
            'datalaporanstokout' => $datalaporanstokout,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];
        return view('/pages/laporan/cetakstokoutperperiode', $data);
    }
    public function cetaksisabarang()
    {
        $data = [
            'title' => 'Cetak Sisa Barang',
        ];
        return view('/pages/laporan/cetaksisabarang', $data);
    }
    public function laporanSisaBarang()
    {
        $tglawal = $this->request->getPost('tglawal'); // Mendapatkan tanggal awal dari request POST.
        $tglakhir = $this->request->getPost('tglakhir'); // Mendapatkan tanggal akhir dari request POST.

        // Mengambil total stok masuk dan keluar berdasarkan periode
        $stokInData = $this->StokInModel->getTotalStokInPeriode($tglawal, $tglakhir);
        $stokOutData = $this->StokOutModel->getTotalStokOutPeriode($tglawal, $tglakhir);
        $barangData = $this->BarangModel->findAll(); // Mengambil semua data barang.

        $stokIn = [];
        $stokOut = [];

        // Mengisi array $stokIn dengan data stok masuk
        foreach ($stokInData as $item) {
            $stokIn[$item['id']] = $item['total_in'];
        }

        // Mengisi array $stokOut dengan data stok keluar
        foreach ($stokOutData as $item) {
            $stokOut[$item['id']] = $item['total_out'];
        }

        $stokAkhir = [];

        // Menghitung stok akhir untuk setiap barang
        foreach ($barangData as $barang) {
            $id_barang = $barang['id'];
            $stokMasuk = isset($stokIn[$id_barang]) ? $stokIn[$id_barang] : 0; // Jika tidak ada stok masuk, set ke 0.
            $stokKeluar = isset($stokOut[$id_barang]) ? $stokOut[$id_barang] : 0; // Jika tidak ada stok keluar, set ke 0.
            $stokAkhirValue = $stokMasuk - $stokKeluar ? $stokMasuk - $stokKeluar : 0; // Menghitung stok akhir
            $StokAkhirNegatif = $stokKeluar - $stokMasuk;
            $JumlahSisa = $barang['jumlah'];

            // Jika tidak ada stok masuk dan stok keluar, gunakan stok awal dari tabel barang.
            if ($stokMasuk == 0 && $stokKeluar == 0) {
                $stokAkhirValue = $barang['jumlah'];
            }

            if ($stokAkhirValue <= 0) {
                $StokAkhirNegatif; // jika hasilnya negatif 
            }

            $stokAkhir[$id_barang] = [
                'nama' => $barang['nama'],
                'stok_in' => $stokMasuk,
                'stok_out' => $stokKeluar,
                'stok_akhir' => $stokAkhirValue,
                'JumlahSisa' => $JumlahSisa,

            ];
        }

        // Mempersiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Laporan Sisa Barang',
            'stokAkhir' => $stokAkhir,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        return view('/pages/laporan/cetaksisabarangperperiode', $data); // Menampilkan view dengan data yang sudah dipersiapkan.
    }
}
