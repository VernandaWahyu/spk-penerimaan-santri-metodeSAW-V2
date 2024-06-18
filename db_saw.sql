-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 12:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id_Admin` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Jabatan` varchar(30) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id_Admin`, `Nama`, `Jabatan`, `Username`, `Password`) VALUES
(1, 'Agnesmonika', 'Admin', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `Id_Kriteria` int(11) NOT NULL,
  `Nama_Kriteria` varchar(30) NOT NULL,
  `Bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`Id_Kriteria`, `Nama_Kriteria`, `Bobot`) VALUES
(1, 'Test Tulis', 0.25),
(2, 'Test Lisan', 0.25),
(3, 'Jarak Rumah', 0.15),
(4, 'Penghasilan Orang Tua', 0.15),
(5, 'Yatim Piatu', 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `kuota`
--

CREATE TABLE `kuota` (
  `Id_kuota` int(11) NOT NULL,
  `Kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kuota`
--

INSERT INTO `kuota` (`Id_kuota`, `Kuota`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `Id_Nilai` int(11) NOT NULL,
  `No_Pendaftaran` varchar(6) NOT NULL,
  `C1` double NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`Id_Nilai`, `No_Pendaftaran`, `C1`, `C2`, `C3`, `C4`, `C5`) VALUES
(1, 'S-0001', 50, 70, 50, 0, 0),
(2, 'S-0002', 32.21, 65, 98, 50, 80),
(3, 'S-0003', 33.68, 82, 100, 100, 100),
(4, 'S-0004', 34.25, 85, 90, 60, 75),
(5, 'S-0005', 36.5, 86, 60, 90, 50),
(6, 'S-0006', 34.21, 78, 69, 79, 88),
(7, 'S-0007', 35.21, 85, 60, 60, 75),
(30, 'S-0008', 21.32, 76, 86, 49, 70),
(31, 'S-0009', 23.21, 50, 60, 70, 60),
(32, 'S-0010', 32.4, 0, 0, 0, 0),
(33, 'S-0011', 23.12, 0, 0, 0, 0),
(36, 'S-0015', 80, 90, 75, 75, 100),
(37, 'S-0016', 70, 80, 0, 0, 55);

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `Id_Normalisasi` int(11) NOT NULL,
  `No_Pendaftaran` varchar(6) NOT NULL,
  `C1` double NOT NULL,
  `C2` double NOT NULL,
  `C3` double NOT NULL,
  `C4` double NOT NULL,
  `C5` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`Id_Normalisasi`, `No_Pendaftaran`, `C1`, `C2`, `C3`, `C4`, `C5`) VALUES
(1, 'S-0001', 0.625, 0.777778, 0.5, 0, 0),
(2, 'S-0002', 0.402625, 0.722222, 0.98, 0.5, 0.8),
(3, 'S-0003', 0.421, 0.911111, 1, 1, 1),
(4, 'S-0004', 0.428125, 0.944444, 0.9, 0.6, 0.75),
(5, 'S-0005', 0.45625, 0.955556, 0.6, 0.9, 0.5),
(6, 'S-0006', 0.427625, 0.866667, 0.69, 0.79, 0.88),
(7, 'S-0007', 0.440125, 0.944444, 0.6, 0.6, 0.75),
(30, 'S-0008', 0.2665, 0.844444, 0.86, 0.49, 0.7),
(31, 'S-0009', 0.290125, 0.555556, 0.6, 0.7, 0.6),
(32, 'S-0010', 0.405, 0, 0, 0, 0),
(33, 'S-0011', 0.289, 0, 0, 0, 0),
(36, 'S-0015', 1, 1, 0.75, 0.75, 1),
(37, 'S-0016', 0.875, 0.888889, 0, 0, 0.55);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `No_Pendaftaran` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `status_bayar` enum('Lunas','Belum Bayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `No_Pendaftaran`, `tgl_pembayaran`, `status_bayar`) VALUES
(24, 'S-0015', '2024-06-18', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `No_Pendaftaran` varchar(6) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Id_kuota` int(11) DEFAULT NULL,
  `Nama` varchar(50) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `Asal_Sekolah` varchar(30) DEFAULT NULL,
  `Jarak_Rumah` double NOT NULL,
  `Penghasilan_Orang_Tua` double NOT NULL,
  `Yatim_Piatu` double NOT NULL,
  `Nilai_Akhir` double DEFAULT NULL,
  `Ranking` int(11) DEFAULT NULL,
  `Bukti_Pembayaran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`No_Pendaftaran`, `Email`, `Password`, `Id_kuota`, `Nama`, `Tanggal_Lahir`, `Alamat`, `Asal_Sekolah`, `Jarak_Rumah`, `Penghasilan_Orang_Tua`, `Yatim_Piatu`, `Nilai_Akhir`, `Ranking`, `Bukti_Pembayaran`) VALUES
('S-0001', 'rizalbayu@gmail.com', '1234', 1, 'Rizal Bayu A', '1998-07-20', 'Slawi', 'SMP N 1 Adiwerna', 50, 0, 0, 0.425695, NULL, ''),
('S-0002', 'coba@gmail.com', '1234', 1, 'Rina', '2018-12-11', 'sini', 'Stuna', 32, 0, 0, 0.663212, 2, ''),
('S-0003', 'aku@gmail.com', '1234', 1, 'Dede Agus', '1999-01-01', 'Sana', 'Stuna', 34, 0, 0, 0.833028, NULL, ''),
('S-0004', 'cihuy@gmail.com', '1234', 1, 'Reza Agung', '2018-12-11', 'Kedung Sukun', 'Spenda', 34, 0, 0, 0.718142, NULL, ''),
('S-0005', 'Kamal@gmail.com', '1234', 1, 'Kamal Ardi', '2018-12-07', 'Slarang', 'MTS 1', 36, 0, 0, 0.677952, NULL, ''),
('S-0006', '1@gmil.com', '1234', 1, 'dono', '2018-12-14', 'sini', 'sana', 34, 0, 0, 0.721573, NULL, 'uploads/bukti_pembayaran.jpeg'),
('S-0007', '2@gmail.com', '1234', 1, 'weh', '2018-12-04', 'sono', 'sini', 35, 0, 0, 0.676142, NULL, ''),
('S-0008', '1@gmail.com', '1234', 1, 'qwerty', '2018-12-13', 'qwerty', 'qwerty', 21, 0, 0, 0.620236, NULL, ''),
('S-0009', '3123@dsa.com', '1234', 1, 'qwert', '2018-12-19', 'qwer', 'eqwe', 23, 0, 0, 0.52642, NULL, ''),
('S-0010', '4@gmail.com', '1234', 1, 'laj', '2019-01-17', 'sewa', 'wew', 32, 0, 0, 0.10125, NULL, ''),
('S-0011', '6@gmail.com', '1234', 1, 'weh', '2019-01-17', 'dasds', 'dasda', 23, 0, 0, 0.07225, NULL, ''),
('S-0015', 'yagesya@gmal.com', '1234', 1, 'Wahyu', '2024-06-11', 'Demangans', 'SMPN 1 SIMAN', 75, 75, 100, 0.925, NULL, 'uploads/bukti_pembayaran.jpg'),
('S-0016', 'testtime@gmail.com', '1234', 1, 'Wahyu', '2024-06-12', 'Demangans', 'SMPN 1 SIMAN', 0, 0, 55, 0.550972, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_Admin`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`Id_Kriteria`);

--
-- Indexes for table `kuota`
--
ALTER TABLE `kuota`
  ADD PRIMARY KEY (`Id_kuota`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`Id_Nilai`),
  ADD UNIQUE KEY `No_Pendaftaran` (`No_Pendaftaran`) USING BTREE;

--
-- Indexes for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`Id_Normalisasi`),
  ADD KEY `No_Pendaftaran` (`No_Pendaftaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `No_Pendaftaran` (`No_Pendaftaran`) USING BTREE;

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`No_Pendaftaran`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Id_kuota` (`Id_kuota`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `Id_Kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kuota`
--
ALTER TABLE `kuota`
  MODIFY `Id_kuota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `Id_Nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `Id_Normalisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`No_Pendaftaran`) REFERENCES `santri` (`No_Pendaftaran`);

--
-- Constraints for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD CONSTRAINT `normalisasi_ibfk_1` FOREIGN KEY (`No_Pendaftaran`) REFERENCES `santri` (`No_Pendaftaran`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`No_Pendaftaran`) REFERENCES `santri` (`No_Pendaftaran`);

--
-- Constraints for table `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_ibfk_1` FOREIGN KEY (`Id_kuota`) REFERENCES `kuota` (`Id_kuota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
