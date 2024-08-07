<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'vertifikasi_minta';
    protected $primaryKey = "id_status";
    protected $allowedFields = ['id_status', 'keterangan'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getstatus($id_status)
    {
        return $this->where('id_status', $id_status)->first();
    }
}
