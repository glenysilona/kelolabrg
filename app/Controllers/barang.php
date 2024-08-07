<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\StokInModel;

class Barang extends BaseController
{
    protected $BarangModel;
    protected $SatuanModel;
    protected $StokInModel;
    protected $db;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->StokInModel = new StokInModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {

        $data = [
            'title' => "Barang",
            'barang' => $this->BarangModel->getAll(),

        ];
        return view('/pages/barang/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => "Insert Barang",
            'satuanbrg' => $this->SatuanModel->findAll()
        ];
        return view('/pages/barang/create', $data);
    }
    public function save()
    {
        $id = $this->request->getVar('id');
        $nama = $this->request->getVar('nama');
        $harga = $this->request->getVar('harga');
        $keterangan = $this->request->getVar('keterangan');
        $satuid = $this->request->getVar('satuid');

        $ceknamabarang = $this->BarangModel->where('nama', $nama)->first();
        if ($ceknamabarang) {
            session()->setFlashdata('pesan', 'Data Barang Gagal ditambahkan Boss, karena data barang sudah ada');
            return  redirect()->to('/pages/barang/create');
        }

        $data = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'keterangan' => $keterangan,
            'satuid' => $satuid,


        ];
        if ($this->BarangModel->insert($data)) {
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan Boss');
        } else {
            session()->setFlashdata('pesan', 'Data Gagal ditambahkan Boss, karena barang sudah ada');
            return redirect()->to('/pages/barang/create');
        }
        return redirect()->to('/pages/barang/index');
    }
    public function delete($id)
    {
        $this->BarangModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus boss');
        return redirect()->to('/pages/barang/index');
    }
    public function edit($id)
    {
        $data = [
            'title' => "Edit Data Barang",
            'barang' => $this->BarangModel->getbarang($id),
            'nama_satuan' => $this->BarangModel->Allsatuanbrg()
        ];
        return view('/pages/barang/edit', $data);
    }
    public function update($id)
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'keterangan' => $this->request->getVar('keterangan'),
            'satuid' => $this->request->getVar('satuid'),

        ];

        // Lakukan query untuk mencari data berdasarkan kode_barang
        $barang = $this->BarangModel->where('id', $id)->first();

        if ($barang) {
            // Update data dengan menggunakan data yang baru
            $this->BarangModel->update($barang['id'], $data);
            session()->setFlashdata('pesan', 'Data berhasil diupdate.');
        } else {
            session()->setFlashdata('pesan', 'Data tidak ditemukan.');
        }

        return redirect()->to('/pages/barang/index');
    }
}
