<!-- Import Code Files -->
<?php
  include '../connect.php';
  include '../variable.php'; 
?>

<!-- Get Selected Pegawai Data -->
<?php
  $query         = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
  $data          = $conn->prepare($query);
                   $data->execute();
  $adminSelected = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Get Selected Anggota Data -->
<?php
  $query         = "SELECT * FROM anggota WHERE npm_anggota='".$_GET['npm_anggota']."'";
  $data          = $conn->prepare($query);
                   $data->execute();
  $userSelected  = $data->fetch(PDO::FETCH_LAZY);
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <!-- Page Title -->
    <title><?= $editUserText . $webName; ?></title>
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
                <div class='menus-book-table-text'><?= $bookDataText; ?></div>
            </a>
            <!-- User Table -->
            <a class='menus-user-table' href="dataAnggota.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
                <div class='menus-user-table-text' style='font-weight: 600;'><?= $userDataText; ?></div>
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
    <form action='' method='POST' enctype='multipart/form-data' class='form-edit-user'>
      <!-- Left Column -->
      <div class='edit-user-left-col'>
          <!-- Title -->
          <div class='edit-user-title'>
            <?= $editUserText; ?>     
          </div>
          <!-- Name -->
          <div class='edit-user-name'>
              <label for='user-name' class='label-edit-user'><?= $userNameText; ?></label>
              <input type='text' class='input-edit-user' name='nama_anggota' size='38' id='user-name' value='<?= $userSelected['nama_anggota']; ?>' />
          </div>
          <!-- Address -->
          <div class='edit-user-address'>
              <label for='user-address' class='label-edit-user'><?= $userAddressText; ?></label>
              <input type='text' class='input-edit-user' name='alamat_anggota' size='38' id='user-address' value='<?= $userSelected['alamat_anggota']; ?>' />
          </div>
          <!-- Faculty -->
          <div class='edit-user-faculty'>
              <label for='user-faculty' class='label-edit-user'><?= $userFacultyText; ?></label>
              <input type='text' class='input-edit-user' name='fakultas' size='38' id='user-faculty' value='<?= $userSelected['fakultas']; ?>' />
          </div>
          <!-- Department -->
          <div class='edit-user-department'>
              <label for='user-department' class='label-edit-user'><?= $userDepartmentText; ?></label>
              <input type='text' class='input-edit-user' name='jurusan' size='38' id='user-department' value='<?= $userSelected['jurusan']; ?>' />
          </div>
          <!--  Telephone -->
          <div class='edit-user-telephone'>
              <label for='user-telephone' class='label-edit-user'><?= $userTelephoneText; ?></label>
              <input type='text' name='nomor_telepon_anggota' class='input-edit-user' size='38' id='user-telephone' value='<?= $userSelected['nomor_telepon_anggota']; ?>' />
          </div>
      </div>
      <!-- Right Column -->
      <div class='edit-user-right-col'>
        <!-- Email -->
        <div class='edit-user-email'>
            <label for='user-email' class='label-edit-user'><?= $userEmailText; ?></label>
            <input type='text' class='input-edit-user' name='email_anggota' size='38' id='user-email' value='<?= $userSelected['email_anggota']; ?>' />
        </div>
        <!-- Password -->
        <div class='edit-user-password'>
            <label for='user-password' class='label-edit-user'><?= $userPasswordText; ?></label>
            <input type='text' class='input-edit-user' name='password_anggota' size='38' id='user-password' value='<?= $userSelected['password_anggota']; ?>' />
        </div>
        <!-- Photo Profile -->
        <div class='edit-user-photo'>
            <label for='user-photo-file' class='label-edit-user'><?= $userPhotoText; ?></label>
            <!-- New Image -->
            <input type='file' name='foto_profil_anggota' id='user-photo-file' />
            <!-- Old Image -->
            <div>
              <input type='hidden' name='foto_profil_anggota_lama' value='<?= $userSelected['foto_profil_anggota'] ?>'/>
              <img src='../../Image/Anggota/<?=$userSelected['foto_profil_anggota']?>' class='user-photo-old' />
            </div>
        </div>
        <!-- Button -->
        <div class='edit-user-button'>
          <!-- Submit -->
          <input type='submit' name='submitForm' class='submit-button' />
          <!-- Cancel -->
          <a href='dataAnggota.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>'>
            <input type='button' class='cancel-button' value='Cancel'   />
          </a>
        </div>
      </div>
    </form>
  </body>
</html>

<!-- Try to update data in database -->
<?php if(isset($_POST['submitForm'])) {
  $photoName  = $_FILES['foto_profil_anggota']['name'];
  $photoSize  = $_FILES['foto_profil_anggota']['size'];
  $photoError = $_FILES['foto_profil_anggota']['error'];
  $tmpName    = $_FILES['foto_profil_anggota']['tmp_name'];
  
  // Check photo profile already uploaded or not
  if($photoError == 4) {
    // If photo profile not update, photo profile will not change
    $photoNameNew = $_POST['foto_profil_anggota_lama'];
  }
  else {
    // Check uploaded document is an image or not
    $extensionUpload  = ['jpg', 'png', 'jpeg'];
    $extensionPhoto   = explode('.', $photoName);
    $extensionPhoto   = strtolower(end($extensionPhoto));
    
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
    move_uploaded_file($tmpName, __DIR__ . '/../../Image/Anggota/' . $photoNameNew);
  }

  // Update data in database
  $query = "UPDATE anggota SET
            nama_anggota            = '".$_POST['nama_anggota']."',
            alamat_anggota          = '".$_POST['alamat_anggota']."',
            fakultas                = '".$_POST['fakultas']."',
            jurusan                 = '".$_POST['jurusan']."',
            nomor_telepon_anggota   = '".$_POST['nomor_telepon_anggota']."',
            email_anggota           = '".$_POST['email_anggota']."',
            password_anggota        = '".$_POST['password_anggota']."',
            foto_profil_anggota     =  '$photoNameNew' 
            WHERE id_anggota        = '".$userSelected['id_anggota']."'";
  
  $data = $conn->prepare($query);
  
  // Data saved 
  if($data->execute()) {
    echo "<script>
            document.location.href='dataAnggota.php?nip_pegawai=".$adminSelected['nip_pegawai']."';
            alert('Data anggota berhasil diperbarui');
          </script>";    
  }
  // Data unsaved
  else {
    echo "<script>
            alert('Data anggota gagal diperbarui'); 
          </script>";
  }
}?>