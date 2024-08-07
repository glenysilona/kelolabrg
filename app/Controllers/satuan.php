<?php

namespace App\Controllers;

use App\Models\SatuanModel;
use App\Models\BarangModel;

class Satuan extends BaseController
{
    protected $SatuanModel;
    protected $BarangModel;
    public function __construct()
    {
        $this->SatuanModel = new SatuanModel();
        $this->BarangModel = new BarangModel();
    }
    public function index()
    {
        $satuanbrg = $this->SatuanModel->findAll();
        $data = [
            'title' => "Satuan",
            'satuanbrg' => $satuanbrg
        ];

        return view('/pages/satuan/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => "Insert Satuan",
        ];
        return view('/pages/satuan/create', $data);
    }
    public function save()
    {

        $satuid = $this->request->getVar('satuid');
        $nama_satuan = $this->request->getVar('nama_satuan');
        //periksa nama satuan
        $ceknamasatuan = $this->SatuanModel->where('nama_satuan', $nama_satuan)->first();
        if ($ceknamasatuan) {
            session()->setFlashdata('pesan', 'Data Gagal ditambahkan, karena sudah ada Boss');
            return redirect()->to('/pages/satuan/create');
        }

        $data = [
            'satuid' => $satuid,
            'nama_satuan' => $nama_satuan,

        ];
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan boss');
        $this->SatuanModel->insert($data);

        return redirect()->to('/pages/satuan/index');
    }
    public function delete($satuid)
    {
        $this->SatuanModel->delete($satuid);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus boss');
        return redirect()->to('/pages/satuan/index');
    }
    public function edit_satuan($satuid)
    {
        $data = [
            'title' => "Edit Data Satuan",
            'satuanbrg' => $this->SatuanModel->getsatuan($satuid)
        ];
        return view('/pages/satuan/edit_satuan', $data);
    }
    public function update($satuid)
    {
        $data = [
            'nama_satuan' => $this->request->getVar('nama_satuan'),

        ];

        // Lakukan query untuk mencari data berdasarkan kode_barang
        $satuanbrg = $this->SatuanModel->where('satuid', $satuid)->first();

        if ($satuanbrg) {
            // Update data dengan menggunakan data yang baru
            $this->SatuanModel->update($satuanbrg['satuid'], $data);
            session()->setFlashdata('pesan', 'Data berhasil diupdate.');
        } else {
            session()->setFlashdata('pesan', 'Data tidak ditemukan.');
        }

        return redirect()->to('/pages/satuan/index');
    }
}
