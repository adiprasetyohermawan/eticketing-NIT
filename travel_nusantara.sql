-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 11:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_nusantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_adm` int(4) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `username_adm` varchar(40) NOT NULL,
  `password_adm` varchar(40) NOT NULL,
  `alamat_adm` varchar(255) NOT NULL,
  `email_adm` varchar(30) NOT NULL,
  `notelp_adm` varchar(20) NOT NULL,
  `noktp_adm` varchar(35) NOT NULL,
  `tanggal_adm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_adm`, `nama_adm`, `username_adm`, `password_adm`, `alamat_adm`, `email_adm`, `notelp_adm`, `noktp_adm`, `tanggal_adm`) VALUES
(1, 'David Christian Wibowo', 'admin', 'paJubA%3D%3D', 'Grand Marina 9 no 17', 'bdpro.yogi28@gmail.com', '085641414141', '3374012305990003', '1999-05-23'),
(13, 'ad1', 'ad1', 'ad1', 'ad1', 'ad1@gmail.com', '12312312', '1231231', '2019-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_armada`
--

CREATE TABLE `tb_armada` (
  `id_armd` int(4) NOT NULL,
  `nopol_armd` varchar(20) NOT NULL,
  `jenis_armd` varchar(70) NOT NULL,
  `jumlahkursi_armd` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_armada`
--

INSERT INTO `tb_armada` (`id_armd`, `nopol_armd`, `jenis_armd`, `jumlahkursi_armd`) VALUES
(1, 'H 73713 S', 'L300', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking`
--

CREATE TABLE `tb_booking` (
  `no_booking` varchar(10) NOT NULL,
  `id_jdwl` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `jumlah_penumpang` int(2) NOT NULL,
  `harga_total` int(10) NOT NULL,
  `tgl_booking` date NOT NULL,
  `status_booking` enum('aktif','selesai','cancel') NOT NULL,
  `status_bayar` enum('lunas','belum dibayar','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_booking`
--

INSERT INTO `tb_booking` (`no_booking`, `id_jdwl`, `id_user`, `jumlah_penumpang`, `harga_total`, `tgl_booking`, `status_booking`, `status_bayar`) VALUES
('BO-001', 2, 2, 1, 65000, '2019-11-07', 'aktif', 'lunas'),
('BO-002', 2, 2, 1, 65000, '2019-11-12', 'aktif', 'pending'),
('BO-003', 2, 2, 1, 65000, '2019-11-30', 'aktif', 'belum dibayar'),
('BO-004', 2, 2, 1, 65000, '2019-12-05', 'aktif', 'belum dibayar'),
('BO-005', 2, 2, 1, 65000, '2019-12-07', 'aktif', 'belum dibayar'),
('BO-006', 2, 2, 1, 65000, '2019-12-16', 'aktif', 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking_detail`
--

CREATE TABLE `tb_booking_detail` (
  `id_booking_d` int(4) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL,
  `noid_penumpang` int(70) NOT NULL,
  `tempat_jemput` text NOT NULL,
  `nokursi_penumpang` int(2) NOT NULL,
  `no_booking` varchar(10) NOT NULL,
  `id_jdwl` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_booking_detail`
--

INSERT INTO `tb_booking_detail` (`id_booking_d`, `nama_penumpang`, `noid_penumpang`, `tempat_jemput`, `nokursi_penumpang`, `no_booking`, `id_jdwl`) VALUES
(1, 'Bahar', 2147483647, 'Tembalang', 3, 'BO-001', 2),
(2, 'Zulfikar Rahman', 1234567890, 'Ngesrep', 4, 'BO-002', 2),
(3, 'Hermawan', 1234567890, 'Tembalang', 1, 'BO-003', 2),
(4, 'Zulfikar Rahman', 2147483647, 'Solo', 2, 'BO-004', 2),
(5, 'Daffa', 2147483647, 'Wisma Ardana', 5, 'BO-005', 2),
(6, 'Firman Surya', 2147483647, 'Tembalang', 6, 'BO-006', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jdwl` int(4) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `id_armd` int(4) NOT NULL,
  `id_jrs` int(4) NOT NULL,
  `id_sopir` int(4) NOT NULL,
  `harga_tiket` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jdwl`, `tgl_berangkat`, `id_armd`, `id_jrs`, `id_sopir`, `harga_tiket`) VALUES
(2, '2019-12-16', 1, 1, 1, 65000),
(3, '2019-12-17', 1, 18, 2, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jrs` int(4) NOT NULL,
  `keberangkatan_jrs` varchar(30) NOT NULL,
  `tujuan_jrs` varchar(30) NOT NULL,
  `waktu_jrs` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jrs`, `keberangkatan_jrs`, `tujuan_jrs`, `waktu_jrs`) VALUES
(1, 'Semarang', 'Pekalongan', '10:00:00'),
(2, 'Surabaya', 'Malang', '10:00:00'),
(3, 'Semarang', 'Tegal', '10:00:00'),
(4, 'Pekalongan', 'Tegal', '10:00:00'),
(5, 'Tegal', 'Bandung', '10:00:00'),
(6, 'Semarang', 'Pekalongan', '11:00:00'),
(7, 'Semarang', 'Pekalongan', '13:00:00'),
(8, 'Semarang', 'Pekalongan', '15:00:00'),
(9, 'Semarang', 'Pekalongan', '17:00:00'),
(10, 'Semarang', 'Pekalongan', '07:00:00'),
(11, 'Pekalongan', 'Semarang', '07:00:00'),
(12, 'Pekalongan', 'Semarang', '09:00:00'),
(13, 'Pekalongan', 'Semarang', '11:00:00'),
(14, 'Pekalongan', 'Semarang', '13:00:00'),
(15, 'Pekalongan', 'Semarang', '15:00:00'),
(16, 'Pekalongan', 'Semarang', '17:00:00'),
(17, 'Semarang', 'Surabaya', '19:00:00'),
(18, 'Surabaya', 'Semarang', '19:00:00'),
(19, 'Malang', 'Semarang', '19:00:00'),
(20, 'Semarang', 'Malang', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_bayar` int(4) NOT NULL,
  `dari_bank` varchar(30) NOT NULL,
  `ke_bank` varchar(30) NOT NULL,
  `no_rek` int(40) NOT NULL,
  `atas_nama` varchar(40) NOT NULL,
  `nominal_transfer` int(20) NOT NULL,
  `gambar_bukti` varchar(40) NOT NULL,
  `tgl_konfirm` date NOT NULL,
  `no_booking` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_bayar`, `dari_bank`, `ke_bank`, `no_rek`, `atas_nama`, `nominal_transfer`, `gambar_bukti`, `tgl_konfirm`, `no_booking`) VALUES
(1, 'BRI', 'BRI', 2147483647, 'Hermawan', 65000, 'transfer-1573062915.jpg', '2019-11-07', 'BO-001'),
(2, 'BRI', 'BRI', 2147483647, 'Zulfikar', 65000, 'transfer-1575538273.jpg', '2019-12-05', 'BO-002'),
(3, 'BRI', 'BCA', 2147483647, 'Firman', 65000, 'transfer-1576459380.jpg', '2019-12-16', 'BO-006');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sopir`
--

CREATE TABLE `tb_sopir` (
  `id_sopir` int(4) NOT NULL,
  `nama_sopir` varchar(50) NOT NULL,
  `nosim_sopir` char(13) NOT NULL,
  `telp_sopir` varchar(15) NOT NULL,
  `alamat_sopir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sopir`
--

INSERT INTO `tb_sopir` (`id_sopir`, `nama_sopir`, `nosim_sopir`, `telp_sopir`, `alamat_sopir`) VALUES
(1, 'Ahmad Rahmadi', '93132052452', '081234567890', 'Ungaran'),
(2, 'Pramono', '93132052452', '082123456', 'Ungaran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(4) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `jeniskelamin_user` enum('L','P') NOT NULL,
  `telp_user` varchar(20) NOT NULL,
  `alamat_user` text NOT NULL,
  `email_user` varchar(60) NOT NULL,
  `password_user` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `jeniskelamin_user`, `telp_user`, `alamat_user`, `email_user`, `password_user`) VALUES
(1, 'david christian wibowo', 'L', '085641414141', 'grand marina 9 no 17', 'bdpro.yogi28@gmail.com', '28b3f2f116558efe178ec3aa752b660f'),
(2, 'Hermawan Adi Prasetyo', 'L', '085640021899', 'Tembalang', 'wawan@gmail.com', '0a000f688d85de79e3761dec6816b2a5'),
(3, 'Firman Surya', 'L', '085727801050', 'Ungaran', 'firman@gmail.com', '74bfebec67d1a87b161e5cbcf6f72a4a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `tb_armada`
--
ALTER TABLE `tb_armada`
  ADD PRIMARY KEY (`id_armd`);

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`no_booking`),
  ADD KEY `id_jdwl` (`id_jdwl`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_booking_detail`
--
ALTER TABLE `tb_booking_detail`
  ADD PRIMARY KEY (`id_booking_d`),
  ADD KEY `no_booking` (`no_booking`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jdwl`),
  ADD KEY `id_armd` (`id_armd`),
  ADD KEY `id_jrs` (`id_jrs`),
  ADD KEY `id_sopir` (`id_sopir`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jrs`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `no_booking` (`no_booking`);

--
-- Indexes for table `tb_sopir`
--
ALTER TABLE `tb_sopir`
  ADD PRIMARY KEY (`id_sopir`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_adm` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_armada`
--
ALTER TABLE `tb_armada`
  MODIFY `id_armd` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_booking_detail`
--
ALTER TABLE `tb_booking_detail`
  MODIFY `id_booking_d` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jdwl` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jrs` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_bayar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sopir`
--
ALTER TABLE `tb_sopir`
  MODIFY `id_sopir` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD CONSTRAINT `tb_booking_ibfk_1` FOREIGN KEY (`id_jdwl`) REFERENCES `tb_jadwal` (`id_jdwl`),
  ADD CONSTRAINT `tb_booking_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_booking_detail`
--
ALTER TABLE `tb_booking_detail`
  ADD CONSTRAINT `tb_booking_detail_ibfk_1` FOREIGN KEY (`no_booking`) REFERENCES `tb_booking` (`no_booking`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`id_armd`) REFERENCES `tb_armada` (`id_armd`),
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`id_jrs`) REFERENCES `tb_jurusan` (`id_jrs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`id_sopir`) REFERENCES `tb_sopir` (`id_sopir`);

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`no_booking`) REFERENCES `tb_booking` (`no_booking`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
