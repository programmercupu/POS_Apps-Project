<?php
include("../system/koneksi.php");

// Query untuk menghitung grand total dari transaksi jenis 'sell'
$queryTotal = "SELECT SUM(Total) AS grand_total FROM Transaction WHERE jenis = 'sell'";
$resultTotal = mysqli_query($mysqli, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$grandTotal = $rowTotal['grand_total'];

$queryTotal2 = "SELECT SUM(Total) AS grand_total FROM Transaction WHERE jenis = 'buy'";
$resultTotal2 = mysqli_query($mysqli, $queryTotal2);
$rowTotal2 = mysqli_fetch_assoc($resultTotal2);
$grandTotal2 = $rowTotal2['grand_total'];

$queryTotalCustomer = "SELECT COUNT(*) AS total_customer FROM customer";
$resultTotalCustomer = mysqli_query($mysqli, $queryTotalCustomer);
$rowTotalCustomer = mysqli_fetch_assoc($resultTotalCustomer);
$totalCustomer = $rowTotalCustomer['total_customer'];

$queryTotalSupplier = "SELECT COUNT(*) AS total_supplier FROM supplier";
$resultTotalSupplier = mysqli_query($mysqli, $queryTotalSupplier);
$rowTotalSupplier = mysqli_fetch_assoc($resultTotalSupplier);
$totalSupplier = $rowTotalSupplier['total_supplier'];
?>