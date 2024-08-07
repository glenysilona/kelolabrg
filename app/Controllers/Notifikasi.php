<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Notifikasi extends BaseController
{
    protected $BarangModel;
    protected $db;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->db = \Config\Database::connect();
    }

    // Di dalam NotificationController
    public function checkStockNotification()
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->findAll(); // Ambil semua data barang

        $notificationHTML = ''; // Inisialisasi variabel notifikasi HTML

        foreach ($barang as $item) {
            if ($item['jumlah'] <= 5) {
                // Jika stok barang kurang dari atau sama dengan 5, tambahkan notifikasi
                $notificationHTML .= '<li class="notification-item stok-notification">
                                        <i class="bi bi-exclamation-circle text-warning"></i>
                                        <div>
                                            <h4>' . ' Sisa ' . ' Stok ' . $item['nama'] . '</h4>
                                            <p>' . $item['nama'] . ' tinggal ' . $item['jumlah'] . '. Silakan ajukan pembelian.</p>
                                        </div>
                                    </li>';
            }
        }

        // Kembalikan notifikasi HTML
        return $notificationHTML;
    }
    public function jumlahnotif()
    {
        // Ambil data item dari suatu sumber (misalnya dari database)
        $barang = $this->db->query('SELECT * FROM barang')->getResultArray();

        // Hitung jumlah notifikasi yang sesuai kriteria
        $jumlahNotifikasi = 0;

        // Lakukan penghitungan notifikasi sesuai kebutuhan
        foreach ($barang as $item) {
            if ($item['jumlah'] <= 5) {
                // Jika stok barang kurang dari atau sama dengan 5, tambahkan ke jumlah notifikasi
                $jumlahNotifikasi++;
            }
        }

        // Mengembalikan jumlah notifikasi dalam format JSON
        return json_encode(['count' => $jumlahNotifikasi]);
    }
}
