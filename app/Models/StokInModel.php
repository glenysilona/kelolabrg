<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\BarangModel;
use App\Models\SatuanModel;

class StokInModel extends Model
{
    protected $table = 'stok_masuk';
    protected $primaryKey = "id_stokin";
    protected $allowedFields = ['id_stokin', 'jumlah', 'tglmasuk', 'id', 'qty', 'satuid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $BarangModel;
    protected $SatuanModel;
    // Constructor
    public function __construct()
    {
        parent::__construct();
        // Inisialisasi objek database
        $this->db = \Config\Database::connect();
        // Inisialisasi model BarangModel
        $this->BarangModel = new BarangModel();
        $this->SatuanModel = new SatuanModel();
    }

    // Mengambil data stok masuk berdasarkan ID
    public function getstokin($id_stokin)
    {
        return $this->where('id_stokin', $id_stokin)->first();
    }
    // Menghapus data stok masuk berdasarkan ID
    public function del($id)
    {
        if (!empty($id)) {
            $stok_masuk = $this->where('id_stokin', $id)->first();

            if (!empty($stok_masuk) && is_array($stok_masuk)) {
                $qty = $stok_masuk['qty'];

                // Menghapus data stok masuk
                $this->where('id_stokin', $id)->delete();

                $id = $stok_masuk['id'];
                // Memperbarui stok keluar di tabel barang
                $this->BarangModel->update_stock_in_delete(['id' => $id, 'qty' => $qty]);
            } else {
                return false;
            }
        }
    }

    // Mengambil semua data barang
    public function getAllbarang()
    {
        return $this->db->table('barang')->get()->getResultArray();
    }
    //mengambil data semua satuan
    public function getAllsatuan()
    {
        return $this->db->table('satuanbrg')->get()->getResultArray();
    }
    // Join dengan tabel barang untuk mengambil semua data stok masuk
    function getAll()
    {
        $builder = $this->db->table('stok_masuk');
        $builder->join('barang', 'barang.id = stok_masuk.id');
        $builder->join('satuanbrg', 'satuanbrg.satuid = stok_masuk.satuid');
        $query = $builder->get();
        return $query->getResult();
    }

    // Menambahkan data stok masuk baru
    public function add_stok_in($post)
    {
        $id = isset($post['id']) ? $post['id'] : null;
        if (!$id) {
            return false;
        }

        $data = [
            'tglmasuk' => isset($post['tglmasuk']) ? $post['tglmasuk'] : null,
            'qty' => isset($post['qty']) ? $post['qty'] : null,
            'satuid' => isset($post['satuid']) ? $post['satuid'] : null,
            'id' => $id
        ];

        // Memasukkan data stok masuk baru ke dalam tabel
        if ($this->insert($data)) {
            session()->setFlashdata('pesan', 'Stok Berhasil ditambahkan Boss');
        } else {
            session()->setFlashdata('pesan', 'Gagal Menambahkan Stok, Sepertinya ada masalah boss');
        }
    }

    public function laporanperperiode($tglawal, $tglakhir)
    {
        $builder = $this->db->table('stok_masuk');
        $builder->select('stok_masuk.*, barang.nama, barang.harga, barang.keterangan, satuanbrg.nama_satuan');
        $builder->join('barang', 'barang.id = stok_masuk.id');
        $builder->join('satuanbrg', 'satuanbrg.satuid = stok_masuk.satuid');
        $builder->where('stok_masuk.tglmasuk >=', $tglawal);
        $builder->where('stok_masuk.tglmasuk <=', $tglakhir);
        $query = $builder->get();
        return $query->getResultArray();
    }
    //total tiap barang yang masuk
    public function getTotalStokInPeriode($tglawal, $tglakhir)
    {
        return $this->select('id, SUM(qty) as total_in') // Memilih field `id_barang` dan jumlah total `qty` sebagai `total_in`.
            ->where('tglmasuk >=', $tglawal) // Menentukan kondisi tanggal masuk mulai dari $tglawal.
            ->where('tglmasuk <=', $tglakhir) // Menentukan kondisi tanggal masuk hingga $tglakhir.
            ->groupBy('id') // Mengelompokkan hasil berdasarkan `id_barang`.
            ->findAll(); // Mengambil semua hasil yang sesuai.
    }
}
