<?php
require_once('../koneksi/koneksi.php');

$query = "SELECT produk.*, namakategori FROM produk
LEFT JOIN kategori ON idkategori = kategori
ORDER BY idproduk ASC";
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
<a href="insert.php">Produk</a>
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

</body>
</html>