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

<!-- Get Book Data -->
<?php
  $query          = 'SELECT * FROM buku';
  $data           = $conn->prepare($query);
                    $data->execute();
  $bookData       = $data->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <!-- Page Title -->
        <title><?= $bookDataText. $webName; ?></title>
        <!-- Favicon -->
        <link rel='icon' type='image/x-icon' href='../../Image/Assets/perpus-icon.png' />
        <!-- External CSS -->
        <link rel='stylesheet' type='text/css' href='../styles.css' />
        <!-- Google Font API -->
        <link rel='preconnect' href='https://fonts.googleapis.com' />
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
        <link href='https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet' />
        <link rel='stylesheet' href='https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css' />
        <script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js'></script>
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
                    <?= strtok($adminSelected['nama_pegawai'], " "); ?>
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
                <?php echo $helloText . ' ' . strtok($adminSelected['nama_pegawai'], ' ') . ' !'; ?>
                <img class='header-photo-profile' src='../../Image/Pegawai/<?= $adminSelected['foto_profil_pegawai']; ?>' />
            </div>
        </div>
        <!-- Master Data -->
        <div class='master-data-book'>
            <!-- Add Button -->
            <div class='add-button'>
                <a href="tambahBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai']; ?>" class='add-button-text'>
                    <?= '+ ' . $addBookText; ?>
                </a>
            </div>
            <!-- Table Data -->
            <div class='card'>
                <h1 class='card-title'><?= $bookDataText; ?></h1>
                <table id='myTable'>    
                    <!-- Column Title -->
                    <thead>
                        <tr>
                            <th><?= $bookIdText; ?></th>
                            <th><?= $bookCoverText; ?></th>
                            <th><?= str_replace('Buku', '', $bookNameText); ?></th>
                            <th><?= str_replace('Buku', '', $bookAuthorText); ?></th>
                            <th><?= str_replace('Buku', '', $bookTotalText); ?></th>
                            <th><?= $optionText; ?></th>    
                        </tr>
                    </thead>
                    <!-- Column Data -->
                    <tbody>
                        <?php foreach($bookData as $td) : ?>
                        <tr>
                            <td class='column-id-book'><?= $td['id_buku']; ?></td>
                            <td class='column-book-cover'><img src="../../Image/Buku/<?= $td['cover_buku']; ?>" class='cover-book'></td>
                            <td class='column-book-title'><?= $td['judul_buku']; ?></td>
                            <td class='column-book-author'><?= $td['pengarang']; ?></td>
                            <td class='column-book-total'><?= $td['jumlah']; ?></td>
                            <td class='column-book-option'>
                                <!-- Edit -->
                                <a href="editBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai'];?> & id_buku=<?= $td['id_buku'];?> ">
                                    <img src='../../Image/Assets/edit-icon.png' class='edit-button' />
                                </a>
                                <!-- Delete -->
                                <a href="hapusBuku.php?nip_pegawai=<?= $adminSelected['nip_pegawai'];?> & id_buku=<?= $td['id_buku'];?> ">
                                    <img src='../../Image/Assets/delete-icon.png' class='delete-button' />
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Hide Content -->
            <p style='visibility: hidden;'>
                <?= $hideContent; ?>
            </p>
        </div>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "drawCallback": function(settings) {
                $('p').css('margin-top', '2px');
            }
        });
    });
</script>