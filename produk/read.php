<?php
require_once('../koneksi/koneksi.php');

// cari data 
$cari = "-1";
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $query = sprintf("SELECT produk.*, namakategori FROM produk
    LEFT JOIN kategori ON idkategori = kategori
    WHERE kategori.namakategori LIKE %s OR produk.namaproduk LIKE %s 
    ORDER BY idproduk ASC",
    inj($koneksi, "%" .$cari . "%", "text"),
    inj($koneksi, "%" .$cari . "%", "text"));
}else {
    $query = "SELECT produk.*, namakategori FROM produk
    LEFT JOIN kategori ON idkategori = kategori
    ORDER BY idproduk ASC";
}

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

<h3>Daftar Produk</h3>
<p><a href="insert.php">Produk</a></p>
<form action="" method="get">
    Cari Data Barang : <input type="text" name="cari" id="">
    <button type="submit">Search</button>
</form>
<br>
<?php if($totalRows > 0) {?>
<table border="1">
<tr>
   <td>No.</td>
   <td>KODE PRODUK</td>
   <td>KATEGORI</td>
   <td>NAMA PRODUK</td>
   <td>HARGA DASAR</td>
   <td>HARGA JUAL</td>
   <td>STOK</td>
   <td>Aksi</td>
</tr>

 <?php $no = 1; do {?>
<tr>
    <td><?php echo $no;?></td>
    <td><?php echo $row['kodeproduk'];?></td> 
    <td><?php echo $row['namakategori'];?></td>
    <td><?php echo $row['namaproduk'];?></td>
    <td><?php echo $row['hargadasar'];?></td>
    <td><?php echo $row['hargajual'];?></td>
    <td><?php echo $row['stok'];?></td>
    <td><a href="update.php?id=<?php echo $row['idproduk']?>">Edit</a> | <a href="delete.php?id=<?php echo $row['idproduk']?>b">Hapus</a></td>
</tr>
<?php $no++; }while($row = mysqli_fetch_assoc($eksekusi));?>
</table>
<?php }else {
    echo "Data Produk tidak tersedia";
}?>

</body>
</html>