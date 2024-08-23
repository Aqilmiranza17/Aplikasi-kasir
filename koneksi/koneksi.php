<?php
$hostname_koneksi = "localhost";
$database_koneksi = "pos";
$username_koneksi = "root";
$password_koneksi = "";
$koneksi = mysqli_connect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysqli_error($koneksi),E_USER_ERROR); 
mysqli_select_db($koneksi, $database_koneksi);

// fungsi sanitasi untuk mencegah sql injection----
if (!function_exists("inj")) {
    function inj($koneksi, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      // $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    
      $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($koneksi,$theValue) : mysqli_escape_string($koneksi,$theValue);
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
    }

// --- fungsi sanitasi

// fungsi kembali ----
function back() {
  echo '<button onclick="window.history.go(-1); return false;"> Go Back</button>';
}

// --- fungsi kembali

// fungsi untuk menampilkan error ---
function errorQuery($isi) {
  back(); 
  echo "<br>    
  <h4>Oops! Ada yang salah</h4>
  <strong>Pesan Kesalahan : </strong>".$isi."</div>";
}

// --- fungsi untuk menampilkan error

?>