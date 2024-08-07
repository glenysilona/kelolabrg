<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\BagianModel;

class Permintaan extends BaseController
{
    protected $PermintaanModel;
    protected $BarangModel;
    protected $SatuanModel;
    protected $BagianModel;
    protected $db;
    public function __construct()
    {
        $this->PermintaanModel = new PermintaanModel();
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->BagianModel = new BagianModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        // Mendapatkan semua data permintaan
        $permintaan_all = $this->PermintaanModel->getpermintaanall();
        // Menyimpan data ke dalam array
        $data = [
            'title' => " Stok Out / Permintaan",
            'permintaan' => $permintaan_all, // Semua data pengajuan

        ];

        return view('/pages/permintaan/index', $data);
    }
    public function create($id_minta = null)
    {
        $data = [
            'title' => "Insert Permintaan",
            'permintaan' => $this->PermintaanModel->getpermintaan($id_minta),
            'barang' => $this->PermintaanModel->getallbarang(),
            'satuanbrg' => $this->SatuanModel->findAll(),
            'bagian' => $this->BagianModel->findAll()
        ];
        return view('/pages/permintaan/create', $data);
    }

    public function edit($id_minta)
    {
        $data = [
            'title' => "Edit Data Permintaan",
            'permintaan' => $this->PermintaanModel->getpermintaan($id_minta),
            'barang' => $this->PermintaanModel->getallbarang(),

        ];
        return view('/pages/permintaan/edit', $data);
    }
    public function update($id_minta)
    {
        // Ambil data permintaan yang lama sebelum diupdate
        $permintaanLama = $this->PermintaanModel->where('id_minta', $id_minta)->first();
        $qtyLama = $permintaanLama['qty'];
        $idBarangLama = $permintaanLama['id'];

        // Data baru dari form input
        $dataBaru = [
            'tglminta' => $this->request->getVar('tglminta'),
            'uraian' => $this->request->getVar('uraian'),
            'qty' => $this->request->getVar('qty'),
            'id' => $this->request->getVar('id'),
        ];

        // hitung selisih jumlah barang
        $qtyBaru = $dataBaru['qty'];
        $selisihQty = $qtyBaru - $qtyLama;

        // ambil stok barang baru saat ini
        $barangBaru = $this->PermintaanModel->getBarangById($dataBaru['id']); //  ada method untuk ambil barang berdasarkan id
        $stokLamaBaru = $barangBaru['jumlah'];
        $stokBaruBaru = $stokLamaBaru - $selisihQty;

        // periksa apakah stok baru valid (tidak kurang dari 0)
        if ($stokBaruBaru < 0) {
            session()->setFlashdata('pesan', 'Update jumlah permintaan melebihi stok yang tersedia.');
            return redirect()->to('/permintaan/edit/' . $id_minta);
        }

        // update data permintaan
        $updatepermintaan = $this->PermintaanModel->find($id_minta);
        if ($updatepermintaan) {
            // update permintaan
            if ($this->PermintaanModel->update($id_minta, $dataBaru)) {
                // jika ID barang berubah kembalikan stok barang lama dan kurangi stok barang baru
                if ($idBarangLama != $dataBaru['id']) {
                    $barangLama = $this->PermintaanModel->getBarangById($idBarangLama);
                    if ($barangLama) {
                        $this->BarangModel->tambahStok($idBarangLama, $qtyLama); // kembalikan stok barang lama
                    }
                    $this->BarangModel->kurangiStok($dataBaru['id'], $qtyBaru); // kurangi stok barang baru
                } else {
                    // jika ID barang tidak berubah, hanya hitung selisih
                    $selisih = $qtyBaru - $qtyLama;
                    if ($selisih > 0) {
                        $this->BarangModel->kurangiStok($dataBaru['id'], $selisih);
                    } else if ($selisih < 0) {
                        $this->BarangModel->tambahStok($dataBaru['id'], abs($selisih));
                    }
                }
                session()->setFlashdata('pesan', 'Data Berhasil diupdate');
            } else {
                session()->setFlashdata('error', 'Gagal mengupdate data permintaan. Coba lagi nanti.');
            }
            return redirect()->to('/permintaan/index');
        }
    }

    // proses sisa barang setelah ajukan
    public function proses()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['in_add_minta'])) {
            $post = $this->request->getPost();

            // ambil jumlah stok saat ini dari model barang
            $barang = $this->BarangModel->find($post['id']);
            $jumlah = $barang['jumlah'];
            $qty = $post['qty'];
            //cek apabila habis jumlahnya akan muncul alert
            if ($jumlah == 0) {
                session()->setFlashdata('pesan', 'Maaf Barang tersebut habis dan sedang dalam proses pembelian, Silahkan Isi Form Ajukan Barang');
                session()->setFlashdata('warnaalert', 'danger');
                return redirect()->to('/ajukanbrg/create');
            }
            // cek apakah jumlah yang diminta melebihi stok yang tersedia
            if ($qty > $jumlah) {
                // tampilkan pesan kesalahan jika jumlah yang diminta melebihi stok
                session()->setFlashdata('pesan', 'Jumlah barang yang diminta melebihi stok yang tersedia.');
                session()->setFlashdata('warnaalert', 'danger');
                return redirect()->to('/ajukanbrg/create');
            }

            // lanjutkan proses insert jika stok mencukupi
            $this->PermintaanModel->add_permintaan($post);
            $this->BarangModel->update_permintaan($post);


            return redirect()->to('/permintaan/index');
        }
    }

    public function permintaan_del($id_minta, $id)
    {
        $permintaan = $this->PermintaanModel->getpermintaan($id_minta);
        $qty = $permintaan['qty'];


        // menghapus data permintaan
        $this->PermintaanModel->delete_minta($id_minta);

        // memperbarui jumlah stok di tabel barang
        $this->BarangModel->update_jumlah_barang(['qty' => $qty, 'id' => $id]);

        // memeriksa apakah operasi berhasil
        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data Stok Masuk Berhasil Dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data stok masuk');
        }

        // redirect ke halaman yang sesuai
        return redirect()->to('/permintaan/index');
    }

    public function getSatuanByBarangId($id)
    {
        $barang = $this->BarangModel->find($id);
        $satuan = $this->SatuanModel->find($barang['satuid']); // misalkan ada relasi antara barang dan satuan
        return $this->response->setJSON($satuan);
    }
    public function konfirmasi()
    {
        // Mendapatkan data dari form
        $kodepermintaan = $this->request->getVar('id_minta');
        $statuspermintaan = $this->request->getVar('status');

        // Debugging: Periksa apakah data diterima dengan benar
        error_log("Id Minta: " . $kodepermintaan);
        error_log("Status : " . $statuspermintaan);

        // Cek apakah data kosong
        if (empty($kodepermintaan) || empty($statuspermintaan)) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Update status pengajuan
        $data = [
            'status' => $statuspermintaan,
        ];

        if ($this->PermintaanModel->updatePermintaan($kodepermintaan, $data)) {
            // Set flashdata untuk notifikasi sukses
            session()->setFlashdata('pesan', 'Status pengajuan berhasil diperbarui Boss.');
        } else {
            // Set flashdata untuk notifikasi error
            session()->setFlashdata('error', 'Gagal memperbarui status pengajuan Boss. Sepertinya ada Masalah.');
        }

        // Redirect kembali ke halaman pengajuan
        return redirect()->to('/permintaan/index');
    }
}
