<!-- Import Code Files -->
<?php
  require_once '../connect.php';
  require_once '../variable.php';
?>

<!-- Get Selected Anggota Data -->
<?php
  $query            = "SELECT * FROM anggota WHERE npm_anggota='" . $_GET['npm_anggota'] . "'";
  $data             = $conn->prepare($query);
                      $data->execute();
  $userSelected    = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Get Peminjaman Data from Selected Anggota -->
<?php
  // Total Pick
  $query            = "SELECT * FROM peminjaman WHERE 
                       id_anggota='".$userSelected['id_anggota']." 'AND status='Pinjam'";
  $totalPickBook    = $conn->prepare($query);
                      $totalPickBook->execute();

  // Total Return
  $query            = "SELECT * FROM peminjaman WHERE
                      id_anggota='".$userSelected['id_anggota']."' AND status='Kembali'";
  $totalReturnBook  = $conn->prepare($query);
                      $totalReturnBook->execute();
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
        <img class='photo-profile' src='../../Image/Anggota/<?= $userSelected['foto_profil_anggota']; ?>' />
        <div class='sidebar-username'>
          <?= strtok($userSelected['nama_anggota'], ' '); ?>
          <div class='sidebar-type'><?= $userText; ?></div>
        </div>
      </div>
      <!-- Menus -->
      <div class='sidebar-menus'>
        <!-- Dashboard -->
        <a class='menus-dashboard' href='mainAnggota.php?npm_anggota=<?= $userSelected['npm_anggota']; ?> & id_anggota=<?= $userSelected['id_anggota']; ?>'>
          <img class='menus-dashboard-img' src='../../Image/Assets/dashboard-active-icon.png' />
          <div class='menus-dashboard-text' style='font-weight: 600;'><?= $dashboardText; ?></div>
        </a>
        <!-- Transaction -->
        <a class='menus-transaction' href='dataTransaksi.php?npm_anggota=<?= $userSelected['npm_anggota']; ?>&id_anggota=<?= $userSelected['id_anggota']; ?>'>
          <img class='menus-transaction-img' src='../../Image/Assets/transaction-icon.png' />
          <div class='menus-transaction-text'><?= $transactionText; ?></div>
        </a>
        <!-- Edit Profile -->
        <a class='menus-edit-profile' href='editProfil.php?npm_anggota=<?= $userSelected['npm_anggota']; ?>'>
          <img class='menus-edit-profile-img' src='../../Image/Assets/edit-profile-icon.png' />
          <div class='menus-edit-profile-text'><?= $editProfileText; ?></div>
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
      <div class='header-greeting'>
        <?= $helloText . ' ' . strtok($userSelected['nama_anggota'], ' ') . ' !'; ?>
        <img class='header-photo-profile' src='../../Image/Anggota/<?= $userSelected['foto_profil_anggota']; ?>' />
      </div>
    </div>
    <!-- Notification -->
    <div class='notification'>
      <!-- Pick -->
      <div class='notification-transaction-status'>
        <div class='notification-transaction-status-text'>
          <div class='notification-transaction-status-number'><?php echo $totalPickBook->rowCount(); ?></div>
          <div class='notification-transaction-status-title'><?php echo str_replace('Sedang', ' ', $transactionStatusText); ?></div>
        </div>
        <img class='notification-transaction-status-img' src='../../Image/Assets/book-icon.png' style='margin-right: 4px;'>
      </div>
      <!-- Return -->
      <div class='notification-transaction-status'>
        <div class='notification-transaction-status-text'>
          <div class='notification-transaction-status-number'><?= $totalReturnBook->rowCount(); ?></div>
          <div class='notification-transaction-status-title'><?= $returnedText; ?></div>
        </div>
        <img class='notification-transaction-status-img' src='../../Image/Assets/book-icon.png' style='margin-right: 4px;' />
      </div>
    </div>
  </body>
</html>