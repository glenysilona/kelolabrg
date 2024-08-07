<?php

namespace App\Models;

use CodeIgniter\Model;

class AjukanBrgModel extends Model
{
    protected $table = 'ajukanbrg';
    protected $primaryKey = "id_ajukan";
    protected $allowedFields = ['id_ajukan', 'id', 'qty', 'alasan', 'tgl_ajukan', 'status', 'satuid', 'id_bagian'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getajukan($id_ajukan)
    {
        return $this->where('id_ajukan', $id_ajukan)->first();
    }
    //memanggil dari join tabel
    public function getajukanbrgall()
    {
        $builder = $this->db->table('ajukanbrg');
        $builder->select('ajukanbrg.*, barang.nama AS nama, satuanbrg.nama_satuan AS nama_satuan, bagian.nama_bagian AS nama_bagian'); // Pilih kolom yang dibutuhkan, termasuk kolom 'nama' dari tabel 'barang' dan 'satuan'
        $builder->join('barang', 'barang.id = ajukanbrg.id'); // Lakukan join dengan tabel 'barang'
        $builder->join('satuanbrg', 'satuanbrg.satuid = ajukanbrg.satuid'); // Lakukan join dengan tabel 'satuan'
        $builder->join('bagian', 'bagian.id_bagian = ajukanbrg.id_bagian'); //lakukan join dengan tabel bagian
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
    public function getallbagian()
    {
        return $this->db->table('bagian')->get()->getResultArray();
    }
}
