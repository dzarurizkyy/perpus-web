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
      <title><?= $addUserText. $webName; ?></title>
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
      <form action='' method='POST' enctype='multipart/form-data' class='form-add-user'>
        <!-- Left Column -->
        <div class='add-user-left-col'>
          <!-- Title -->
          <div class='add-user-title'>
            <?= $addUserText; ?>
          </div>
          <!-- User ID -->
          <div class='add-user-id'>
            <!-- Label -->
            <label for='user-id' class='label-add-user'><?= $userIDText; ?></label>
            <!-- Input -->
            <input type='text' name='id_anggota' class='input-add-user' id='user-id' size='38' required />
          </div>
          <!-- NPM -->
          <div class='add-user-npm'>
            <!-- Label -->
            <label for='user-npm' class='label-add-user'><?= str_replace('NPM', 'Nomor Pokok Mahasiswa', $userNPMText); ?></label>
            <!-- Input -->
            <input type='number' name='npm_anggota' class='input-add-user' id='user-npm' size='38' required />
          </div>
          <!-- Username -->
          <div class='add-user-name'>
            <!-- Label -->
            <label for='user-name' class='label-add-user'><?= $userNameText; ?></label>
            <!-- Input -->
            <input type='text' name='nama_anggota' class='input-add-user' id='user-name' size='38' required />
          </div>
          <!-- Faculty -->
          <div class='add-user-faculty'>
            <!-- Label -->
            <label for='user-faculty' class='label-add-user'><?= $userFacultyText; ?></label>
            <!-- Input -->
            <input type='text' name='fakultas' class='input-add-user' id='user-faculty' size='38' required />
          </div>
          <!-- Department -->
          <div class='add-user-department'>
            <!-- Label -->
            <label for='user-department' class='label-add-user'><?= $userDepartmentText; ?></label>
            <!-- Input -->
            <input type='text' name='jurusan' class='input-add-user' id='user-department' size='38' required />
          </div>
          <!-- Gender -->
          <div class='add-user-gender'>
            <!-- Label -->
            <label for='user-gender' class='label-add-user'><?= $userGenderText; ?></label>
            <!-- Input -->
            <select class='input-add-user' name='jenis_kelamin_anggota' id='user-gender' style='appearance: auto;'>
              <option value='<?= $maleText; ?>'><?= $maleText; ?></option>
              <option value='<?= $femaleText; ?>'><?= $femaleText; ?></option>
            </select>
          </div>
        </div>
        <!-- Right Column -->
        <div class='add-user-right-col'>
          <!-- Email -->
          <div class='add-user-email'>
            <!-- Label -->
            <label for='user-email' class='label-add-user'><?= $userEmailText; ?></label>
            <!-- Input -->
            <input type='text' name='email_anggota' class='input-add-user' id='user-email' size='38' required />
          </div>
          <!-- Password -->
          <div class='add-user-password'>
            <!-- Label -->
            <label for='user-password' class='label-add-user'><?= $userPasswordText; ?></label>
            <!-- Input -->
            <input type='text' name='password_anggota' class='input-add-user' id='user-password' size='38' required />
          </div>
          <!-- No Telephone -->
          <div class='add-user-telephone'>
            <!-- Label -->
            <label for='user-telephone' class='label-add-user'><?= $userTelephoneText; ?></label>
            <!-- Input -->
            <input type='number' name='nomor_telepon_anggota' class='input-add-user' id='user-telephone' size='38' required />
          </div>
          <!-- Address -->
          <div class='add-user-address'>
            <!-- Label -->
            <label for='user-address' class='label-add-user'><?= $userAddressText; ?></label>
            <!-- Input -->
            <input type='text' name='alamat_anggota' class='input-add-user' id='user-address' size='38' required />
          </div>
          <!-- Photo Profile -->
          <div class='add-user-photo'>
            <!-- Label -->
            <label for='user-photo-file' class='label-add-user'><?= $userPhotoText; ?></label>
            <!-- Input -->
            <input type='file' name='foto_profil_anggota' class='input-add-user' id='user-photo-file' required />
          </div>
          <!-- Button -->
          <div class='add-user-button'>
            <!-- Submit -->
            <input type='submit' class='submit-button' name='submitForm' />
            <!-- Cancel -->
            <a href="dataAnggota.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>">
              <input type='button' class='cancel-button' value='Cancel'/>
            </a>
          </div>
        </div>
      </form>
    </body>
</html>

<!-- Try to insert data in database -->
<?php if(isset($_POST['submitForm'])) {
    $photoName   = $_FILES['foto_profil_anggota']['name'];
    $photoSize   = $_FILES['foto_profil_anggota']['size'];
    $photoError  = $_FILES['foto_profil_anggota']['error'];
    $tmpName     = $_FILES['foto_profil_anggota']['tmp_name'];
    
    // Check profile picture already upload or not
    if($photoError == 4) {
      echo "<script>
               alert('Masukkan foto profil terlebih dahulu !!');
            </script>";
      die();
    }

    // Check uploaded document is an image or not
    $extensionUpload  = ['jpg', 'png', 'jpeg'];
    $extensionPhoto   = explode('.', $photoName);
    $extensionPhoto   = strtolower(end($extensionPhoto));
    
    if(!in_array($extensionPhoto, $extensionUpload)) {
      echo "<script>
               alert('Jenis dokumen yang diunggah tidak valid !!');
            </script>";
      die();
    }

    // Check size image more than 2mb or not
    if($photoSize > 2000000) {
      echo "<script>
               alert('Ukuran gambar lebih dari 2mb !!');
            </script>";
      die();      
    }  

    // Change photo name to unique
    $photoNameNew = uniqid();
    $photoNameNew .= '.' . $extensionPhoto;
    
    // Move photo to selected location
    move_uploaded_file($tmpName, __DIR__ . '/../../Image/Anggota/' . $photoNameNew);

    // Insert data in database
    $query = "INSERT INTO anggota VALUES (
                '".$_POST['id_anggota']."',
                '".$_POST['npm_anggota']."',
                '".$_POST['nama_anggota']."',
                '".$_POST['email_anggota']."',
                '".$_POST['password_anggota']."',
                '".$_POST['nomor_telepon_anggota']."',
                '".$_POST['fakultas']."',
                '".$_POST['jurusan']."',
                '".$_POST['jenis_kelamin_anggota']."',
                '$photoNameNew',
                '".$_POST['alamat_anggota']."'
    )";  

    $data = $conn->prepare($query);
    // Data saved
    if($data->execute()) {
        echo "<script>
                  document.location.href = 'dataAnggota.php?nip_pegawai=".$adminSelected['nip_pegawai']."';
                  alert('Data anggota berhasil ditambahkan')
              </script>";    
    }
    // Data unsaved
    else {
      echo "<script>
                alert('Data anggota gagal ditambahkan');    
            </script";
      die();
    }
   }
?>