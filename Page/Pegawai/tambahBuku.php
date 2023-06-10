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

<!DOCTYPE html>
<html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <!-- Page Title -->
      <title><?= $addBookText . $webName; ?></title>
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
          <!-- Greeting -->
          <div class='header-greeting'>
              <?php echo $helloText . ' ' . strtok($adminSelected['nama_pegawai'], ' ') . ' !'; ?>
              <img class='header-photo-profile' src='../../Image/Pegawai/<?= $adminSelected['foto_profil_pegawai']; ?>' />
          </div>
      </div>
      <!-- Form -->
      <form action='' method='POST' enctype='multipart/form-data' class='form-add-book'>
        <!-- Left Column -->
        <div class='add-book-left-col'>
          <!-- Title -->
          <div class='add-book-title'>
            <?php echo $addBookText;?>
          </div>
          <!-- Book Code -->
          <div class='add-book-code'>
            <label class='label-add-book' for='id-book'>
              <?php echo $bookIdText; ?>
            </label>
            <input class='input-add-book' type='text' name='id_buku' size='38' id='id-book' required />
          </div>
          <!-- Book Title -->
          <div class='add-book-name'>
            <label class='label-add-book' for='name-book'>
              <?php echo $bookNameText; ?>
            </label>
            <input class='input-add-book' type='text' name='judul_buku' size='38' id='name-book' required />
          </div>
          <!-- Author -->
          <div class='add-book-author'>
            <label class='label-add-book' for='author-book'>
              <?php echo $bookAuthorText; ?>
            </label>
            <input class='input-add-book' type='text' name='pengarang' size='38' id='author-book' required />
          </div>
          <!-- Publisher -->
          <div class='add-book-publisher'>
            <label class='label-add-book' for='publisher-book'>
              <?php echo $bookPublisherText; ?>
            </label>
            <input class='input-add-book' type='text' name='penerbit' size='38' id='publisher-book'  required />
          </div> 
          <!-- Button -->
          <div class="add-book-button">
              <!-- Submit -->
              <input type='submit' class='submit-button' name='submitForm' />
              <!-- Cancel -->
              <a href="dataBuku.php?nip_pegawai=<?php echo $adminSelected['nip_pegawai']; ?>" >
                <input type='button' class='cancel-button' value='Cancel'/>
              </a>
          </div>
        </div>
        <!-- Right Column -->
        <div class='add-book-right-col'>
          <!-- Type -->
          <div class='add-book-type'>
            <label class='label-add-book' for='publication-year-book'>
              <?php echo $bookTypeText; ?>
            </label>
            <input class='input-add-book' type='text' name='jenis_buku' size='32' id='publication-year-book' required />
          </div>
          <!-- Publication Year -->
          <div class='add-book-year'>
            <label class='label-add-book' for='year-book'>
              <?php echo $bookYearText; ?>
            </label>
            <input class='input-add-book' type='number' name='tahun_terbit' id='year-book' required />
          </div>
          <!-- Total -->
          <div class='add-book-total'>
            <label class='label-add-book' for='total-book'>
              <?php echo $bookTotalText; ?>
            </label>
            <input class='input-add-book' type='number' name='jumlah' id='total-book' required />
          </div>
          <!-- Cover Book -->
          <div class='add-book-cover'>
            <label class='label-add-book' for='book-cover-file'><?php echo $bookCoverText; ?></label>
            <input class='input-add-book' type='file' name='cover_buku' id='book-cover-file' required />
          </div>
        </div>
      </form>
  </body>
</html>

<!-- Try to insert data in database -->
<?php if(isset($_POST['submitForm'])) {
    $photoName  = $_FILES['cover_buku']['name'];
    $photoSize  = $_FILES['cover_buku']['size'];
    $photoError = $_FILES['cover_buku']['error'];
    $tmpName    = $_FILES['cover_buku']['tmp_name'];
   
    // Check cover book already upload or not
    if($photoError == 4) {
      echo "<script>
              alert('Masukkan cover buku terlebih dahulu !!');
            </script>";
      die();
    } 

    // Check uploaded document is an image or not
    $extensionUpload = ['jpg', 'png', 'jpeg'];
    $extensionPhoto  = explode('.', $photoName);
    $extensionPhoto  = strtolower(end($extensionPhoto));
    
    if(!in_array($extensionPhoto, $extensionUpload)) {
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
   
   // Change photo name to unique
   $photoNameNew = uniqid();
   $photoNameNew .= '.' . $extensionPhoto;

   // Move photo to selected location
   move_uploaded_file($tmpName, __DIR__ . '/../../Image/Buku/' . $photoNameNew);

   // Insert data in database
   $query = "INSERT INTO buku VALUES (
            '".$_POST['id_buku']."',
            '".$_POST['judul_buku']."',
            '".$_POST['tahun_terbit']."',
            '".$_POST['jenis_buku']."',
            '".$_POST['jumlah']."',
            '".$_POST['pengarang']."',
            '".$_POST['penerbit']."',
            '$photoNameNew'
   )";

   $data = $conn->prepare($query);
   // Data saved
   if($data->execute()) {
      echo "<script>
              document.location.href='dataBuku.php?nip_pegawai=".$adminSelected['nip_pegawai']."';
              alert('Data buku berhasil ditambahkan');  
           </script>"; 
   }
   //  Data unsaved
   else {
    echo "<script>
            alert('Data buku gagal ditambahkan');
         </script>";
    die();
   }
}?>