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

<!-- Delete Anggota Data -->
<?php
  $query         = "DELETE FROM peminjaman WHERE id_anggota='".$userSelected['id_anggota']."'";
  $data          = $conn->prepare($query);
                   $data->execute(); 
  $query         = "DELETE FROM anggota WHERE id_anggota='".$userSelected['id_anggota']."'";
  $data          = $conn->prepare($query);
  
  // Success delete
  if($data->execute()) {
    echo "<script>
            document.location.href = 'dataAnggota.php?nip_pegawai=" . $adminSelected['nip_pegawai'] . "';          
            alert('Data anggota berhasil dihapus');
          </script>";
  } 
  // Unsuccess delete
  else {
    echo "<script>
            alert('Data anggota gagal dihapus');
          </script>";
    die();
  }
?>