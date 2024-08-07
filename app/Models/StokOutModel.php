<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class StokOutModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = "id_minta";
    protected $allowedFields = ['id_minta', 'tglminta', 'uraian', 'qty', 'id', 'id_status', 'id_user', 'satuid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getpermintaan($id_minta)
    {
        return $this->where('id_minta', $id_minta)->first();
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
    public function getpermintaanByUserId($id_user)
    {
        if (session()->get('level') != '1') {
            return $this->db->table('permintaan')
                ->where('id_user', $id_user)
                ->get()
                ->getResult();
        }
    }
    public function laporanperperiode($tglawal, $tglakhir)
    {
        $builder = $this->db->table('permintaan');
        $builder->select('permintaan.*, barang.nama, satuanbrg.nama_satuan, barang.harga, bagian.nama_bagian, bagian.ketua_bagian '); // Pilih kolom yang dibutuhkan, termasuk kolom 'nama' dari tabel 'barang' dan 'satuan'
        $builder->join('barang', 'barang.id = permintaan.id');
        $builder->join('satuanbrg', 'satuanbrg.satuid = permintaan.satuid');
        $builder->join('bagian', 'bagian.id_bagian = permintaan.id_bagian');
        $builder->where('permintaan.tglminta >=', $tglawal);
        $builder->where('permintaan.tglminta <=', $tglakhir);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTotalStokOutPeriode($tglawal, $tglakhir)
    {
        return $this->select('id, SUM(qty) as total_out') // Memilih field `id_barang` dan jumlah total `qty` sebagai `total_out`.
            ->where('tglminta >=', $tglawal) // Menentukan kondisi tanggal keluar mulai dari $tglawal.
            ->where('tglminta <=', $tglakhir) // Menentukan kondisi tanggal keluar hingga $tglakhir.
            ->groupBy('id') // Mengelompokkan hasil berdasarkan `id_barang`.
            ->findAll(); // Mengambil semua hasil yang sesuai.
    }
}
