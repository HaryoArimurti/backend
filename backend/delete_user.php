<?php
header('Content-Type: application/json; charset=utf-8');
include 'koneksi.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['id_user'])) {
    echo json_encode(["status" => false, "message" => "id_user wajib diisi"]);
    exit;
}

$id_user = (int)$data['id_user'];

$sql = "DELETE FROM users WHERE id_user = $id_user";

if (mysqli_query($koneksi, $sql)) {
    if (mysqli_affected_rows($koneksi) > 0) {
        echo json_encode(["status" => true, "message" => "Data berhasil dihapus"]);
    } else {
        echo json_encode(["status" => false, "message" => "ID tidak ditemukan"]);
    }
} else {
    echo json_encode(["status" => false, "message" => mysqli_error($koneksi)]);
}
?>