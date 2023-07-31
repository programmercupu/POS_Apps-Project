<?php
// Mengambil nilai SQL dari parameter GET
$sql = $_GET['sql'];

// Koneksi ke database (sesuaikan dengan konfigurasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_apps";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Menjalankan pernyataan SQL
$result = $conn->query($sql);

// Memeriksa hasil query
if ($result === false) {
  die("Query error: " . $conn->error);
}

// Mengambil hasil query dalam bentuk array
$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row['nm_barang'];
}

// Mengirimkan hasil sebagai respons JSON
$response = array('data' => $data);
echo json_encode($response);

// Menutup koneksi
$conn->close();
?>
