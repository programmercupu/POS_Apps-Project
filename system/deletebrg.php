<?php
session_start();
include("../system/koneksi.php");

$kd_brg = $_GET['id_brg'];

$result= mysqli_query($mysqli, "DELETE from product where kd_barang='$kd_brg'");
$_SESSION['pesan'] = "Barang dengan kode \"" . $kd_brg . "\" berhasil dihapus";
header("location: ../pages/Mproduct.php");
?>