<?php
require_once('../tcpdf/tcpdf.php');
include("../system/koneksi.php");

// Query untuk mendapatkan data transaksi dengan kd_trans yang dimulai dengan dua huruf 'TB'
$query = "SELECT * FROM detailbrg WHERE LEFT(kd_trans, 2) = 'TB'";
$result = mysqli_query($mysqli, $query);

// Membuat objek TCPDF dengan orientasi landscape
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Laporan Transaksi Pembelian Detil Barang');
$pdf->SetSubject('Laporan Transaksi Pembelian Detil Barang');
$pdf->SetKeywords('Laporan, TCPDF, PHP');

// Set margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Header laporan
$pdf->Cell(0, 10, 'Laporan Transaksi Pembelian Detil Barang', 0, 1, 'C');
$pdf->Ln(8);

// Tabel data transaksi
$pdf->SetFont('helvetica', 'B', 12); 
$pdf->Cell(40, 10, 'Kode Transaksi', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(45, 10, 'Supplier', 1, 0, 'C');
$pdf->Cell(30, 10, 'Harga', 1, 0, 'C');
$pdf->Cell(40, 10, 'Jumlah Barang', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 12);

// Loop untuk menampilkan data transaksi
while ($row = mysqli_fetch_array($result)) { 
    $pdf->Cell(40, 10, $row['kd_trans'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['nm_brg'], 1, 0, 'C');
    $pdf->Cell(45, 10, $row['supp'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['harga'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['totalbeli'], 1, 1, 'C'); // Gunakan 1 pada parameter terakhir untuk pindah ke baris baru setelah sel selesai.
}

// Output PDF
$pdf->Output('laporan_transaksi_buy.pdf', 'I');
?>
