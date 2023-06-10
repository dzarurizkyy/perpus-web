<!-- Import Code Files -->
<?php
  require_once '../connect.php';
  require_once '../variable.php';
?>

<!-- Get Selected Pegawai Data -->
<?php
  $query          = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
  $data           = $conn->prepare($query);
                    $data->execute();
  $adminSelected  = $data->fetch(PDO::FETCH_LAZY);
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <!-- Page Title -->
      <title><?= $reportBookText. $webName; ?></title>
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
                    <?= strtok($adminSelected['nama_pegawai'], " "); ?>
                    <div class='sidebar-type'><?= $adminText; ?></div>
                </div>
            </div>
            <!-- Menus -->
            <div class='sidebar-menus'>
                <!-- Dashboard -->
                <a class='menus-dashboard' href="mainPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-dashboard-img' src='../../Image/Assets/dashboard-icon.png' />
                    <div class='menus-dashboard-text'><?= $dashboardText; ?></div>
                </a>
                <!-- Master Data -->
                <a class='menus-master-data' href="dataBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-master-data-img' src='../../Image/Assets/master-data-icon.png' />
                    <div class='menus-master-data-text'><?= $masterDataText; ?></div>
                </a>
                <!-- Report  -->
                <a class='menus-report' href="laporanTransaksiPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <img class='menus-report-img' src='../../Image/Assets/report-active-icon.png' >
                    <div class='menus-report-text' style='font-weight: 600;'><?= $reportText; ?></div>
                </a>
                <!-- Transaction Report  -->
                <a class='menus-transaction-report' href="laporanTransaksiPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <div class='menus-transaction-report-text'><?= $transactionText; ?></div>
                </a>
                <!-- Book Report -->
                <a class='menus-book-report' href="laporanBukuPegawai.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                    <div class='menus-book-report-text' style='font-weight: 600;'><?= $bookText; ?></div>
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
        <!-- Report -->
        <div class='report'>
            <!-- Title -->
            <h1 class='report-text'><?= $reportBookText ?></h1>
            <div class="report-export">
                <!-- Export PDF -->
                <a target='_blank' href='exportBukuPdf.php' class='export-pdf'>
                    <?= $exportPDFText; ?>
                </a>
                <!-- White Space -->
                <span>&nbsp;&nbsp;</span>
                <!-- Export Excel -->
                <a href='exportBukuExcel.php' class='export-excel'>
                    <?= $exportExcelText; ?>
                </a>
            </div>
        </div>
    </body>
</html>