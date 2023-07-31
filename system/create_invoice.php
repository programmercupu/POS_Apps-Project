<?php
require_once('../tcpdf/tcpdf.php');
include("../system/koneksi.php");

// Mendapatkan kode transaksi dari URL
$kode_trans = $_GET['kd_barang'];

// Query untuk mendapatkan informasi transaksi
$query_trans = "SELECT * FROM transaction WHERE kd_trans='$kode_trans'";
$result_trans = mysqli_query($mysqli, $query_trans);

if (mysqli_num_rows($result_trans) > 0) {
    // Data transaksi ditemukan
    $row_trans = mysqli_fetch_assoc($result_trans);
    $customer = $row_trans['customer'];
    $tgl_trans = $row_trans['tgl_trans'];
    $jenis = $row_trans['Jenis'];
    $diskon = $row_trans['diskon'];
    $total_harga = $row_trans['Total'];
    $pembayaran = $row_trans['Pembayaran'];

    // Membuat objek TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Company');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('Invoice, TCPDF, PHP');
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Menambahkan halaman baru
    $pdf->AddPage();

    // Menampilkan informasi transaksi pada PDF
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(50, 10, 'Kode Transaksi:', 0, 0, 'L');
    $pdf->Cell(0, 10, $kode_trans, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Customer:', 0, 0, 'L');
    $pdf->Cell(0, 10, $customer, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Tanggal Transaksi:', 0, 0, 'L');
    $pdf->Cell(0, 10, $tgl_trans, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Jenis Transaksi:', 0, 0, 'L');
    $pdf->Cell(0, 10, $jenis, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Diskon:', 0, 0, 'L');
    $pdf->Cell(0, 10, $diskon, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Total Harga:', 0, 0, 'L');
    $pdf->Cell(0, 10, $total_harga, 0, 1, 'L');

    $pdf->Cell(50, 10, 'Pembayaran:', 0, 0, 'L');
    $pdf->Cell(0, 10, $pembayaran, 0, 1, 'L');

    $pdf->Ln(10);

    // Query untuk mendapatkan detail barang
    $query_detail_barang = "SELECT * FROM detailbrg WHERE kd_trans='$kode_trans'";
    $result_detail_barang = mysqli_query($mysqli, $query_detail_barang);

    // Menampilkan tabel detail barang pada PDF
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(55, 10, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Supplier', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Harga', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Jumlah Beli', 1, 0, 'C');
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 12);
    while ($row_barang = mysqli_fetch_array($result_detail_barang)) {
        $nama_barang = $row_barang['nm_brg'];
        $harga = $row_barang['supp'];
        $jumlah_beli = $row_barang['harga'];
        $total_harga_barang = $row_barang['totalbeli'];

        $pdf->Cell(55, 10, $nama_barang, 1, 0, 'C');
        $pdf->Cell(40, 10, $harga, 1, 0, 'C');
        $pdf->Cell(40, 10, $jumlah_beli, 1, 0, 'C');
        $pdf->Cell(40, 10, $total_harga_barang, 1, 0, 'C');
        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output('invoice.pdf', 'I');
} else {
    // Data transaksi tidak ditemukan
    echo "Data transaksi tidak ditemukan.";
    exit;
}
