<?php
require_once('../koneksi/koneksi.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE kategori SET namakategori =%s, ketkategori=%s WHERE idkategori=%s",
     inj($koneksi, $_POST['namakategori'], "text"),
	 inj($koneksi, $_POST['ketkategori'], "text"),
	 inj($koneksi, $_POST['idkategori'], "int"));
    $Result1 = mysqli_query($koneksi, $updateSQL) or die(errorQuery(mysqli_error($koneksi)));
}


$id = "-1";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$query = sprintf("SELECT  * FROM kategori WHERE idkategori = %s  ORDER BY idkategori ASC", inj($koneksi, $id, "int"));
$eksekusi = mysqli_query($koneksi, $query) or die(errorQuery(mysqli_error($koneksi)));
$row = mysqli_fetch_assoc($eksekusi);
$totalRows = mysqli_num_rows($eksekusi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Update data kategori</h3>
    <form action="<?php echo $editFormAction;?>" name="form1" method="POST">
        <input type="text" name="namakategori" id="" value="<?php echo htmlentities($row['namakategori'], ENT_COMPAT, ''); ?>"><br>
        <input type="text" name="ketkategori" id="" value="<?php echo htmlentities($row['ketkategori'], ENT_COMPAT, ''); ?>"><br>
        <button type="submit">Simpan</button>
        <button><a href="read.php">Kembali</a></button>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="idkategori" id="" value="<?php echo htmlentities($row['idkategori'], ENT_COMPAT, ''); ?>"><br>

    </form>
</body>
</html>