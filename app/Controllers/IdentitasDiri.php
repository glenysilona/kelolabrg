<?php

namespace App\Controllers;

use App\Models\IdentitasDiriModel;

class IdentitasDiri extends BaseController
{
    protected $IdentitasDiriModel;
    public function __construct()
    {

        $this->IdentitasDiriModel = new IdentitasDiriModel();
    }

    public function index()
    {
        $session = session();
        $userid = $session->get('id_user');

        $userdata = $this->IdentitasDiriModel->find($userid);
        $data = [
            'title' => 'Identitas Diri Pegawai',
            'user' => $userdata
        ];
        return view('/pages/identitas/index', $data);
    }
    public function edit()
    {
        $session = session();
        $userid = $session->get('id_user');
        $userdata = $this->IdentitasDiriModel->find($userid);
        $data = [
            'title' => 'Edit Identitas Diri',
            'user' => $userdata

        ];

        return view('/pages/identitas/edit', $data);
    }
    public function update()
    {
        $session = session();
        $userid = $session->get('id_user');
        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'notelp' => $this->request->getVar('notelp'),
        ];

        $this->IdentitasDiriModel->update($userid, $data);
        session()->setFlashdata('success', 'Data Berhasil diupdate');
        return redirect()->to('/identitas/index');
    }
}
