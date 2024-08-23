<?php
require_once('../koneksi/koneksi.php');
$query = "SELECT  * FROM kategori ORDER BY idkategori ASC";
$eksekusi = mysqli_query($koneksi, $query) or die(errorQuery(mysqli_error($koneksi)));
$row = mysqli_fetch_assoc($eksekusi);
$totalRows = mysqli_num_rows($eksekusi);

// simpan data
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
        $insertSQL = sprintf("INSERT INTO produk (kodeproduk, kategori, namaproduk, hargadasar, hargajual, stok) VALUES (%s, %s, %s, %s, %s, %s)",
                       inj($koneksi, $_POST['kodeproduk'], "text"),
                       inj($koneksi, $_POST['kategori'], "int"),
                       inj($koneksi, $_POST['namaproduk'], "text"),
                       inj($koneksi, $_POST['hargadasar'], "double"),
                       inj($koneksi, $_POST['hargajual'], "double"),
                       inj($koneksi, $_POST['stok'], "int"));
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
     <h3>Insert Data Produk</h3>
     <form action="<?php echo $editFormAction; ?>" method="post" name="form1">
     <input type="text" name="kodeproduk" id="" placeholder="kode produk"><br>
     Pilih Kategori : 
     <select name="kategori">
        <?php do { ?>
        <option value="<?php echo $row['idkategori']; ?>" ><?php echo $row['namakategori']; ?></option>
        <?php } while ($row = mysqli_fetch_assoc($eksekusi)); ?>
     </select><br>
     <input type="text" name="namaproduk" id="" placeholder="nama produk"><br>
     <input type="text" name="hargadasar" id="" placeholder="harga dasar"><br>
     <input type="text" name="hargajual" id="" placeholder="harga jual"><br>
     <input type="text" name="stok" id="" placeholder="stok"><br>
     <input type="hidden" name="MM_insert" value="form1">
     <button type="submit">Simpan</button>
     <button><a href="read.php">Lihat Produk</a></button>
     </form>
</body>
</html>