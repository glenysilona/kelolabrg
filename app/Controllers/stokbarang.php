<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\SatuanModel;

class StokBarang extends BaseController
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


        return view('/pages/stokbarang', $data);
    }


    public function delete($kode_barang)
    {
        $this->BarangMasukModel->delete($kode_barang);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus Boss');
        return redirect()->to('/pages/barangmasuk');
    }


    public function getAll()
    {

        $builder = $this->db->table('barangmasuk');
        $builder->join('satuanbrg', 'satuanbrg.satuid = barangmasuk.satuid', 'left');
        return $builder->get()->getResultArray();
    }
}
