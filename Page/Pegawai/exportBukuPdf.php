<!-- Import Code Files -->
<?php
    require_once '../connect.php';
    require_once '../variable.php';
?>

<!-- Get Selected Buku Data -->
<?php
    $query = 'SELECT * FROM buku';
    $data  = $conn->prepare($query);
             $data->execute();
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <!-- Page Title -->
        <title><?php echo $reportBookText . ' (PDF)'; ?></title>
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
        <center>
            <!-- Container -->
            <div style='width:100%'>
                <!-- Title -->
                <h1><?= $reportBookText; ?></h1>
                <!-- Table -->
                <table class='table-pdf'>
                    <!-- Column Title -->
                    <thead>
                        <tr>
                            <th><?= $bookNameText; ?></th>
                            <th><?= $bookYearText; ?></th>
                            <th><?= $bookTypeText; ?></th>
                            <th><?= $bookTotalText; ?></th>
                            <th><?= $bookAuthorText; ?></th>
                            <th><?= $bookPublisherText; ?></th>
                        </tr>
                    </thead>
                    <!-- Column Data -->
                    <tbody>
                        <?php foreach ($data as $td) : ?>
                            <tr style='background-color: lightgray'>
                                <td><?= $td['judul_buku'] ?></td>
                                <td><?= $td['tahun_terbit'] ?></td>
                                <td><?= $td['jenis_buku'] ?></td>
                                <td><?= $td['jumlah'] ?></td>
                                <td><?= $td['pengarang'] ?></td>
                                <td><?= $td['penerbit'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </center>
    </body>
</html>

<!-- Print to PDF -->
<script>window.print()</script>