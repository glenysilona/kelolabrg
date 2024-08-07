<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\BagianModel;
use App\Models\AjukanBrgModel;

class AjukanBrg extends BaseController
{
    protected $BarangModel;
    protected $SatuanModel;
    protected $BagianModel;
    protected $AjukanBrgModel;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->BagianModel = new BagianModel();
        $this->AjukanBrgModel = new AjukanBrgModel();
    }

    public function index()
    {
        $getajukanbrgall = $this->AjukanBrgModel->getajukanbrgall();
        $data = [
            'title' => 'Ajukan Barang',
            'ajukanbrg' => $getajukanbrgall
        ];
        return view('/pages/ajukanbrg/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => "Insert Ajukan Barang",
            'barang' => $this->AjukanBrgModel->getallbarang(),
            'satuanbrg' => $this->SatuanModel->findAll(),
            'bagian' => $this->BagianModel->findAll()
        ];
        return view('/pages/ajukanbrg/create', $data);
    }
    public function save()
    {
        $id_ajukan = $this->request->getVar('id_ajukan');
        $id_bagian = $this->request->getVar('id_bagian');
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $satuid = $this->request->getVar('satuid');
        $tgl_ajukan = $this->request->getVar('tgl_ajukan');
        $alasan = $this->request->getVar('alasan');

        $data = [
            'id_ajukan' => $id_ajukan,
            'id_bagian' => $id_bagian,
            'id' => $id,
            'qty' => $qty,
            'satuid' => $satuid,
            'tgl_ajukan' => $tgl_ajukan,
            'alasan' => $alasan
        ];

        if ($this->AjukanBrgModel->insert($data)) {
            session()->setFlashdata('pesan', 'Data Berhasil diajukan');
        } else {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
        }
        return redirect()->to('/ajukanbrg/index');
    }
    public function getSatuanByBarangId($id)
    {
        $barang = $this->BarangModel->find($id);
        $satuan = $this->SatuanModel->find($barang['satuid']); // misalkan ada relasi antara barang dan satuan
        return $this->response->setJSON($satuan);
    }
    public function edit($id_ajukan)
    {
        $data = [
            'title' => 'Edit Data Ajukan Barang',
            'ajukanbrg' => $this->AjukanBrgModel->getajukan($id_ajukan),
            'barang' => $this->AjukanBrgModel->getallbarang(),
            'satuanbrg' => $this->AjukanBrgModel->getAllSatuan(),
            'bagian' => $this->AjukanBrgModel->getallbagian()
        ];
        return view('/pages/ajukanbrg/edit', $data);
    }
    public function update($id_ajukan)
    {
        $id_bagian = $this->request->getVar('id_bagian');
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $alasan = $this->request->getVar('alasan');
        $ajukanbrg = $this->AjukanBrgModel->where('id_ajukan', $id_ajukan)->first();
        $data = [
            'id_ajukan' => $id_ajukan,
            'id_bagian' => $id_bagian,
            'id' => $id,
            'qty' => $qty,
            'alasan' => $alasan
        ];
        if ($ajukanbrg) {
            $this->AjukanBrgModel->update($id_ajukan, $data);
            session()->setFlashdata('pesan', 'Data Berhasil diupdate');
        } else {
            session()->setFlashdata('pesan', 'Data gagal diupdate');
        }
        return redirect()->to('/ajukanbrg/index');
    }
    public function delete($id_ajukan)
    {
        $ajukanbrg = $this->AjukanBrgModel->where('id_ajukan', $id_ajukan)->first();
        if ($ajukanbrg) {
            $this->AjukanBrgModel->delete($id_ajukan);
            session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        } else {
            session()->setFlashdata('pesan', 'Data Gagal Dihapus, Mungkin Ada Masalah');
        }
        return redirect()->to('/ajukanbrg/index');
    }
}
