-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2025 at 04:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `android_amikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nik_guru` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_guru` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password_guru` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `wa_guru` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nik_guru`, `nama_guru`, `password_guru`, `wa_guru`) VALUES
('190302238', 'Acihmah Sidauruk', 'rahasia12', '083425127813'),
('190302240', 'Alfie Nur Rahmi', 'rahasia1', '082342312321'),
('190302684', 'Arif Nur Rohman', 'rahasia', '082345126571');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_kelas` int NOT NULL,
  `kode_kelas` varchar(10) DEFAULT NULL,
  `nama_mapel` varchar(100) DEFAULT NULL,
  `nik_guru` varchar(15) DEFAULT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `semester` enum('ganjil','genap') DEFAULT 'ganjil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID_kelas`, `kode_kelas`, `nama_mapel`, `nik_guru`, `nama_guru`, `tahun_ajaran`, `semester`) VALUES
(1, 'SI04', 'Bahasa Pemrograman 2', '190302684', 'Arif Nur Rohman ', '2025/2026', 'ganjil'),
(2, 'SI09', 'Pemrograman Web Lanjut', '190302348', 'Aditya Rizki Yudiantika', '2025/2026', 'ganjil'),
(3, 'SI016', 'Sistem Manajemen Basis Data', '190302238', 'Acihmah Sidauruk ', '2025/2026', 'ganjil'),
(4, 'SI05', 'Logika Algoritma', '190302240', 'Alfie Nur Rahmi', '2025/2026', 'ganjil'),
(5, 'SI07', 'Bahasa Pemrograman 1', '190302684', 'Arif Nur Rohman ', '2025/2026', 'ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int NOT NULL,
  `id_kelas` int NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `isi_materi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_kelas`, `judul_materi`, `isi_materi`) VALUES
(1, 1, 'Pengenalan Android kotlin', ''),
(2, 1, 'Eksplisit Intent dan Implisit Intent', ''),
(3, 2, 'Impelementasi Database dalam website', ''),
(4, 4, 'Pengenalan Tipe Data', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int NOT NULL,
  `judul_pengumuman` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_pengumuman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul_pengumuman`, `isi_pengumuman`, `tanggal_pengumuman`) VALUES
(1, 'Jadwal pembayaran SPP 2025/2026', '', '2025-11-06 15:50:36'),
(2, 'Libur Semester Ganjil 2025/2026', '', '2025-11-06 15:50:36'),
(3, 'Libur Natal 2025/2026', '', '2025-11-06 15:53:54'),
(4, 'Jadwal UTS 2025/2026', '', '2025-11-06 15:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `id_sesi` int NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `materi_sesi` text NOT NULL,
  `bahasan_sesi` text NOT NULL,
  `kode_sesi` varchar(5) NOT NULL,
  `ke_sesi` int NOT NULL DEFAULT '1',
  `tanggal_sesi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sesi`
--

INSERT INTO `sesi` (`id_sesi`, `kode_kelas`, `materi_sesi`, `bahasan_sesi`, `kode_sesi`, `ke_sesi`, `tanggal_sesi`) VALUES
(1, 'SI04', 'Membuat Fragment', 'Cara membuat fragment', '6QaN0', 1, '2025-11-16 01:48:38'),
(2, 'SI07', 'Perulangan', 'Perulangan pada bahasa pemrograman', 'SNDhw', 2, '2025-11-16 22:04:03'),
(3, 'SI04', 'Responsi', 'Responsi sebelum uts', 'B49Fa', 1, '2025-11-16 22:40:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nik_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_kelas`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id_sesi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `ID_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `id_sesi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
