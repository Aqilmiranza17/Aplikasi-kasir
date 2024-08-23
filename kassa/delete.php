<?php
require_once('../koneksi/koneksi.php');
if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
    $deleteSQL = sprintf("DELETE FROM kassa WHERE idkassa = %s",
    inj($koneksi, $_GET['id'], "int"));
    $Result1 = mysqli_query($koneksi, $deleteSQL) or die(errorQuery(mysqli_error($koneksi))); 
  }
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Data berhasil dihapus</h3>
    <a href="read.php">Kembali</a>
</body>
</html>