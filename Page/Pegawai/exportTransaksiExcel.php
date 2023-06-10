<!-- Import Code Files -->
<?php
    require_once '../connect.php';
    require_once '../variable.php';
?>

<!-- Get Selected Peminjaman Data -->
<?php
    $query = "SELECT * FROM peminjaman 
              INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
              INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
              INNER JOIN pegawai_perpustakaan ON peminjaman.id_pegawai = pegawai_perpustakaan.id_pegawai";
    $data  = $conn->prepare($query);
    $data->execute();

    // Convert to excel (.xls)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="laporan-transaksi-excel.xls"');
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
    </head>
    <body>
        <!-- Container -->
        <div>
            <!-- Title -->
            <h1><?= $reportTransactionText; ?></h1>
            <!-- Table -->
            <table>
                <!-- Column Title -->
                <thead>
                    <tr>
                        <th><?= $userNameText; ?></th>
                        <th><?= $bookNameText;?></th>
                        <th><?= $adminNameText; ?></th>
                        <th><?= $transactionPickText; ?></th>
                        <th><?= $transactionReturnText; ?></th>
                        <th><?= str_replace('Sedang Pinjam', 'Status', $transactionStatusText);?></th>
                    </tr>
                </thead>
                <!-- Column Data -->
                <tbody>
                    <?php foreach ($data as $td) : ?>
                        <tr>
                            <td><?= $td['nama_anggota'] ?></td>
                            <td><?= $td['judul_buku'] ?></td>
                            <td><?= $td['nama_pegawai'] ?></td>
                            <td><?= $td['tgl_pinjam'] ?></td>
                            <td><?= $td['tgl_kembali'] ?></td>
                            <td><?= $td['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>