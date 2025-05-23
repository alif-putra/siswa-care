<?php
$host = "localhost";
$user = "root"; 
$pass = "";
$db   = "db_siswacare";

$conn = mysqli_connect($host, $user, $pass, $db); //konksi database nya

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
