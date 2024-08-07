<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use App\Models\BarangModel;
use App\Models\SatuanModel;

class Pengajuan extends BaseController
{
    protected $PengajuanModel;
    protected $BarangModel;
    protected $SatuanModel;
    protected $db;
    public function __construct()
    {
        $this->PengajuanModel = new PengajuanModel();
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $pengajuanall = $this->PengajuanModel->getpengajuanall();

        $data = [
            'title' => "Pengajuan",
            'pengajuan' => $pengajuanall,
        ];


        return view('/pages/pengajuan/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => "Insert Pengajuan",
            'barang' => $this->PengajuanModel->getallbarang(),
            'satuanbrg' => $this->SatuanModel->findAll()
        ];
        return view('/pages/pengajuan/create', $data);
    }
    public function save()
    {
        $kode_pengajuan = $this->request->getVar('kode_pengajuan');
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $tanggal = $this->request->getVar('tanggal');
        $status_pengajuan = $this->request->getVar('status_pengajuan');
        $satuid = $this->request->getVar('satuid');

        // Mengambil jumlah barang dari tabel barang berdasarkan id
        $barang = $this->BarangModel->find($id);

        // Mengecek apakah jumlah barang 5 atau kurang
        if ($barang && $barang['jumlah'] <= 5) {
            $data = [
                'kode_pengajuan' => $kode_pengajuan,
                'id' => $id,
                'qty' => $qty,
                'tanggal' => $tanggal,
                'status_pengajuan' => $status_pengajuan,
                'satuid' => $satuid
            ];

            if ($this->PengajuanModel->insert($data)) {
                session()->setFlashdata('pesan', 'Data Berhasil ditambahkan Bosss');
            } else {
                session()->setFlashdata('pesan', 'Data tidak ditemukan, sepertinya ada masalah Boss');
            }
        } else {
            session()->setFlashdata('pesan', 'Tidak bisa diajukan, karena jumlah barang lebih dari 5 Bosss');
            return redirect()->to('/pengajuan/create');
        }

        return redirect()->to('/pages/pengajuan/index');
    }
    public function edit_pengajuan($kode_pengajuan)
    {
        $data = [
            'title' => "Edit Data Pengajuan",
            'pengajuan' => $this->PengajuanModel->getPengajuan($kode_pengajuan),
            'barang' => $this->BarangModel->findAll(),


        ];
        return view('/pages/pengajuan/edit_pengajuan', $data);
    }
    public function delete($kode_pengajuan)
    {
        if ($this->PengajuanModel->delete($kode_pengajuan)) {
            session()->setFlashdata('pesan', 'Data Berhasil dihapus Bosss');
        } else {
            session()->setFlashdata('pesan', 'Data tidak ditemukan');
        }
        return redirect()->to('/pages/pengajuan/index');
    }
    public function update($kode_pengajuan)
    {
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $pengajuan = $this->PengajuanModel->where('kode_pengajuan', $kode_pengajuan)->first();
        $data = [
            'id' => $id,
            'qty' => $qty,

        ];
        if ($pengajuan) {
            $this->PengajuanModel->update($kode_pengajuan, $data);
            session()->setFlashdata('pesan', 'Data Berhasil diupdate Boss');
        } else {
            session()->setFlashdata('pesan', 'Data gagal diupdate, Mungkin ada kesalahan boss');
        }
        return redirect()->to('/pages/pengajuan/index');
    }
    public function konfirmasi()
    {
        // Mendapatkan data dari form
        $kodePengajuan = $this->request->getVar('kode_pengajuan');
        $statusPengajuan = $this->request->getVar('status_pengajuan');

        // Debugging: Periksa apakah data diterima dengan benar
        error_log("Kode Pengajuan: " . $kodePengajuan);
        error_log("Status Pengajuan: " . $statusPengajuan);

        // Cek apakah data kosong
        if (empty($kodePengajuan) || empty($statusPengajuan)) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Update status pengajuan
        $data = [
            'status_pengajuan' => $statusPengajuan
        ];

        if ($this->PengajuanModel->updatePengajuan($kodePengajuan, $data)) {
            // Set flashdata untuk notifikasi sukses
            session()->setFlashdata('pesan', 'Status pengajuan berhasil diperbarui Boss.');
        } else {
            // Set flashdata untuk notifikasi error
            session()->setFlashdata('error', 'Gagal memperbarui status pengajuan Boss. Sepertinya ada Masalah.');
        }

        // Redirect kembali ke halaman pengajuan
        return redirect()->to('/pengajuan');
    }
    public function getSatuanByBarangId($id)
    {
        $barang = $this->BarangModel->find($id);
        $satuan = $this->SatuanModel->find($barang['satuid']); // Misalkan ada relasi antara barang dan satuan
        return $this->response->setJSON($satuan);
    }
}
