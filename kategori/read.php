<?php
require_once('../koneksi/koneksi.php');

// cari data 
$cari = "-1";
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $query = sprintf("SELECT  * FROM kategori WHERE namakategori LIKE %s ORDER BY idkategori ASC",
    inj($koneksi, "%" .$cari . "%", "text"));
}else{
    $query = "SELECT  * FROM kategori ORDER BY idkategori ASC";
}

$eksekusi = mysqli_query($koneksi, $query) or die(errorQuery(mysqli_error($koneksi)));
$row = mysqli_fetch_assoc($eksekusi);
$totalRows = mysqli_num_rows($eksekusi);
?>


<h3>Daftar kategori</h3>
<p><a href="insert.php">Kategori</a></p>

<form action="" method="get">
    Cari Data : <input type="text" name="cari" id="">
    <button type="submit">Search</button>
</form>

<?php if($totalRows > 0){ ?>
<table border="1">
<tr>
    <td>No.</td>
   <td>Nama Kategori</td>
   <td>Keterangan</td>
   <td>Aksi</td>
</tr>

<?php $no = 1; do {?>
<tr>
    <td><?php echo $no;?></td>
    <td><?php echo $row['namakategori'];?></td> 
    <td><?php echo $row['ketkategori'];?></td>
    <td><a href="update.php?id=<?php echo $row['idkategori']?>">Edit</a> | <a href="delete.php?id=<?php echo $row['idkategori']?>b">Hapus</a></td>
</tr>
<?php $no++; }while($row = mysqli_fetch_assoc($eksekusi));?>
</table>
<?php }else{echo "Data Tidak tersedia";}?>