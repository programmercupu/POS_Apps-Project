<?php
include("../system/koneksi.php");

if (isset($_POST['btn'])) {
  $id_brg = $_POST['id_barang'];
  $kd_brg = $_POST['kd_barang'];
  $supp = $_POST['supplier'];
  $stk = $_POST['stok'];
  $jns = $_POST['jenis'];
  $nm = $_POST['nama_brg'];
  $kd_sku = $_POST['kode_SKU'];
  $hrg = $_POST['harga'];	
  $desk = $_POST['deskripsi'];	
  
  $result = mysqli_query($mysqli, "UPDATE product SET kd_barang='$kd_brg', nama_brg='$nm', supplier='$supp', kode_SKU='$kd_sku', stok='$stk', harga='$hrg', jenis='$jns', desk='$desk' WHERE Id_barang='$id_brg'");
  
  header("location: ../pages/Mproduct.php");
}
?>

