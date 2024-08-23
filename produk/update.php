<?php
require_once('../koneksi/koneksi.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE produk SET kodeproduk = %s, kategori = %s, namaproduk = %s, hargadasar = %s, hargajual = %s, stok = %s WHERE idproduk = %s",
    inj($koneksi, $_POST['kodeproduk'], "text"),
    inj($koneksi, $_POST['kategori'], "int"),
    inj($koneksi, $_POST['namaproduk'], "text"),
    inj($koneksi, $_POST['hargadasar'], "double"),
    inj($koneksi, $_POST['hargajual'], "double"),
    inj($koneksi, $_POST['stok'], "int"),
    inj($koneksi, $_POST['idproduk'], "int"));
    $Result1 = mysqli_query($koneksi, $updateSQL) or die(errorQuery(mysqli_error($koneksi)));
}


$id = "-1";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

//--- query menampilkan kategori
$query_kategori = "SELECT  * FROM kategori ORDER BY idkategori ASC";
$eksekusi_kategori = mysqli_query($koneksi, $query_kategori) or die(errorQuery(mysqli_error($koneksi)));
$row_kategori = mysqli_fetch_assoc($eksekusi_kategori);
$totalRows = mysqli_num_rows($eksekusi_kategori);
// ---

// query produk
$query_produk = sprintf("SELECT  * FROM produk WHERE idproduk = %s  ORDER BY idproduk ASC", inj($koneksi, $id, "int"));
$eksekusi_produk = mysqli_query($koneksi, $query_produk) or die(errorQuery(mysqli_error($koneksi)));
$row_produk = mysqli_fetch_assoc($eksekusi_produk);
$totalRows = mysqli_num_rows($eksekusi_produk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Update data Produk</h3>
    <form action="<?php echo $editFormAction;?>" name="form1" method="POST">
    kode produk : <input type="text" name="kodeproduk" id="" value="<?php echo htmlentities($row_produk['kodeproduk'], ENT_COMPAT, ''); ?>"><br>
    Pilih Kategori : 
    <select name="kategori">
        <?php do { ?>
        <option value="<?php echo $row_kategori['idkategori']; ?>" 
        <?php if (!(strcmp($row_kategori['idkategori'], htmlentities($row_produk['kategori'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>
        <?php echo $row_kategori['namakategori']; ?></option>
        <?php } while ($row_kategori = mysqli_fetch_assoc($eksekusi_kategori)); ?>
     </select>
     <br>
    Nama Produk : <input type="text" name="namaproduk" id="" value="<?php echo htmlentities($row_produk['namaproduk'], ENT_COMPAT, ''); ?>"><br>
    Harga Dasar : <input type="text" name="hargadasar" id="" value="<?php echo htmlentities($row_produk['hargadasar'], ENT_COMPAT, ''); ?>"><br>
    Harga Jual : <input type="text" name="hargajual" id="" value="<?php echo htmlentities($row_produk['hargajual'], ENT_COMPAT, ''); ?>"><br>
    Stok : <input type="text" name="stok" id="" value="<?php echo htmlentities($row_produk['stok'], ENT_COMPAT, ''); ?>"><br>
     <button type="submit">Simpan</button>
        <button><a href="read.php">Kembali</a></button>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="idproduk" id="" value="<?php echo htmlentities($row_produk['idproduk'], ENT_COMPAT, ''); ?>"><br>

    </form>
</body>
</html> 