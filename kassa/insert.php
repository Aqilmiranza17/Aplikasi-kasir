<?php
require_once('../koneksi/koneksi.php');

     $editFormAction = $_SERVER['PHP_SELF'];
     if (isset($_SERVER['QUERY_STRING'])) {
     $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
     }
     
     if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
     //jika input data kosong
          if (empty($_POST['userkassa']) || empty($_POST['pwdkassa']) || empty($_POST['fullname']) || empty($_POST['jkkassa'])) {
               die('Error: Semua field harus diisi.');}
          $insertSQL = sprintf("INSERT INTO kassa (userkassa, pwdkassa, fullname, jkkassa) VALUES (%s, %s, %s, %s)",
          inj($koneksi, $_POST['userkassa'], "text"),
          inj($koneksi, $_POST['pwdkassa'], "text"),
          inj($koneksi, $_POST['fullname'], "text"),
          inj($koneksi, $_POST['jkkassa'], "text"));
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
     <h3>Insert Data Kassa</h3>
     <form action="<?php echo $editFormAction?>" method="POST" name="form1">
          <input type="text" name="userkassa" id="" placeholder="Username"><br>
          <input type="password" name="pwdkassa" id="" placeholder="Password"><br>
          <input type="text" name="fullname" id="" placeholder="Nama Lengkap"><br>
          <p>Jenis Kelamin:</p>
          <input type="radio" name="jkkassa" value="L" <?php if (!(strcmp("L","L"))) {echo "CHECKED";} ?> />Laki-laki
          <input type="radio" name="jkkassa" value="P" <?php if (!(strcmp("L","P"))) {echo "CHECKED";} ?> />Perempuan
          <br>
          <button type="submit">Simpan</button>
          <button><a href="read.php">Lihat Data Kassa</a></button>
          <input type="hidden" name="MM_insert" value="form1">
     </form>
</body>
</html>