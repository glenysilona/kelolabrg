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
                <h1 class="mt-3" colspan="3">LAPORAN BARANG MASUK</h1>
                Periode : <?= $tglawal . " s/d " . $tglakhir; ?>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Masuk</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Total</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1;
                        foreach ($datalaporan as $row) : ?>
                            <tr>
                                <td><?= $nomor++ ?></td>
                                <td><?= $row['id_stokin'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td><?= $row['nama_satuan'] ?></td>
                                <td>Rp. <?= number_format($row['qty'] * $row['harga'], 0, ',', '.') ?></td>
                                <td><?= $row['tglmasuk'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>