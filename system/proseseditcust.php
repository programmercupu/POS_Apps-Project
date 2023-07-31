<?php
include("../system/koneksi.php");

if (isset($_POST['btn'])) {
  $id_cust = $_POST['id_cust'];
  $kd_cust = $_POST['kd_cust'];
  $nm = $_POST['nm'];
  $alm = $_POST['alm'];
  $no = $_POST['nohp']; 
  
  $result = mysqli_query($mysqli, "UPDATE customer SET kd_customer='$kd_cust', nama='$nm', alamat='$alm', nohp='$no' WHERE id_customer='$id_cust'");
  
  header("location: ../pages/cust.php");
}
?>

