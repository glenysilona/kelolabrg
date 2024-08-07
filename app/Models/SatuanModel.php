<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table = 'satuanbrg';
    protected $primaryKey = "satuid";
    protected $allowedFields = ['satuid', 'nama_satuan'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getsatuan($satuid)
    {
        return $this->where('satuid', $satuid)->first();
    }
    public function getAllSatuan()
    {
        return $this->findAll();
    }
}
