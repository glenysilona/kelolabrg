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
                <h1 class="mt-3" colspan="3">Berita Acara Opname Fisik Barang Persediaan</h1>
                Periode :
                <?= $tglawal ?> - <?= $tglakhir ?>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok Masuk</th>
                        <th>Stok Keluar</th>
                        <th>Sisa Akhir</th>
                        <th>Jumlah Stok Keseluruhan</th>

                    </tr>
                    <?php foreach ($stokAkhir as $barang) : ?>
                        <tr>
                            <td><?= $barang['nama'] ?></td>
                            <td><?= $barang['stok_in'] ?></td>
                            <td><?= $barang['stok_out'] ?></td>
                            <td><?= $barang['stok_akhir'] ?></td>
                            <td><?= $barang['JumlahSisa'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>