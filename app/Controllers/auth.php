<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $AuthModel;
    protected $db;
    public function __construct()
    {
        $this->AuthModel = new AuthModel($this->db);
        $this->db = \Config\Database::connect();
    }
    public function Login()
    {
        $data = [
            'title' => "Login"
        ];

        // if (session('id_user')) {
        //     return redirect()->to(base_url('/dashboard/index'));
        // }
        return view('/pages/auth/login', $data);
    }

    public function cek_login_admin()
    {
        // Validasi dan pengecekan login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cek = $this->AuthModel->cek_login_admin($email, $password);

        if ($cek) {
            // Jika login berhasil
            session()->set('log', true);
            session()->set('id_user', $cek['id_user']);
            session()->set('nama_user', $cek['nama_user']);
            session()->set('Unit', $cek['Unit']);
            session()->set('email', $cek['email']);
            session()->set('password', $cek['password']);
            session()->set('level', $cek['level']);
            session()->set('role', $cek['role']);

            $level = $cek['level'];
            if ($level == '1') {
                return redirect()->to(base_url('/dashboard_admin/index'));
            }
            return redirect()->to(base_url('/dashboard/index'));
        } else {
            // Jika login gagal
            session()->setFlashdata('error', 'Username / Password Salah'); // Menyimpan pesan kesalahan
            return redirect()->to(base_url('/auth/login'));
        }
    }
    // public function logout()
    // {
    //     session()->remove('log');
    //     session()->remove('id_user');
    //     session()->remove('nama_user');
    //     session()->remove('Unit');
    //     session()->remove('email');
    //     session()->remove('password');
    //     session()->remove('level');
    //     session()->remove('role');
    //     session()->setFlashdata('pesan', 'Logout sukses');
    //     return redirect()->to(base_url('/'));
    // }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/landingpage/index'));
    }
}
