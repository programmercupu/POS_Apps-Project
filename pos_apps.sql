-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 07:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `kd_customer` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `kd_customer`, `nama`, `alamat`, `nohp`) VALUES
(1, 'C01', 'Guest', 'Non Using this field', 'Null');

-- --------------------------------------------------------

--
-- Table structure for table `detailbrg`
--

CREATE TABLE `detailbrg` (
  `id_brg` int(11) NOT NULL,
  `kd_trans` varchar(25) NOT NULL,
  `nm_brg` varchar(50) NOT NULL,
  `supp` varchar(50) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `totalbeli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_barang` int(11) NOT NULL,
  `kd_barang` char(25) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `kode_SKU` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `desk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_barang`, `kd_barang`, `nama_brg`, `supplier`, `kode_SKU`, `stok`, `harga`, `jenis`, `desk`) VALUES
(1, 'B1', 'Mie Sedap Bolognisee', 'PT Indofoods', '123456MSB', 50, 4000, 'makanan instan', 'Mie instan rasa bolognisee'),
(2, 'B2', 'La Fonte', 'SerealKuat.TBK', '123445LF', 45, 8000, 'makanan instan', 'Makanan Khas Italia'),
(3, 'B3', 'Beras Pulen 1Kg', 'PT Indofoods', '123456BSG', 22, 25000, 'Bahan Pokok', 'Beras dari jawa asli'),
(4, 'B4', 'Indomie Aceh ', 'PT Indofoods', '123445IA', 43, 4000, 'makanan instan', 'mie dari aceh nih boss'),
(5, 'B5', 'La Fonte Fettucini', 'SerealKuat.TBK', '123445LFF', 30, 8500, 'makanan instan', '- heheh'),
(6, 'B6', 'Minyak Goreng Sanco 1L', 'PT RoyalCheese', '1234123MG', 50, 15000, 'Bahan Pokok', 'asdad'),
(7, 'B7', 'Super Bubur Abon', 'PT RoyalCheese', '321321SB', 30, 8500, 'makanan instan', 'asdadsa'),
(8, 'B8', 'Beras Banjar 1kg', 'PT RoyalCheese', '123445BBS', 30, 20000, 'Bahan Pokok', 'Blablablablabla');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `Saldo_Pemasukan` bigint(20) NOT NULL,
  `Saldo_Pengeluaran` bigint(20) NOT NULL,
  `Grand_Saldo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `kd_supplier` varchar(25) NOT NULL,
  `nm_supp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `website` varchar(50) NOT NULL,
  `transaksi` bigint(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `kd_supplier`, `nm_supp`, `alamat`, `nohp`, `email`, `website`, `transaksi`, `keterangan`) VALUES
(1, 'S1', 'PT RoyalCheese', 'Jl.Kaliurang, Sleman, DIY Yogyakarta. 77115', '087987877898', 'Royalofficial_@org.id', 'www.ptroyalofficial.com', 6, 'ini perusahaan asing dari italia'),
(2, 'S2', 'PT Indofoods', 'Jl.Karawang, jakarta utara, DI Jakarta', '080808080808', 'indofods@rocketmail.co.id', 'www.indofods.co.id', 3, 'tidak ada dulu sementara ini'),
(3, 'S3', 'SerealKuat.TBK', 'Jl Kepuh GK III No 886 Klitren Kec Gondokusuma', '082251820012', 'serealindo@yahoo.com', 'www.serealindo.com', 0, 'ini perusahaan sereal baru buka');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_trans` int(11) NOT NULL,
  `kd_trans` varchar(25) NOT NULL,
  `customer` varchar(25) NOT NULL,
  `tgl_trans` varchar(25) NOT NULL,
  `Jenis` varchar(50) NOT NULL,
  `diskon` bigint(20) NOT NULL,
  `Total` bigint(20) NOT NULL,
  `Pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`) VALUES
('fikri', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detailbrg`
--
ALTER TABLE `detailbrg`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detailbrg`
--
ALTER TABLE `detailbrg`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
