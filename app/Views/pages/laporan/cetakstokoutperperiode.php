<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk</title>
</head>

<body>
    <table class="table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center;" border="1" cellpadding="10">
        <tr>
            <td>
                <h1 class="mt-3" colspan="3">LAPORAN BARANG KELUAR</h1>
                Periode : <?= $tglawal . " s/d " . $tglakhir; ?>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Keluar</th>
                            <th>Asal Unit</th>
                            <th>Ketua Unit</th>
                            <th>Nama Penerima</th>
                            <th>Jenis Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Uraian</th>
                            <th>Satuan</th>
                            <th>Total</th>
                            <th>Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1;
                        foreach ($datalaporanstokout as $row) : ?>
                            <tr>
                                <td><?= $nomor++ ?></td>
                                <td><?= $row['id_minta'] ?></td>
                                <td><?= $row['nama_bagian'] ?></td>
                                <td><?= $row['ketua_bagian'] ?></td>
                                <td><?= $row['nama_penerima'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td><?= $row['uraian'] ?></td>
                                <td><?= $row['nama_satuan'] ?></td>
                                <td>Rp. <?= number_format($row['qty'] * $row['harga'], 0, ',', '.') ?></td>
                                <td><?= $row['tglminta'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>