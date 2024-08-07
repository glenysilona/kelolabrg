<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use App\Models\BarangModel;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = "id_minta";
    protected $allowedFields = ['id_minta', 'tglminta', 'uraian', 'qty', 'id', 'satuid', 'nama_penerima', 'id_bagian', 'status'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $BarangModel;
    protected $db;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->BarangModel = new BarangModel();
    }
    public function getpermintaan($id_minta)
    {
        return $this->db->table($this->table)
            ->where('id_minta', $id_minta)
            ->get()
            ->getRowArray();
    }

    public function getpermintaanall()
    {
        $builder = $this->db->table('permintaan');
        $builder->select('permintaan.*, barang.nama AS nama, satuanbrg.nama_satuan AS nama_satuan, bagian.nama_bagian AS nama_bagian, bagian.ketua_bagian AS ketua_bagian'); // Pilih kolom yang dibutuhkan, termasuk kolom 'nama' dari tabel 'barang' dan 'satuan'
        $builder->join('barang', 'barang.id = permintaan.id'); // Lakukan join dengan tabel 'barang'
        $builder->join('satuanbrg', 'satuanbrg.satuid = permintaan.satuid'); // Lakukan join dengan tabel 'satuan'
        $builder->join('bagian', 'bagian.id_bagian = permintaan.id_bagian');
        $query   = $builder->get();
        return $query->getResult();
    }
    public function getallbarang()
    {
        return $this->db->table('barang')->Get()->getResultArray();
    }
    //agar bisa akses semua isi tabel satuan
    public function getallsatuan()
    {
        return $this->db->table('satuanbrg')->get()->getResultArray();
    }
    //join tabel dengan status
    public function getjoinallstatusExceptPending()
    {
        $builder = $this->db->table('vertifikasi_minta');
        $builder->where('id_status !=', 0); // Mengambil status kecuali "Menunggu Konfirmasi"
        $query = $builder->get();
        return $query->getResult();
    }
    public function updateStatus($id_minta, $id_status)
    {
        // Ambil data permintaan dari database berdasarkan ID
        $permintaan = $this->find($id_minta);

        // Pastikan $permintaan bukan null
        if ($permintaan) {
            // Perbarui status permintaan
            $permintaan['id_status'] = $id_status;

            // Simpan perubahan ke database
            $this->save($permintaan);
        } else {
            // Handle kasus ketika entri tidak ditemukan
            // Contoh: throw exception, log pesan error, atau tampilkan pesan kepada pengguna
        }
    }
    // PermintaanModel.php

    // public function getPermintaanByUserId($id_user)
    // {
    //     // Ambil data permintaan berdasarkan ID pengguna
    //     return $this->where('id_user', $id_user)->findAll();
    // }
    public function getalluser()
    {
        $builder = $this->db->table('user');
        $query = $builder->get();
        return $query->getResult();
    }
    // Dalam model PermintaanModel.php
    public function getAllPermintaanWithUserInfo()
    {
        // Lakukan join antara tabel permintaan dan user untuk mendapatkan informasi pengguna
        $builder = $this->db->table('permintaan');
        $builder->select('permintaan.*, user.id_user, user.email'); // Pilih kolom-kolom yang Anda perlukan dari tabel pengguna
        $builder->join('user', 'user.id_user = permintaan.id_user');
        $query = $builder->get();

        return $query->getResult();
    }
    public function getNamaUserById($id_user)
    {
        // Lakukan kueri untuk mengambil nama pengguna dari tabel 'user' berdasarkan 'id_user'
        $user = $this->db->table('user')->select('nama_user')->where('id_user', $id_user)->get()->getRow();

        // Periksa apakah pengguna ditemukan
        if ($user) {
            // Jika ditemukan, kembalikan nama pengguna
            return $user->nama_user;
        } else {
            // Jika tidak ditemukan, kembalikan null atau pesan yang sesuai
            return null; // atau "Nama Pengguna Tidak Ditemukan"
        }
    }

    public function add_permintaan($post)
    {
        $id = isset($post['id']) ? $post['id'] : null;
        if (!$id) {
            return false;
        }
        $qty = $post['qty'];

        $data = [

            'uraian' => isset($post['uraian']) ? $post['uraian'] : null,
            'satuid' => isset($post['satuid']) ? $post['satuid'] : null,
            'tglminta' => isset($post['tglminta']) ? $post['tglminta'] : null,
            'nama_penerima' => isset($post['nama_penerima']) ? $post['nama_penerima'] : null,
            'qty' => isset($post['qty']) ? $post['qty'] : null,
            'id_bagian' => isset($post['id_bagian']) ? $post['id_bagian'] : null,
            'id' => $id,

        ];

        if ($this->insert($data)) {
            session()->setFlashdata('pesan', 'Berhasil Mengajukan Barang, Silahkan ambil di ruangan UM');
            session()->setFlashdata('warnaalert', 'success');
        } else {
            session()->setFlashdata('pesan', 'Gagal Mengajukan Barang');
            session()->setFlashdata('warnaalert', 'danger');
        }

        return redirect()->to('/permintaan/index');
    }
    public function delete_minta($id_minta)
    {
        $this->db->table($this->table)
            ->where('id_minta', $id_minta)
            ->delete();
    }
    public function getBarangById($id)
    {
        return $this->db->table('barang')->where('id', $id)->get()->getRowArray();
    }
    public function updateBarangStok($id, $stokBaru)
    {
        return $this->db->table('barang')->where('id', $id)->update(['jumlah' => $stokBaru]);
    }
    public function updatePermintaan($kodepermintaan, $data)
    {
        return $this->db->table('permintaan')->where('id_minta', $kodepermintaan)->update($data);
    }
}
