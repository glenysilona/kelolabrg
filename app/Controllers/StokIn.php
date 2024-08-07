<?php

namespace App\Controllers;

use App\Models\StokInModel;
use App\Models\BarangModel;
use App\Models\SatuanModel;

class StokIn extends BaseController
{
    protected $StokInModel;
    protected $BarangModel;
    protected $SatuanModel;
    protected $db;
    public function __construct()
    {
        $this->StokInModel = new StokInModel();
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data = [
            'title' => "Stok In",
            'stok_masuk' => $this->StokInModel->getAll(),

        ];

        return view('/pages/stokin/index', $data);
    }
    public function tambah($id_stokin = null)

    {
        $data = [
            'title' => "Tambah Barang Masuk",
            'stok_masuk' => $this->StokInModel->getstokin($id_stokin),
            'barang' => $this->StokInModel->getAllbarang(),
            'satuanbrg' => $this->StokInModel->getAllsatuan(),
        ];
        return view('/pages/stokin/tambah', $data);
    }
    public function save()
    {
        $id_stokin = $this->request->getVar('id_stokin');
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $tglmasuk = $this->request->getVar('tglmasuk');

        $data = [
            'id_stokin' => $id_stokin,
            'id' => $id,
            'qty' => $qty,
            'tglmasuk' => $tglmasuk
        ];

        if ($this->StokInModel->insert($data)) {

            session()->setFlashdata('pesan', 'Stok Berhasil ditambahkan boss');
        } else {
            session()->setFlashdata('error', 'Stok Gagal ditambahkan boss');
        }

        // Simpan flash data sebelum melakukan pengalihan
        return redirect()->to('/pages/stokin/index');
    }

    public function stokin_del($id_stokin, $id)
    {
        // Memulai transaksi
        $this->db->transBegin();

        // Mengambil nilai qty dari stok masuk
        $stok_masuk = $this->StokInModel->getstokin($id_stokin);
        if (!$stok_masuk) {
            // Jika stok masuk tidak ditemukan, batalkan transaksi
            $this->db->transRollback();
            return redirect()->to('/pages/stokin/index')->with('error', 'Stok masuk tidak ditemukan');
        }
        $qty = $stok_masuk['qty'];

        // Mengurangi jumlah barang di tabel barang
        $data = ['qty' => $qty, 'id' => $id];
        $result = $this->BarangModel->update_stock_in_delete($data);

        if ($result) {
            // Menghapus data stok masuk
            $this->StokInModel->del($id_stokin);

            if ($this->StokInModel->affectedRows() > 0) {
                // Commit transaksi jika semua operasi berhasil
                $this->db->transCommit();
            } else {
                // Rollback transaksi jika ada kegagalan dalam penghapusan stok masuk
                $this->db->transRollback();
                return redirect()->to('/pages/stokin/index')->with('error', 'Gagal menghapus data stok masuk');
            }
        } else {
            // Rollback transaksi jika pengurangan stok gagal
            $this->db->transRollback();
            return redirect()->to('/pages/stokin/index')->with('error', 'Stok tidak mencukupi untuk dikurangi');
        }

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->to('/pages/stokin/index')->with('success', 'Data stok masuk berhasil dihapus');
    }
    //membuat ootmatis sesuai dari identitas barang
    public function getSatuanByBarangId($id)
    {
        $barang = $this->BarangModel->find($id);
        $satuan = $this->SatuanModel->find($barang['satuid']); // Misalkan ada relasi antara barang dan satuan
        return $this->response->setJSON($satuan);
    }
    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['in_add'])) {
            $post = $this->request->getPost();
            $this->StokInModel->add_stok_in($post);
            $this->BarangModel->update_stock_in($post);
            if ($this->StokInModel->affectedRows() > 0 && $this->BarangModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data Stok Masuk Berhasil Ditambahkan');
            }
            return redirect()->to('/pages/stokin/index');
        }
    }
}
