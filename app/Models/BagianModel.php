<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $table = 'bagian';
    protected $primaryKey = "id_bagian";
    protected $allowedFields = ['id_bagian', 'nama_bagian', 'ketua_bagian'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getbagian($id_bagian)
    {
        return $this->where('id_bagian', $id_bagian)->first();
    }
}
