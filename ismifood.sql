-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2024 at 04:18 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ismifood`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_produk` varchar(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_produk`, `username`, `jumlah`) VALUES
(7, 'item65e4c5eb756bf4.11250061', 'Achwall_th', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_produk` varchar(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(64) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `kategori` enum('Ringan','Utama') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `stok`, `kategori`, `filename`) VALUES
('item65e4bf143d1c55.18752025', 'Pastel Mini 500gr', 'Pastel mini isi abon premium.\r\nTerdapat campuran keju di adonan agar lebih gurih.\r\nCocok dibuat camilan atau hidangan lebaran.', 45000, 4, 'Ringan', 'item65e4bf143d1c55_18752025.jpeg'),
('item65e4c134446043.35121444', 'Tahu Campur', 'Makanan khas Surabaya yang terdiri dari daging, kikil, tahu, perkedel singkong, mie kuning, dan selada. Kemudian dicampur kuah dari bumbu petis serta sambal.', 20000, 0, 'Utama', 'item65e4c134446043_35121444.jpg'),
('item65e4c29540d636.68123709', 'Selat Solo atau Bistik', 'Makanan khas Solo yang terdiri dari olahan daging sapi, telur rebus, kentang, wortel, buncis, tomat, dan selada.', 18000, 0, 'Utama', 'item65e4c29540d636_681237091.jpg'),
('item65e4c5eb756bf4.11250061', 'Nastar Wisman', 'Kue lebaran yang berisi selai nanas.\r\nAdonan diberi tambahan keju.\r\nMenggunakan butter wisman sehingga adonan lembut.\r\nKemasan toples 500gr.', 90000, 5, 'Ringan', 'item65e4c5eb756bf4_11250061.jpg'),
('item65e4c845ef3fa2.01886004', 'Kue Kastengel', 'Kue kering khas lebaran dengan rasa keju yang manis dan gurih.\r\nMenggunakan butter wisman dan keju premium.\r\nKemasan toples 500gr.', 80000, 5, 'Ringan', 'item65e4c845ef3fa2_01886004.jpg'),
('item66553cf20fb308.11925329', 'Kebab Frozen', 'Kebab dengan isian daging, lettuce, keju, mayo, serta saus.\r\nSetiap box plastik isi 10 kebab.', 25000, 8, 'Ringan', 'item66553cf20fb308_11925329.jpg'),
('item66553f29555fb7.35471764', 'Makaroni Schotel', 'Makanan yang terbuat dari makaroni dengan campuran telur, susu, dan keju serta diberi isian daging dan topping keju.', 50000, 4, 'Utama', 'item66553f29555fb7_35471764.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_order` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` varchar(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `tgl_order` datetime NOT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `status` enum('Dalam Pesanan','Dikirim','Selesai','Dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_order`, `id_produk`, `username`, `nama`, `no_hp`, `alamat`, `jumlah`, `total_harga`, `tgl_order`, `tgl_selesai`, `status`) VALUES
('240516ADD83D87', 'item65e4bf143d1c55.18752025', 'Achwall_th', 'Achwall Taufiq Hidayat', '082310626002', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 2, 90000, '2024-05-16 03:53:09', '2024-05-28 02:39:19', 'Selesai'),
('24052815EF856C', 'item66553f29555fb7.35471764', 'Achwall_th', 'Achwall Taufiq Hidayat', '082310626002', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 1, 50000, '2024-05-28 02:37:57', NULL, 'Dalam Pesanan'),
('2405287092DA17', 'item66553cf20fb308.11925329', 'Achwall_th', 'Achwall Taufiq Hidayat', '082310626002', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 2, 50000, '2024-05-28 02:37:32', NULL, 'Dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_order` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `id_produk` varchar(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `payment_type` varchar(15) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `status_code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_order`, `username`, `nama`, `no_hp`, `alamat`, `id_produk`, `jumlah`, `total_harga`, `payment_type`, `transaction_time`, `status_code`, `bank`, `pdf_url`) VALUES
('2405289EEAD92C', 'Achwall_th', 'Achwall Taufiq Hidayat', '082310626002', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 'item65e4c5eb756bf4.11250061', 1, 90000, 'bank_transfer', '2024-05-28 09:38:32', '201', 'bri', 'https://app.sandbox.midtrans.com/snap/v1/transactions/181ab4a2-cfd6-42b4-a121-fad13ef472d7/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('pelanggan','admin') NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `nama`, `no_hp`, `alamat`, `email`) VALUES
(1, 'Admin', '$2y$10$fWl1voTgQIzwoPD5j3S9aeYKCfrSTU/9q9KpxBmX6uAezoviCaqHy', 'admin', 'Mimin', '081234567890', 'Kranggan Permai, Jatisampurna, Bekasi', 'ismifood.kranggan@gmail.com'),
(3, 'Achwall_th', '$2y$10$CtunuU84EdhuIEwyWFmJ9ur8FA9k7KBleB.PD3NdR9EP1vzaMKfU2', 'pelanggan', 'Achwall Taufiq Hidayat', '082310626002', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 'achwalltaufiqhidayat@gmail.com'),
(4, 'ismiyati', '$2y$10$eqBqb6XJ22w5/8Dfmiu0weauQVAfQN.FGawIarXvc./7g7u/Yx88K', 'pelanggan', 'Ismiyati Riduwan', '081318488259', 'Jl. Cempaka Raya BS6 No.27, RT 019/012, Jatisampurna, Bekasi', 'ismiriduwan16@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
