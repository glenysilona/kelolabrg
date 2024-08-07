<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentitasDiriModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = "id_user";
    protected $allowedFields = ['id_user', 'nama_user', 'Unit', 'email', 'password', 'level', 'role'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getuser($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
