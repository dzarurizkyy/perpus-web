<!-- Import Code Files -->
<?php
    require_once '../connect.php';
    require_once '../variable.php';
?>

<!-- Get Selected Anggota Data -->
<?php
    $query          = "SELECT * FROM anggota WHERE npm_anggota='".$_GET['npm_anggota']."'";
    $data           = $conn->prepare($query);
                      $data->execute();
    $userSelected   = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Get Selected Peminjaman Data -->
<?php
    $query = "SELECT * FROM peminjaman
              INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
              INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
              INNER JOIN pegawai_perpustakaan ON peminjaman.id_pegawai = pegawai_perpustakaan.id_pegawai
              WHERE anggota.id_anggota='".$userSelected['id_anggota']."'";
    $data = $conn->prepare($query);
    $data->execute();
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <!-- Page Title -->
    <title><?= $transactionDataText . $webName; ?></title>
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
          <img class='menus-dashboard-img' src='../../Image/Assets/dashboard-icon.png' />
          <div class='menus-dashboard-text'><?= $dashboardText; ?></div>
        </a>
        <!-- Transaction -->
        <a class='menus-transaction' href='dataTransaksi.php?npm_anggota=<?= $userSelected['npm_anggota']; ?>&id_anggota=<?= $userSelected['id_anggota']; ?>'>
          <img class='menus-transaction-img' src='../../Image/Assets/transaction-active-icon.png' />
          <div class='menus-transaction-text' style='font-weight: 600;'><?= $transactionText; ?></div>
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
    <!-- Transaction History -->
    <div class='transaction-user'>
        <!-- Button -->
        <div class='add-button'>
            <a href="tambahTransaksi.php?npm_anggota=<?= $userSelected['npm_anggota']; ?> & id_anggota=<?= $userSelected['id_anggota']; ?>" class="add-button-text"><?= '+ ' . $addTransactionText; ?></a>
        </div>
        <!-- Card -->
        <div class='card'>
            <!-- Title -->
            <h1 class='card-title'><?= $transactionDataText; ?></h1>
            <!-- Table -->
            <table id='myTable'>
                <!-- Column Title -->
                <thead>
                    <tr>
                        <th><?= $transactionIDText; ?></th>
                        <th><?= str_replace('Judul', ' ', $bookNameText); ?></th>
                        <th><?= str_replace('Nama Lengkap', 'Peminjam', $userNameText);?></th>
                        <th><?= $transactionPickText;?></th>
                        <th><?= $transactionReturnText;?></th>
                        <th><?= str_replace('Sedang Pinjam', 'Status', $transactionStatusText);?></th>
                    </tr>
                </thead>
                <!-- Column Data -->
                <tbody>
                    <?php foreach ($data as $td) : ?>
                        <tr style='background-color:lightgray'>
                            <td><?= $td['id_peminjaman'] ?></td>
                            <td><?= $td['judul_buku'] ?></td>
                            <td><?= $td['nama_anggota'] ?></td>
                            <td><?= $td['tgl_pinjam'] ?></td>
                            <td><?= $td['tgl_kembali'] ?></td>
                            <td><?= $td['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>

<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js'></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>