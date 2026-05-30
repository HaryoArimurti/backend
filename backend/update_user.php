]<?php
header('Content-Type: application/json; charset=utf-8');
include 'koneksi.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['id_user']) || !isset($data['nama'])) {
    echo json_encode(["status" => false, "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = (int)$data['id_user'];
$nama = mysqli_real_escape_string($koneksi, $data['nama']);

$sql = "UPDATE users SET nama = '$nama' WHERE id_user = $id_user";

if (mysqli_query($koneksi, $sql)) {
    echo json_encode(["status" => true, "message" => "Data berhasil diupdate"]);
} else {
    echo json_encode(["status" => false, "message" => mysqli_error($koneksi)]);
}
?>