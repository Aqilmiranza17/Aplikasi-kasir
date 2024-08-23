<?php
require_once('../koneksi/koneksi.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    // //jika input data kosong
    // if (empty($_POST['userkassa']) || empty($_POST['pwdkassa']) || empty($_POST['fullname']) || empty($_POST['jkkassa'])) {
    //     die('Error: Semua field harus diisi.');}
        $insertSQL = sprintf("INSERT INTO kategori (namakategori, ketkategori) VALUES (%s, %s)",
            inj($koneksi, $_POST['namakategori'], "text"),
	        inj($koneksi, $_POST['ketkategori'], "text"));
        $Result1 = mysqli_query($koneksi, $insertSQL) or die(errorQuery(mysqli_error($koneksi)));
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
    <h3>Insert data kategori</h3>
    <form action="<?php echo $editFormAction;?>" name="form1" method="POST">
        <input type="text" name="namakategori" id="" placeholder="Nama Kategori"><br>
        <input type="text" name="ketkategori" id="" placeholder="Keterangan Kategori"><br>
        <button type="submit">Simpan</button>
        <button><a href="read.php">Liat Data</a></button>
        <input type="hidden" name="MM_insert" value="form1">
    </form>
</body>
</html>