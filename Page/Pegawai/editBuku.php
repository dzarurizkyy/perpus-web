<!-- Import Code Files -->
<?php
  include '../connect.php';
  include '../variable.php';
?>

<!-- Get Selected Pegawai Data -->
<?php
  $query          = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
  $data           = $conn->prepare($query);
                    $data->execute();
  $adminSelected  = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Get Selected Buku Data -->
<?php
  $query           = "SELECT * FROM buku WHERE id_buku='".$_GET['id_buku']."'";
  $data            = $conn->prepare($query);
                     $data->execute();
  $bookSelected    = $data->fetch(PDO::FETCH_LAZY);  
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <!-- Page Title -->
      <title><?= $editBookText. $webName; ?></title>
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
                <?= strtok($adminSelected['nama_pegawai'], ' '); ?>
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
                  <img class='menus-master-data-img' src='../../Image/Assets/master-data-active-icon.png' />
                  <div class='menus-master-data-text' style='font-weight: 600;'><?= $masterDataText; ?></div>
              </a>
              <!-- Book Table -->
              <a class='menus-book-table' href="dataBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                  <div class='menus-book-table-text' style='font-weight: 600;'><?= $bookDataText; ?></div>
              </a>
              <!-- User Table -->
              <a class='menus-user-table' href="dataAnggota.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                  <div class='menus-user-table-text'><?= $userDataText; ?></div>
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
              <?= $helloText . ' ' . strtok($adminSelected['nama_pegawai'], ' ') . ' !'; ?>
              <img class='header-photo-profile' src='../../Image/Pegawai/<?= $adminSelected['foto_profil_pegawai']; ?>' />
          </div>
      </div>
      <!-- Form -->
      <form action='' method='POST' enctype='multipart/form-data' class='form-edit-book'>
        <!-- Left Column -->
        <div class='edit-book-left-col'>
          <!-- Edit Title -->
          <div class='edit-book-title'>
            <?= $editBookText; ?>
          </div>
          <!-- Book Name -->
          <div class='edit-book-name'>
            <!-- Title -->
            <label for='book-name' class='label-edit-book'><?= $bookNameText; ?></label>
            <!-- Input -->
            <input type='text' class='input-edit-book' name='judul_buku' size='38' id='book-name' value="<?= $bookSelected['judul_buku'];?>"/>
          </div>
          <!-- Book Author -->
          <div class='edit-book-author'>
            <!-- Title -->
            <label for='book-author' class='label-edit-book'><?= $bookAuthorText; ?></label>
            <!-- Input -->
            <input type='text' class='input-edit-book' name='pengarang' size='38' id='book-author' value="<?= $bookSelected['pengarang'];?>"/>
          </div>
          <!-- Book Publisher -->
          <div class='edit-book-publisher'>
            <!-- Title -->
            <label for='book-publisher' class='label-edit-book'><?= $bookPublisherText; ?></label>
            <!-- Input -->
            <input type='text' class='input-edit-book' name='penerbit' size='38' id='book-publisher' value="<?= $bookSelected['penerbit'];?>"/>
          </div>
          <!-- Book Type -->
          <div class='edit-book-type'>
            <!-- Title -->
            <label for='book-type' class='label-edit-book'><?= $bookTypeText; ?></label>
            <!-- Input -->
            <input type='text' class='input-edit-book' name='jenis_buku' size='38' id='book-type' value="<?= $bookSelected['jenis_buku'];?>"/>
          </div>
          <!-- Button -->
          <div class='edit-book-button'>
            <!-- Submit -->
            <input type='submit' class='submit-button' name='submitForm' />
            <!-- Cancel -->
            <a href="dataBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai'];?>">
              <input type='button' class='cancel-button' value='Cancel' >
            </a>
          </div>
        </div>
        <!-- Right Column -->
        <div class="edit-book-right-col">
          <!-- Book Year -->
          <div class='edit-book-year'>
            <!-- Title -->
            <label for='book-year' class='label-edit-book'><?= $bookYearText; ?></label>
            <!-- Input -->
            <input type='number' class='input-edit-book' name='tahun_terbit' id='book-year' value="<?= $bookSelected['tahun_terbit'];?>"/>
          </div>
          <!-- Book Total -->
          <div class='edit-book-total'>
            <!-- Title -->
            <label for='book-total' class='label-edit-book'><?= $bookTotalText; ?></label>
            <!-- Input -->
            <input type='number' class='input-edit-book' name='jumlah' id='book-total' value="<?= $bookSelected['jumlah'];?>"/>
          </div>
          <!-- Book Cover -->
          <div class='edit-book-cover'>
            <!-- Title -->
            <label class='label-edit-book' for='book-cover' style='margin-bottom: 9px;'><?= $bookCoverText; ?></label>
            <!-- Old Book  -->
            <input type='hidden' name='cover_buku_lama' value="<?= $bookSelected['cover_buku']?>" />
            <!-- New Book -->
            <div class='edit-book-cover-upload'>
              <!-- Book Image -->
              <img src="../../Image/Buku/<?= $bookSelected['cover_buku']; ?>" class='book-cover-old'/>
              <!-- Book Name -->
              <input type='file' name='cover_buku' id='book-cover' />
            </div>
          </div>
        </div>
      </form>
  </body>
</html> 

<!-- Try tou update data in database -->
<?php if(isset($_POST['submitForm'])) {
  $photoName   = $_FILES['cover_buku']['name'];
  $photoSize   = $_FILES['cover_buku']['size'];
  $photoError  = $_FILES['cover_buku']['error'];
  $tmpName     = $_FILES['cover_buku']['tmp_name'];

  // Check cover book already uploaded or not
  if($photoError == 4) {
    // If cover book not update, cover book will not change
    $photoNameNew = $_POST['cover_buku_lama'];
  }
  else {
    // Check uploaded document is an image or not
    $extensionUpload = ['jpg', 'png', 'jpeg'];
    $extensionCover  = explode('.', $photoName);
    $extensionCover  = strtolower(end($extensionCover));
    
    if(!in_array($extensionCover, $extensionUpload)) {
      echo "<script>
                  alert('Jenis dokumen yang diunggah tidak valid !!')
            </script>";
      die();
    }

    // Check size image more than 2mb or not
    if($photoSize > 2000000) {
      echo "<script>
                  alert('Ukuran gambar lebih dari 2 mb !!')
            </script>";
      die();
    }

    // Change image name to unique name
    $photoNameNew  = uniqid();
    $photoNameNew .= '.' . $extensionCover;
    
    // Move location cover book to selected folder
    move_uploaded_file($tmpName, __DIR__ . '/../../Image/Buku/' . $photoNameNew);   
  }

  $query = "UPDATE buku SET
            judul_buku    = '".$_POST['judul_buku']."',
            pengarang     = '".$_POST['pengarang']."',
            penerbit      = '".$_POST['penerbit']."',
            jenis_buku    = '".$_POST['jenis_buku']."',
            tahun_terbit  = '".$_POST['tahun_terbit']."',
            jumlah        = '".$_POST['jumlah']."',
            cover_buku    = '$photoNameNew'
            WHERE id_buku = '".$bookSelected['id_buku']."'";
  
  $data  = $conn->prepare($query);

  // Data saved
  if($data->execute()) {
    echo "<script>
            document.location.href='dataBuku.php?nip_pegawai=".$adminSelected['nip_pegawai']."';
            alert('Data buku berhasil diperbarui');
          </script>";    
  }
  // Data unsaved
  else {
    echo "<script>
            alert('Data buku gagal diperbarui'); 
          </script>";
    die();
  }
}
?>
