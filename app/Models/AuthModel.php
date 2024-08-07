<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user'; // Tentukan nama tabel

    public function cek_login_admin($email, $password)
    {
        return $this->db->table($this->table)
            ->where([
                'email' => $email,
                'password' => $password
            ])->get()->getRowArray();
    }
}
