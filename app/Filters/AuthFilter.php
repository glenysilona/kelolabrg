<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->uri->getPath();

        // Jika URI mengarah ke guest area atau landing page, tidak perlu login
        if (strpos($uri, 'guest') !== false || strpos($uri, 'landingpage') !== false || strpos($uri, 'permintaan') !== false || strpos($uri, 'barang') !== false || strpos($uri, 'ajukanbrg') !== false) {
            return;
        }

        // Memeriksa apakah pengguna telah login
        if (!session()->get('log')) {
            // Cek apakah pengguna mengakses halaman admin
            if (strpos($uri, 'dashboard_admin') !== false) {
                session()->setFlashdata('pesan', 'Silahkan Login Terlebih Dahulu');
            }
            return redirect()->to(base_url('/landingpage/index'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $uri = $request->uri->getPath();

        // Memeriksa level pengguna dan mengarahkan sesuai, tetapi tidak di halaman login
        if (session()->get('log')) {
            $level = session()->get('level' == '1');
            if ($level == '1' && strpos($uri, 'dashboard_admin') === false) {
                return redirect()->to(base_url('/dashboard_admin/index'));
            }
        }
    }
}
