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

    // Convert to excel (.xls)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="laporan-buku-excel.xls"');
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
    </head>
    <body>
        <!-- Container -->
        <div>
            <!-- Title -->
            <h1><?= $reportBookText; ?></h1>
            <!-- Table -->
            <table>
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
                        <tr>
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
    </body>
</html>