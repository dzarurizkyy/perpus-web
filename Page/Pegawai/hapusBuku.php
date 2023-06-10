<!-- Import Code Files -->
<?php
  include "../connect.php";
  include "../variable.php";
?>

<!-- Get Selected Pegawai Data -->
<?php
  $query           = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
  $data            = $conn->prepare($query);
                     $data->execute();
  $adminSelected   = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Delete Book Data -->
<?php
  $query           = "DELETE FROM peminjaman WHERE id_buku='".$_GET['id_buku']."'";
  $data            = $conn->prepare($query);
                     $data->execute();
  $query           = "DELETE FROM buku WHERE id_buku='".$_GET['id_buku']."'";
  $data            = $conn->prepare($query);

  // Success delete
  if($data->execute()) {
    echo "<script>
              document.location.href='dataBuku.php?nip_pegawai=" . $adminSelected['nip_pegawai'] . "';
              alert('Data buku berhasil dihapus');
          </script>";
  }
  // Unsuccess delete
  else {
    "<script>
          alert('Data buku gagal ditambahkan');
    </script>";
    die();
  }
?>
