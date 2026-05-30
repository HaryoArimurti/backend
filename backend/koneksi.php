<?php
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_backend"
);

if(!$koneksi){
    die("Koneksi gagal");
}
?>