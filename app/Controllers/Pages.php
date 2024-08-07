<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\PengajuanModel;
use App\Models\SatuanModel;


class Pages extends BaseController
{
    protected $BarangMasukModel;
    protected $PengajuanModel;
    protected $SatuanModel;
    public function __construct()
    {
        $this->BarangMasukModel = new BarangMasukModel();
        $this->PengajuanModel = new PengajuanModel();
        $this->SatuanModel = new SatuanModel();
    }



    public function barangkeluar()
    {
        $data = [
            'title' => "Barang Keluar",
        ];

        return view('/pages/barangkeluar', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Insert Barang Masuk",
        ];
        return view('/barangmasuk/create', $data);
    }
    // public function save()
    // {
    //     $this->BarangMasukModel->save([
    //         'kode_barang' => $this->request->getVar('kode_barang'),
    //         'nama_barang' => $this->request->getVar('nama_barang'),
    //         'jumlah' => $this->request->getVar('jumlah'),
    //         'harga' => $this->request->getVar('harga'),
    //         'total' => $this->request->getVar('total'),
    //         'keterangan' => $this->request->getVar('keterangan'),
    //         'tanggal' => $this->request->getVar('tanggal'),
    //     ]);
    //     return redirect()->to('/barangmasuk');
    // }

}
