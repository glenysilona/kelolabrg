<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = "id";
    protected $allowedFields = ['id', 'nama', 'harga', 'keterangan', 'jumlah', 'satuid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function getBarangById($id)
    {
        return $this->find($id);
    }

    public function getbarang($id)
    {
        // Mengambil data barang masuk berdasarkan id
        return $this->where('id', $id)->first();
    }
    public function Allsatuanbrg()
    {
        return $this->db->table('satuanbrg')
            ->Get()->getResultArray();
    }
    public function getAll()
    {
        $builder = $this->db->table('barang');
        $builder->join('satuanbrg', 'satuanbrg.satuid = barang.satuid');

        $query = $builder->get();
        return $query->getResult();
    }
    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['id'];
        $sql = "UPDATE `barang` SET `jumlah` = `jumlah` + " . $qty . " WHERE `id` = " . $id;
        $this->db->query($sql);
    }
    function update_stock_in_delete($data)
    {
        if (is_array($data) && array_key_exists('qty', $data) && array_key_exists('id', $data)) {
            $qty = $data['qty'];
            $id = $data['id'];

            // Memeriksa jumlah stok yang ada saat ini
            $sql_check = "SELECT `jumlah` FROM `barang` WHERE `id` = ?";
            $current_stock = $this->db->query($sql_check, [$id])->getRowArray();

            if ($current_stock && $current_stock['jumlah'] >= $qty) {
                // Hanya mengurangi stok jika stok saat ini cukup
                $sql = "UPDATE `barang` SET `jumlah` = `jumlah` - ? WHERE `id` = ?";
                $this->db->query($sql, [$qty, $id]);
                return true;
            } else {
                // Stok tidak cukup untuk dikurangi, tangani sesuai kebutuhan
                return false;
            }
        } else {
            // Tanggapi jika $data tidak sesuai dengan yang diharapkan
            // Misalnya, lempar exception atau tampilkan pesan kesalahan
            return false;
        }
    }
    function update_permintaan($data)
    {
        $qty = $data['qty'];
        $id = $data['id'];
        $sql = "UPDATE `barang` SET `jumlah` = `jumlah` - " . $qty . " WHERE `id` = " . $id;
        $this->db->query($sql);
    }
    public function update_jumlah_barang($data)
    {
        if (is_array($data) && array_key_exists('qty', $data) && array_key_exists('id', $data)) {
            $qty = $data['qty'];
            $id = $data['id'];
            $sql = "UPDATE `barang` SET `jumlah` = `jumlah` + ? WHERE `id` = ?";
            $this->db->query($sql, [$qty, $id]);
        } else {
            // Tanggapi jika $data tidak sesuai dengan yang diharapkan
            // Misalnya, lempar exception atau tampilkan pesan kesalahan di sini.
        }
    }
    public function getStok()
    {
        // Query untuk mengambil jumlah stok dari tabel barang
        $this->selectSum('stok'); // Mengambil total stok dari tabel
        $query = $this->get();

        // Mengembalikan jumlah stok sebagai hasil dari query
        return $query->getRow()->stok;
    }
    public function total_rows()
    {
        // Hitung jumlah baris yang ada dalam tabel barang
        return $this->countAllResults();
    }
    //untuk edit data permintaan
    public function kurangiStok($id, $jumlah)
    {
        $barang = $this->find($id);
        $barang['jumlah'] -= $jumlah;
        return $this->update($id, $barang);
    }

    // Menambah stok barang
    public function tambahStok($id, $jumlah)
    {
        $barang = $this->find($id);
        $barang['jumlah'] += $jumlah;
        return $this->update($id, $barang);
    }
}
