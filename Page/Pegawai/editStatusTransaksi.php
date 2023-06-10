<!-- Import Code Files -->
<?php
  include '../connect.php';
  include '../variable.php';
?>

<!-- Get Selected Pegawai Data -->
<?php
  $query                 = "SELECT * FROM pegawai_perpustakaan WHERE nip_pegawai='".$_GET['nip_pegawai']."'";
  $data                  = $conn->prepare($query);
                           $data->execute();
  $adminSelected         = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Get Peminjaman Data -->
<?php
  $query                 = "SELECT * FROM peminjaman WHERE id_peminjaman = '".$_GET['id_peminjaman']."'";
  $data                  = $conn->prepare($query);
                           $data->execute();
  $transactionSelected   = $data->fetch(PDO::FETCH_LAZY);
?>

<!-- Update Status Peminjaman from Selected Peminjaman Data -->
<?php
  $query          = "UPDATE peminjaman SET status = 'Kembali' WHERE id_peminjaman = '".$transactionSelected['id_peminjaman']."'";
  $changeStatus   = $conn->prepare($query);

  // Data Changed
  if($changeStatus->execute()) {
    // Return total book
    $query = "UPDATE buku SET jumlah = jumlah + 1 WHERE id_buku = '".$transactionSelected['id_buku']."'";
    $data  = $conn->prepare($query);
             $data->execute();
    // Back to dashboard
    echo "<script>
            document.location.href='mainPegawai.php?nip_pegawai=".$adminSelected['nip_pegawai']."';
            alert('Status peminjaman buku berhasil diperbarui');
         </script>";
  }
  // Data Unchanged
  else {
    echo "<script>
            alert('Status peminjaman buku gagal diperbarui');
         </script>";
    die();      
  }
?>