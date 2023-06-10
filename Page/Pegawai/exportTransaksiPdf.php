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
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <!-- Page Title -->
        <title><?= $reportTransactionText  . ' (PDF)' ?></title>
        <!-- Favicon -->
        <link rel='icon' type='image/x-icon' href='../../Image/Assets/perpus-icon.png' />
        <!-- External CSS -->
        <link rel='stylesheet' type='text/css' href='../styles.css' />
        <!-- Google Font API -->
        <link rel='preconnect' href='https://fonts.googleapis.com' />
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
        <link href='https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet' />
    </head>
    <body>
        <center>
            <!-- Container -->
            <div style='width:100%'>
                <!-- Title -->
                <h1><?= $reportTransactionText; ?></h1>
                <!-- Table -->
                <table class='table-pdf'>
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
                            <tr style='background-color:lightgray'>
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
        </center>
    </body>
</html>

<!-- Print to PDF -->
<script>window.print()</script>