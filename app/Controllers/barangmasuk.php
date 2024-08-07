<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\SatuanModel;

class BarangMasuk extends BaseController
{
    protected $BarangMasukModel;
    protected $SatuanModel;
    protected $db;
    function __construct()
    {
        $this->BarangMasukModel = new BarangMasukModel();
        $this->SatuanModel = new SatuanModel();
        $this->db = \Config\Database::connect();
    }
    public function Alldata()
    {
        return $this->db->table('barangmasuk')
            ->join('satuanbrg', 'satuanbrg.satuid = barangmasuk.satuid')->Get()->getResultArray();
    }
    public function index()
    {


        // Panggil metode getSatuanWithBarangMasuk() dari model BarangMasukModel


        $data = [
            'title' => "Barang Masuk",
            'barangmasuk' => $this->BarangMasukModel->getAll(),

        ];


        return view('/pages/barangmasuk/index', $data);
    }
    public function create()
    {

        $data = [
            'title' => "Insert Barang Masuk",
            'satuanbrg' => $this->SatuanModel->findAll()
        ];
        return view('/pages/barangmasuk/create', $data);
    }
    public function save()
    {

        $kode_barang = $this->request->getVar('kode_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $jumlah = $this->request->getVar('jumlah');
        $harga = $this->request->getVar('harga');
        $total = $this->request->getVar('total');
        $keterangan = $this->request->getVar('keterangan');
        $tanggal = $this->request->getVar('tanggal');
        $satuid = $this->request->getVar('satuid');

        $data = [
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'total' => $total,
            'keterangan' => $keterangan,
            'tanggal' => $tanggal,
            'satuid' => $satuid
        ];
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan Boss');
        $this->BarangMasukModel->insert($data);

        return redirect()->to('/pages/barangmasuk/index');
    }
    public function delete($kode_barang)
    {
        $this->BarangMasukModel->delete($kode_barang);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus Boss');
        return redirect()->to('/pages/barangmasuk/index');
    }
    public function edit_masuk($kode_barang)
    {

        $data = [
            'title' => "Edit Data Barang Masuk",
            'barangmasuk' => $this->BarangMasukModel->getbarangmasuk($kode_barang),
            'nama_satuan' => $this->BarangMasukModel->Allsatuanbrg()

        ];
        return view('/pages/barangmasuk/edit_masuk', $data);
    }
    public function update($kode_barang)
    {
        $dataToUpdate = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
            'total' => $this->request->getVar('total'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal' => $this->request->getVar('tanggal'),
            'satuid' => $this->request->getVar('satuid')
        ];

        // Lakukan query untuk mencari data berdasarkan kode_barang
        $barangmasuk = $this->BarangMasukModel->where('kode_barang', $kode_barang)->first();

        if ($barangmasuk) {
            // Update data dengan menggunakan data yang baru
            $this->BarangMasukModel->update($barangmasuk['kode_barang'], $dataToUpdate);
            session()->setFlashdata('pesan', 'Data berhasil diupdate Boss');
        } else {
            session()->setFlashdata('pesan', 'Data tidak ditemukan.');
        }

        return redirect()->to('/pages/barangmasuk/index');
    }
    public function getAll()
    {

        $builder = $this->db->table('barangmasuk');
        $builder->join('satuanbrg', 'satuanbrg.satuid = barangmasuk.satuid', 'left');
        return $builder->get()->getResultArray();
    }
}
