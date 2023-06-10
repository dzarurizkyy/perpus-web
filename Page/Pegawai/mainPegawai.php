<!-- Import Code Files -->
<?php
  include '../connect.php';
  include '../variable.php';
?>

<!-- Execute Query MySQL -->
<?php
    // Selected Pegawai Data 
    $query                  = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
    $data                   = $conn->prepare($query);
                              $data->execute();
    $adminSelected          = $data->fetch(PDO::FETCH_LAZY);

    // Transaction History
    $query                  = "SELECT  peminjaman.id_peminjaman,
                                       buku.judul_buku,
                                       anggota.npm_anggota,
                                       peminjaman.tgl_pinjam,
                                       peminjaman.tgl_kembali,
                                       peminjaman.status 
                               FROM peminjaman 
                               LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
                               LEFT JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                               WHERE peminjaman.status = 'Pinjam'";
    $totalTransaction       = $conn->prepare($query);
                              $totalTransaction->execute();
    $transactionData        = $totalTransaction->fetchAll(PDO::FETCH_ASSOC);

    // Transaction Status
    $query                  = "SELECT * FROM peminjaman WHERE status = 'Pinjam'";
    $transactionStatus      = $conn->prepare($query);
                              $transactionStatus->execute();

    // Buku
    $query                  = 'SELECT * FROM buku';
    $totalBook              = $conn->prepare($query);
                              $totalBook->execute();

    // Anggota
    $query                  = 'SELECT * FROM anggota';
    $totalUser              = $conn->prepare($query);
                              $totalUser->execute();
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <!-- Page Title -->
      <title><?= $dashboardPage; ?></title>
      <!-- Favicon -->
      <link rel='icon' type='image/x-icon' href='../../Image/Assets/perpus-icon.png' />
      <!-- External CSS -->
      <link rel='stylesheet' type='text/css' href='../styles.css' />
      <!-- Google Font API -->
      <link rel='preconnect' href='https://fonts.googleapis.com' />
      <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
      <link href='https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet' />
      <link rel='stylesheet' href='https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css' />
      <script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js'></script>
    </head>
    <body>
        <!-- Sidebar -->
        <div class='sidebar'>
            <!-- Web Icon -->
            <a class='sidebar-icon'>
                <img class='sidebar-icon-img' src='../../Image/Assets/perpus-icon.png' />
                <span class='sidebar-icon-text'><?= str_replace('&#8729', '', $webName); ?></span>
            </a>
            <!-- Line Divider -->
            <div class='line-divider'></div>
            <!-- Photo Profile -->
            <div class='sidebar-photo-profile'>
                <img class='photo-profile' src='../../Image/Pegawai/<?= $adminSelected['foto_profil_pegawai']; ?>' />
                <div class='sidebar-username'>
                    <?= strtok($adminSelected['nama_pegawai'], ' '); ?>
                    <div class='sidebar-type'><?= $adminText; ?></div>
                </div>
            </div>
            <!-- Menus -->
            <div class='sidebar-menus'>
                <!-- Dashboard -->
                <a class='menus-dashboard' href="mainPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-dashboard-img' src='../../Image/Assets/dashboard-active-icon.png' />
                    <div class='menus-dashboard-text' style='font-weight: 600;'><?= $dashboardText; ?></div>
                </a>
                <!-- Master Data -->
                <a class='menus-master-data' href="dataBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-master-data-img' src='../../Image/Assets/master-data-icon.png' />
                    <div class='menus-master-data-text'><?= $masterDataText; ?></div>
                </a>
                <!-- Report  -->
                <a class='menus-report' href="laporanTransaksiPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-report-img' src='../../Image/Assets/report-icon.png' >
                    <div class='menus-report-text'><?= $reportText; ?></div>
                </a>
                <!-- Logout -->
                <a class='menus-logout' href='../../index.php'> 
                    <img class='menus-logout-img' src='../../Image/Assets/logout-icon.png' />
                    <div class='menus-logout-text'><?= $logoutText; ?></div>
                </a>
            </div>
        </div>
        <!-- Header -->
        <div class='header'>
            <!--  Greeting -->
            <div class='header-greeting'>
                <?php echo $helloText . ' ' . strtok($adminSelected['nama_pegawai'], ' ') . ' !'; ?>
                <img class='header-photo-profile' src='../../Image/Pegawai/<?= $adminSelected['foto_profil_pegawai']; ?>' />
            </div>
        </div>
        <!-- Notification -->
        <div class='notification'>
            <!-- Total Transaction -->
            <div class='notification-transaction-total'>
                <div class='notification-transaction-total-text'>
                    <!-- Total -->
                    <div class='notification-transaction-total-number'><?php echo $totalTransaction->rowCount(); ?></div>
                    <!-- Title -->
                    <div class='notification-transaction-total-title'><?php echo $transactionText; ?></div>
                </div>
                <img class='notification-transaction-total-img' src='../../Image/Assets/book-icon.png'>
            </div>
            <!-- Status Transaction -->
            <div class='notification-transaction-status'>
                <div class='notification-transaction-status-text'>
                    <!-- Total -->
                    <div class='notification-transaction-status-number'><?php echo $transactionStatus->rowCount(); ?></div>
                    <!-- Title -->
                    <div class='notification-transaction-status-title'><?php echo $transactionStatusText; ?></div>
                </div>
                <img class='notification-transaction-status-img' src='../../Image/Assets/book-icon.png'>
            </div>
            <!-- Book -->
            <div class='notification-book-total'>
                <div class='notification-book-total-text'>
                    <div class='notification-book-total-number'><?php echo $totalBook->rowCount(); ?></div>
                    <div class='notification-book-total-title'><?php echo $bookAvailableText; ?></div>
                </div>
                <img class='notification-book-total-img' src='../../Image/Assets/book-icon.png' />
            </div>
            <!-- Anggota -->
            <div class='notification-user-total'>
                <div class='notification-user-total-text'>
                    <div class='notification-user-total-number'><?php echo $totalUser->rowCount(); ?></div>
                    <div class='notification-user-total-title'><?php echo $userText; ?></div>
                </div>
                <img class='notification-user-total-img' src='../../Image/Assets/book-icon.png' />
            </div>
        </div>
        <!-- Transaction History -->
        <div class='transaction-history'>
            <div class='card'>
                <!-- Title -->
                <h2 class='card-title' style='font-weight: 800;'>
                    <?= $transactionDataText ?>
                </h2>
                <table id='myTable'>
                    <!-- Column Title -->
                    <thead>
                        <tr>
                            <th><?= $transactionIDText; ?></th>
                            <th><?= str_replace('Judul', '', $bookNameText); ?></th>
                            <th><?= $userNPMText; ?></th>
                            <th><?= $transactionPickText; ?></th>
                            <th><?= $transactionReturnText; ?></th>
                            <th><?= str_replace('Sedang Pinjam', 'Status', $transactionStatusText);?></th>
                            <th><?= $optionText; ?></th>
                        </tr>
                    </thead>
                    <!-- Column Data -->
                    <tbody>
                        <?php foreach($transactionData as $td) :?>
                            <tr>
                                <td><?= $td['id_peminjaman']; ?></td>
                                <td><?= $td['judul_buku']; ?></td>
                                <td><?= $td['npm_anggota']; ?></td>
                                <td><?= $td['tgl_pinjam']; ?></td>
                                <td><?= $td['tgl_kembali']; ?></td>
                                <td><?= $td['status']; ?></td>
                                <!-- Button -->
                                <td>
                                    <a href="editStatusTransaksi.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?> & id_peminjaman=<?= $td['id_peminjaman']; ?>">
                                        <input type='button' value='Selesai Pinjam' class='change-status-button' />
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Hide Content -->
        <p style='visibility: hidden;'>
            <?= $hideContent; ?>
        </p>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "drawCallback": function(settings) {
                $('p').css('margin-top', '2px');
            }
        });
    });
</script>