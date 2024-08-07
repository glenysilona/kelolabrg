<?php

namespace App\Controllers;

use App\Models\StokoutModel;
use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\PermintaanModel;

class StokOut extends BaseController
{
    protected $StokOutModel;
    protected $BarangModel;
    protected $SatuanModel;
    protected $PermintaanModel;
    public function __construct()
    {
        $this->StokOutModel = new StokOutModel();
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->PermintaanModel = new PermintaanModel();
    }
    public function index()
    {

        // mendapatkan semua data permintaan
        $permintaan_all = $this->StokOutModel->getpermintaanall();


        // menyimpan data ke dalam array
        $data = [
            'title' => "Stok Out",
            'permintaan' => $permintaan_all, // Semua data pengajuan

        ];

        return view('/pages/stokout/index', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => "Insert Borang Barang",
            'barang' => $this->BarangModel->findAll(),
            'satuanbrg' => $this->SatuanModel->findAll()
        ];
        return view('/pages/permintaan/create', $data);
    }
    public function proses()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['in_add_minta'])) {
            $post = $this->request->getPost();

            // Ambil jumlah stok saat ini dari model barang
            $barang = $this->BarangModel->find($post['id']);
            $jumlah = $barang['jumlah'];
            $qty = $post['qty'];

            // Cek apakah jumlah yang diminta melebihi stok yang tersedia
            if ($qty > $jumlah) {
                // Tampilkan pesan kesalahan jika jumlah yang diminta melebihi stok
                session()->setFlashdata('pesan', 'Jumlah barang yang diminta melebihi stok yang tersedia.');
                session()->setFlashdata('warnaalert', 'danger');
                return redirect()->to('/permintaan/create');
            } else if ($jumlah == 0) {
                session()->setFlashdata('pesan', 'Maaf Barang tersebut habis dan sedang dalam proses pembelian');
                session()->setFlashdata('warnaalert', 'danger');
                return redirect()->to('/permintaan/create');
            }

            // Lanjutkan proses insert jika stok mencukupi
            $this->PermintaanModel->add_permintaan($post);
            $this->BarangModel->update_permintaan($post);

            // if ($this->PermintaanModel->affectedRows() > 0 && $this->BarangModel->affectedRows() > 0) {
            //     session()->setFlashdata('success', 'Data Stok Masuk Berhasil Ditambahkan');
            // } else {
            //     session()->setFlashdata('error', 'Gagal Menambahkan Data Stok Masuk');
            // }

            return redirect()->to('/permintaan/index');
        }
    }
    public function edit($id_minta)
    {
        $data = [
            'title' => "Edit Data Permintaan",
            'permintaan' => $this->StokOutModel->getpermintaan($id_minta),
            'nama' => $this->StokOutModel->getallbarang()
        ];
        return view('/pages/permintaan/edit', $data);
    }
    public function update($id_minta)
    {
        $data = [
            'tglminta' => $this->request->getVar('tglminta'),
            'uraian' => $this->request->getVar('uraian'),
            'qty' => $this->request->getVar('qty'),
            'id' => $this->request->getVar('id'),
        ];
        $permintaan = $this->StokOutModel->where('id_minta', $id_minta)->first();
        if ($permintaan) {
            $this->StokOutModel->update($permintaan['id_minta'], $data);
            session()->setFlashdata('pesan', 'Data Berhasil diupdate');
        } else {
            $errors = $this->StokOutModel->errors();
            session()->setFlashdata('pesan', 'Something went Wrong' . $errors);
            session()->setFlashdata('warnaalert', 'danger');
        }
        return redirect()->to('/permintaan/index');
    }

    public function delete($id_minta)
    {
        $this->StokOutModel->delete($id_minta);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus boss');
        return redirect()->to('/permintaan/index');
    }
}
