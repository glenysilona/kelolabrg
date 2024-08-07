<?php

namespace App\Controllers;


class dashboard_admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Dashboard",
        ];
        return view('/pages/dashboard_admin/index', $data);
    }
}
