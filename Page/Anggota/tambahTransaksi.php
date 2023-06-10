<!-- Import Code Files -->
<?php
    require_once '../connect.php';
    require_once '../variable.php';
?>

<!-- Get Selected Anggota Data -->
<?php
    $query          = "SELECT * FROM anggota WHERE npm_anggota='" . $_GET['npm_anggota'] . "'";
    $data           = $conn->prepare($query);
                      $data->execute();
    $userSelected  = $data->fetch(PDO::FETCH_LAZY);

    $query          = 'SELECT * FROM buku';
    $bookData       =  $conn->prepare($query);
                       $bookData->execute();

    $query          = 'SELECT * FROM pegawai_perpustakaan';
    $adminData      = $conn->prepare($query);
                      $adminData->execute();
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <!-- Page Title -->
        <title><?= $addTransactionText . $webName; ?></title>
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
        <!-- Form -->
        <form action='' method='POST' enctype='multipart/form-data' class='form-add-transaction'>
            <div class='add-transaction-col'>
                <!-- Title -->  
                <div class='add-transaction-title'>
                    <?=  $addTransactionText; ?>
                </div>
                <!-- Transaction ID -->
                <div class='add-transaction-id'>
                    <!-- Title -->
                    <label class='label-add-transaction' for='transaction-id'>
                        <?= $transactionIDText . ' ' . $transactionText ;?>
                    </label>
                    <!-- Input -->
                    <input type='text' class='input-add-transaction' name='id_peminjaman' size='50' id='transaction-id' />
                </div>
                <!-- Book Name -->
                <div class='add-transaction-book'>
                    <!-- Title -->
                    <label class='label-add-transaction' for='transaction-book'>
                        <?= $bookNameText; ?>
                    </label> 
                    <!-- Input -->
                    <select class='input-add-transaction' name='id_buku' id='transaction-book' style='width: 385px;'>
                        <?php foreach ($bookData as $td) : ?>
                            <option value='<?= $td['id_buku']; ?>'> <?= $td['judul_buku']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Pick Book -->
                <div class='add-transaction-pick'>
                    <!-- Title -->
                    <label class='label-add-transaction' for='transaction-pick'>
                        <?= $transactionPickText; ?>
                    </label>
                    <!-- Input -->
                    <input type='datetime-local' class='input-add-transaction' name='tgl_pinjam' id='transaction-pick' />
                </div>
                <!-- Return Book -->
                <div class='add-transaction-return'>
                    <!-- Title -->
                    <label class='label-add-transaction' for='transaction-return'>
                        <?= $transactionReturnText; ?>
                    </label>
                    <!-- Input -->
                    <input type='datetime-local' class='input-add-transaction' name='tgl_kembali' id='transaction-return' />
                </div>
                <!-- Admin Name -->
                <div class='add-transaction-admin'>
                    <!-- Title -->
                    <label class='label-add-transaction' for='transaction-admin'>
                        <?= $adminNameText; ?>
                    </label>
                    <!-- Input -->
                    <select class='input-add-transaction' name='id_pegawai' id='transaction-admin'>
                        <?php foreach ($adminData as $td) : ?>
                            <option value='<?= $td['id_pegawai']; ?>'> <?= $td['nama_pegawai']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Button -->
                <div class='add-transaction-button'>
                    <!-- Submit -->
                    <input type='submit' class='submit-button' name='submitForm' />
                    <!-- Cancel -->
                    <a href='dataTransaksi.php?npm_anggota=<?= $userSelected['npm_anggota']; ?>'>
                        <input type='button' class='cancel-button' value='Cancel' />
                    </a>
                </div>
            </div>
        </form>
    </body>
</html>

<!-- Try to update data in database -->
<?php if (isset($_POST['submitForm'])) { 
  $query = "INSERT INTO peminjaman VALUES (
            '".$_POST['id_peminjaman']."', 
            '".$userSelected['id_anggota']."',
            '".$_POST['id_buku']."',
            '".$_POST['id_pegawai']."',
            '".$_POST['tgl_pinjam']."',
            '".$_POST['tgl_kembali']."',
            'Pinjam'
        ); ";

   $data = $conn->prepare($query);
   
  
  // Data saved
  if ($data->execute()) {
    // Subtraction total book for picked book 
    $query = "UPDATE buku set jumlah = jumlah - 1 WHERE id_buku = '".$_POST['id_buku']."'";
    $data  = $conn->prepare($query);
             $data->execute();
    echo "<script>
            document.location.href='dataTransaksi.php?npm_anggota=".$userSelected['npm_anggota']."';
            alert('Peminjaman buku berhasil ditambahkan');
          </script>";
  }
  // Data unsaved
  else {
    echo "<script>
            alert('Peminjaman buku gagal ditambahkan');
          </script>";
    die();
  }
} ?>