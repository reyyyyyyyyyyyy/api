<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
  http_response_code(200);
  exit;
}

$servername = "mysql-reylangko.alwaysdata.net";
$username = "reylangko";
$password = "lapelangko";
$dbname = "reylangko_tugas_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["nama"]) || !isset($data["file_link"])) {
  echo json_encode(["error" => "Missing fields"]);
  exit;
}

$nama = $conn->real_escape_string($data["nama"]);
$link = $conn->real_escape_string($data["file_link"]);

$sql = "INSERT INTO riwayat_upload (nama, file_link, status) VALUES ('$nama', '$link', 'Terkumpul')";
if ($conn->query($sql) === TRUE) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
