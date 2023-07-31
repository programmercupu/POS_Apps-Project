<?php
session_start();
include("../system/koneksi.php");

$kd_cust = $_GET['id_cust'];

$result= mysqli_query($mysqli, "DELETE from customer where kd_customer='$kd_cust'");
$_SESSION['pesan'] = "Supplier dengan kode \"" . $kd_brg . "\" berhasil dihapus";
header("location: ../pages/Cust.php");
?>