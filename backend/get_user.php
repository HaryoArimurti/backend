<?php
header("Content-Type: application/json");
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM users");
$data = [];
while($d = mysqli_fetch_assoc($query)){
    $data[] = $d;
}
echo json_encode(["status" => true, "data" => $data]);
?>