<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = "kode_pengajuan";
    protected $allowedFields = ['kode_barang', 'qty', 'tanggal', 'id', 'satuid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getpengajuan($kode_pengajuan)
    {
        return $this->where('kode_pengajuan', $kode_pengajuan)->first();
    }
    public function getallbarang()
    {
        return $this->db->table('barang')->Get()->getResultArray();
    }
    public function getpengajuanall()
    {
        $builder = $this->db->table('pengajuan');
        $builder->select('pengajuan.*, barang.nama AS nama, barang.harga AS harga, satuanbrg.nama_satuan AS nama_satuan'); // Pilih kolom yang dibutuhkan, termasuk kolom 'nama' dari tabel 'barang' dan 'satuan'
        $builder->join('barang', 'barang.id = pengajuan.id'); // Lakukan join dengan tabel 'barang'
        $builder->join('satuanbrg', 'satuanbrg.satuid = pengajuan.satuid'); // Lakukan join dengan tabel 'satuan'
        $query   = $builder->get();
        return $query->getResult();
    }
    public function updateStatus($kodePengajuan, $statusPengajuan)
    {
        // Debug: lihat data yang akan diupdate
        error_log("Update Kode Pengajuan: $kodePengajuan, Status Pengajuan: $statusPengajuan");

        return $this->update($kodePengajuan, ['status_pengajuan' => $statusPengajuan]);
    }
    public function updatePengajuan($kodePengajuan, $data)
    {
        return $this->db->table('pengajuan')->where('kode_pengajuan', $kodePengajuan)->update($data);
    }
}
