<?php
header("Content-Type: application/json");
include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);
$nama = $data['nama'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if($nama == '' || $email == '' || $password == ''){
    echo json_encode(["status" => false, "message" => "Data belum lengkap"]);
    exit;
}

$password = md5($password);
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($cek) > 0){
    echo json_encode(["status" => false, "message" => "Email sudah digunakan"]);
    exit;
}

$query = mysqli_query($koneksi, "INSERT INTO users(nama,email,password) VALUES('$nama','$email','$password')");

if($query){
    echo json_encode(["status" => true, "message" => "Register berhasil"]);
} else {
    echo json_encode(["status" => false, "message" => "Register gagal"]);
}
?>