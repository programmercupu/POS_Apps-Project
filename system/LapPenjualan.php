<?php
require_once('../tcpdf/tcpdf.php');
include("../system/koneksi.php");

// Query untuk mendapatkan data transaksi jenis 'sell'
$query = "SELECT * FROM Transaction WHERE jenis = 'sell'";
$result = mysqli_query($mysqli, $query);

// Membuat objek TCPDF dengan orientasi landscape
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Laporan Transaksi Jenis Buy');
$pdf->SetSubject('Laporan Transaksi Jenis Buy');
$pdf->SetKeywords('Laporan, TCPDF, PHP');

// Set margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set font
$pdf->SetFont('helvetica', '', 12);

$grandTotal = 0;
// Add a page
$pdf->AddPage();

// Header laporan
$pdf->Cell(0, 10, 'Laporan Transaksi Penjualan', 0, 1, 'C');
$pdf->Ln(8);

// Tabel data transaksi
$pdf->SetFont('helvetica', 'B', 12); 
$pdf->Cell(40, 10, 'Kode Transaksi', 1, 0, 'C');
$pdf->Cell(40, 10, 'Customer', 1, 0, 'C');
$pdf->Cell(45, 10, 'Tanggal', 1, 0, 'C');
$pdf->Cell(30, 10, 'Jenis', 1, 0, 'C');
$pdf->Cell(20, 10, 'Diskon', 1, 0, 'C'); 
$pdf->Cell(30, 10, 'Pembayaran', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 12);

// Loop untuk menampilkan data transaksi
while ($row = mysqli_fetch_array($result)) { 
    $pdf->Cell(40, 10, $row['kd_trans'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['customer'], 1, 0, 'C');
    $pdf->Cell(45, 10, $row['tgl_trans'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['Jenis'], 1, 0, 'C');
    $pdf->Cell(20, 10, $row['diskon'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['Pembayaran'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['Total'], 1, 1, 'C');
    
    $grandTotal += $row['Total'];
}
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(205, 10, 'Grand Total', 1, 0, 'R');
$pdf->Cell(30, 10, $grandTotal, 1, 1, 'C');
// Output PDF
$pdf->Output('laporan_transaksi_buy.pdf', 'I');
?>
