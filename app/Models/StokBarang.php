<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarang extends Model
{
    protected $table = 'barangmasuk';


    protected $primaryKey = "kode_barang";
    protected $allowedFields = ['kode_barang', 'nama_barang', 'jumlah', 'harga', 'total', 'keterangan', 'tanggal', 'satuid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getbarangmasuk($kode_barang)
    {
        // Mengambil data barang masuk berdasarkan kode barang
        return $this->where('kode_barang', $kode_barang)->first();
    }
    public function AllData()
    {
        //join tabel
        return $this->db->table('barangmasuk')
            ->join('satuanbrg', 'satuanbrg.satuid = barangmasuk.satuid', 'left')
            ->get()->getResultArray();
    }
    public function Allsatuanbrg()
    {
        return $this->db->table('satuanbrg')
            ->Get()->getResultArray();
    }
    function getAll()
    {

        $builder = $this->db->table('barangmasuk');
        $builder->join('satuanbrg', 'satuanbrg.satuid = barangmasuk.satuid');
        $query = $builder->get();
        return $query->getResult();
    }
}
