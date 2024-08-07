<?php

namespace App\Controllers;

use App\Models\BarangModel;

class LandingPage extends BaseController
{

    public function index()
    {
        $data = [
            "title" => "Landing Page",
        ];
        return view('/pages/landingpage/index', $data);
    }
    public function pilihansesuairole()
    {
        $data = [
            "title" => "Pilih Sesuai Role"
        ];
        return view('/pages/landingpage/pilihansesuairole', $data);
    }
}
