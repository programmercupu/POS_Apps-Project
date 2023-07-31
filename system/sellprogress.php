<?php
include("koneksi.php")
?>
<?php
// Memastikan koneksi sukses
if ($mysqli->connect_error) {
    die('Koneksi ke database gagal: ' . $mysqli->connect_error);
}

// Mendapatkan nilai dari HTML untuk keperluan table transaction
$kd_trans = $_POST['kd_trans'];
$customer = $_POST['customer'];
date_default_timezone_set("Asia/Jakarta");
$inptanggal = date('Y-m-d H:i:s');
$jenis = "Sell";
$totalHarga= 0;
$pem= $_POST['pem'];




$temporaryData = $_POST['temporaryData2'];

$dom = new DOMDocument();
$dom->loadHTML($temporaryData);

$tbody = $dom->getElementsByTagName('tbody')->item(0);
$rows = $tbody->getElementsByTagName('tr');

foreach ($rows as $row) {
    $columns = $row->getElementsByTagName('td');
    $kd_brg = $columns->item(0)->nodeValue;
    $nm_brg = $columns->item(1)->nodeValue;
    $supp = $columns->item(3)->nodeValue;
    $harga = $columns->item(2)->nodeValue;
    $totalbeli = $columns->item(4)->nodeValue;
    
    $subTotal = $harga * $totalbeli;
    $totalHarga += $subTotal;
    $discount = 0;

    $queryUpdate = "UPDATE product SET stok = stok - '$totalbeli' WHERE kd_barang = '$kd_brg'";
    $resultUpdate = $mysqli->query($queryUpdate);

    if (!$updateResult) {
        echo "Error mengupdate stok: " . $mysqli->error;
    }

    $query = "INSERT INTO detailbrg (kd_trans, nm_brg, supp, harga, totalbeli) VALUES ('$kd_trans', '$nm_brg', '$supp', '$harga', '$totalbeli')";
    $result = $mysqli->query($query);
    
    if (!$result) {
        echo "Error: " . $mysqli->error;
    }
    
}
    $query2 = "INSERT INTO transaction (kd_trans, customer, tgl_trans, Jenis, diskon, total, pembayaran) VALUES ('$kd_trans', '$customer', '$inptanggal', '$jenis', '$discount', '$totalHarga', '$pem')";
    $result2 = $mysqli->query($query2);




$mysqli->close();

    header("location:../pages/buysell.php");
	session_start();
	$_SESSION['pesan'] = "Oke Barang Telah Berhasil Terjual";
?>
