<!-- Import Code Files -->
<?php
  require_once 'Page/variable.php';
  require_once 'Page/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <!-- Page Title -->
      <title><?= $loginPage; ?></title>
      <!-- Favicon -->
      <link rel='icon' type='image/x-icon' href='Image/Assets/perpus-icon.png' />
      <!-- External CSS -->
      <link rel='stylesheet' type='text/css' href='Page/styles.css' />
      <!-- Google Font API -->
      <link rel='preconnect' href='https://fonts.googleapis.com' />
      <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
      <link href='https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet' />
    </head>
    <body id='login-page'>
      <!-- Title -->
      <h1 class='login-title'>
        <?= strtoupper($loginTitle); ?>
      </h1>
      <!-- Icon -->
      <div class='login-icon'>
        <img class='login-icon-img' src='Image/Assets/profile-icon.png' />
      </div>
      <!-- Form -->
      <div class='login-box'>
        <form action='' method='POST' class='form-login'>
          <!-- Username -->
          <div class='login-username'>
            <!-- Title -->
            <label for='username'><?= $usernameText; ?></label>
            <!-- Input -->
            <input type='text' class='input-login' name='username' size='44' id='username' required />
          </div>
          <!-- Password -->
          <div class='login-password'>
            <label for='password'><?= $passwordText; ?></label>
            <input type='password' name='password' class='input-login' size='44' id='password' required />
          </div>
          <!-- Submit -->
          <input type='submit' class='login-submit' name='loginForm' value='LOGIN' />
        </form>
      </div>
    </body>
</html>

<!-- Verification Account-->
<?php if (isset($_POST['loginForm'])) {
  // Verify Admin/Users
  $totalChar = strlen($_POST['username']);
  
  // Users
  if ($totalChar === 11) {
    $query = "SELECT * FROM anggota WHERE 
              npm_anggota='".$_POST['username']."' AND password_anggota='".$_POST['password']."'";
    $data   = $conn->prepare($query);
              $data->execute();
    
    // Login Success
    if ($data->rowCount() === 1) {
      echo "<script>
              document.location.href='Page/Anggota/mainAnggota.php?npm_anggota=".$_POST['username']."'; 
            </script>";
    }
  }
  
  // Admin
  elseif ($totalChar === 18) {
    $query = "SELECT * FROM pegawai_perpustakaan WHERE 
              nip_pegawai='".$_POST['username']."' AND password_pegawai='".$_POST['password']."'";

    $data = $conn->prepare($query);
    $data->execute();

    // Login Success
    if ($data->rowCount() === 1) {
      echo "<script>
              document.location.href='Page/Pegawai/mainPegawai.php?nip_pegawai=".$_POST['username']."'; 
            </script>";
    }
  }

  // Not Users/Admin 
  else {
    echo "<script>
            alert('Username yang Anda masukkan tidak valid! Silakan coba lagi!')
          </script>";
    die();
  }

  // Login Failed
  echo "<script>alert('Username atau Password Anda salah!')</script>";
  die();
  
} ?>