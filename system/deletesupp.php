<?php
session_start();
include("../system/koneksi.php");

$kd_supp = $_GET['id_brg'];

$result= mysqli_query($mysqli, "DELETE from supplier where kd_supplier='$kd_supp'");
$_SESSION['pesan'] = "Supplier dengan kode \"" . $kd_brg . "\" berhasil dihapus";
header("location: ../pages/supplier.php");
?>