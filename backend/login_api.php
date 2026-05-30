<?php
header("Content-Type: application/json");
include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = md5($data['password'] ?? '');

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($query) > 0){
    $user = mysqli_fetch_assoc($query);
    echo json_encode(["status" => true, "message" => "Login berhasil", "data" => $user]);
} else {
    echo json_encode(["status" => false, "message" => "Email atau password salah"]);
}
?>