<?php
// Try connecting to the localhost server  
try {
  $conn = new PDO('mysql:host=localhost; dbname=perpus', 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Connected
  echo "<script>console.log('Database connected.')</script>";
} catch (PDOException $p) {
  // Failed to connect
  print $p->getMessage();
  die();
}

try {
  $dbh = new PDO('mysql:host=localhost; dbname=perpus', 'root', '');
} catch (PDOException $e) {
  echo 'Koneksi gagal: ' . $e->getMessage();
}