<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$servername = "mysql-reylangko.alwaysdata.net";
$username = "reylangko";
$password = "lapelangko";
$dbname = "reylangko_tugas_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  echo json_encode([]);
  exit;
}

$sql = "SELECT nama, file_link, status, uploaded_at FROM riwayat_upload ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>