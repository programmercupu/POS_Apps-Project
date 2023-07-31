<?php
// Koneksi ke database
$mysqli = new mysqli('localhost', 'root', '', 'pos_apps');

// Memastikan koneksi sukses
if ($mysqli->connect_error) {
    die('Koneksi ke database gagal: ' . $mysqli->connect_error);
}

// Menerima kata kunci pencarian dari permintaan Ajax
$searchTerm = $_GET['term'];

// Membuat query untuk mengambil data produk berdasarkan kata kunci
$query = "SELECT * FROM product WHERE nama_brg LIKE '%$searchTerm%' OR supplier LIKE '%$searchTerm%' LIMIT 5";
$result = $mysqli->query($query);

// Mengambil hasil query dan menyimpannya dalam array
$products = array();
while ($row = $result->fetch_assoc()) {
    $product = array(
        'id' => $row['id_barang'],
        'text' => $row['nama_brg'],
        'supplier' => $row['supplier'],
        'stok' => $row['stok'],
        'harga' => $row['harga'],
        'jenis' => $row['jenis'],
        'deskripsi' => $row['desk']
    );
    $products[] = $product;
}

// Mengirim data produk dalam format JSON
echo json_encode($products);
