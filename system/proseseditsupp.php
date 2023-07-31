<?php
include("../system/koneksi.php");

if (isset($_POST['btn'])) {
  $id_supp = $_POST['id_supplier'];
  $kd_supp = $_POST['kd_supplier'];
  $supp = $_POST['nm_supp'];
  $no = $_POST['nohp'];
  $em = $_POST['email'];
  $trans = $_POST['trans'];
  $web = $_POST['web'];
  $alm = $_POST['alamat'];	
  $ket = $_POST['keterangan'];	
  
  $result = mysqli_query($mysqli, "UPDATE supplier SET kd_supplier='$kd_supp', nm_supp='$supp', alamat='$alm', nohp='$no', email='$em', website='$web', transaksi='$trans', keterangan='$ket' WHERE Id_supplier='$id_supp'");
  
  header("location: ../pages/supplier.php");
}
?>

