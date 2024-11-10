-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 08:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas_biodata`
--

CREATE TABLE `berkas_biodata` (
  `id_biodata` int(10) NOT NULL,
  `id_pendaftar` int(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nrp` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Budha','Lainnya') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `pas_foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_ekonomi`
--

CREATE TABLE `berkas_ekonomi` (
  `id_ekonomi` int(11) NOT NULL,
  `id_pendaftar` int(11) DEFAULT NULL,
  `kepemilikan_rumah` enum('Sendiri','Sewa','Menumpang') NOT NULL,
  `jumlah_penghuni` int(10) NOT NULL,
  `daya_listrik` int(155) NOT NULL,
  `tagihan_listrik` enum('<= Rp499.999','Rp500.000-Rp999.999','>= Rp1.000.000') NOT NULL,
  `pbb` int(20) NOT NULL,
  `roda_dua` int(11) NOT NULL,
  `roda_empat` int(11) NOT NULL,
  `rumah_depan` blob NOT NULL,
  `rumah_dalam` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_keluarga`
--

CREATE TABLE `berkas_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `id_pendaftar` int(11) DEFAULT NULL,
  `no_kk` int(11) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nik_ayah` varchar(255) NOT NULL,
  `pekerjaan_ayah` varchar(255) NOT NULL,
  `penghasilan_ayah` enum('<= Rp999.999','Rp1.000.000-Rp4.999.999','Rp5.000.000-Rp9.999.999',' >= Rp10.000.000') NOT NULL,
  `notelp_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nik_ibu` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) NOT NULL,
  `penghasilan_ibu` enum('<= Rp999.999','Rp1.000.000-Rp4.999.999','Rp5.000.000-Rp9.999.999',' >= Rp10.000.000') NOT NULL,
  `notelp_ibu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_nilai`
--

CREATE TABLE `berkas_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pendaftar` int(11) DEFAULT NULL,
  `Nilai_IPS` float DEFAULT NULL,
  `Scan_transkrip` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_prestasi`
--

CREATE TABLE `berkas_prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_pendaftar` int(11) DEFAULT NULL,
  `nama_kegiatan` varchar(30) NOT NULL,
  `jenis_kegiatan` enum('Kelompok','Individual') NOT NULL,
  `tingkat` enum('Kabupaten/Kota','Provinsi','Nasional','Internasional') NOT NULL,
  `tahun` int(4) NOT NULL,
  `pencapaian` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nrp` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_pendaftaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `nama_lengkap`, `nrp`, `email`, `no_pendaftaran`) VALUES
(20, 'KUROKO TETSUYA', '3123500031', 'kuroko31@it.student.pens.ac.id', 'PSGKWKBORM'),
(22, 'AURA SASI KIRANA D. A.', '3123500045', 'aurasky@it.student.pens.ac.id', 'PSG9SAMHW0'),
(23, 'AURA SASI KIRANA D. A.', '3123500060', 'aurasky@it.student.pens.ac.id', 'PSGXM7B40J');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas_biodata`
--
ALTER TABLE `berkas_biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD UNIQUE KEY `id_biodata` (`id_biodata`),
  ADD KEY `berkas_biodata_ibfk_1` (`id_pendaftar`);

--
-- Indexes for table `berkas_ekonomi`
--
ALTER TABLE `berkas_ekonomi`
  ADD PRIMARY KEY (`id_ekonomi`),
  ADD UNIQUE KEY `ekonomi` (`id_ekonomi`),
  ADD KEY `id_pendaftar` (`id_pendaftar`);

--
-- Indexes for table `berkas_keluarga`
--
ALTER TABLE `berkas_keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD UNIQUE KEY `keluarga` (`id_keluarga`),
  ADD KEY `berkas_keluarga_ibfk_1` (`id_pendaftar`);

--
-- Indexes for table `berkas_nilai`
--
ALTER TABLE `berkas_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD UNIQUE KEY `nilai` (`id_nilai`),
  ADD KEY `berkas_nilai_ibfk_1` (`id_pendaftar`);

--
-- Indexes for table `berkas_prestasi`
--
ALTER TABLE `berkas_prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD UNIQUE KEY `id_prestasi` (`id_prestasi`),
  ADD KEY `berkas_prestasi_ibfk_1` (`id_pendaftar`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD UNIQUE KEY `pendaftar` (`id_registrasi`),
  ADD UNIQUE KEY `nrp` (`nrp`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas_biodata`
--
ALTER TABLE `berkas_biodata`
  MODIFY `id_biodata` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas_prestasi`
--
ALTER TABLE `berkas_prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas_biodata`
--
ALTER TABLE `berkas_biodata`
  ADD CONSTRAINT `berkas_biodata_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `registrasi` (`id_registrasi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `berkas_ekonomi`
--
ALTER TABLE `berkas_ekonomi`
  ADD CONSTRAINT `berkas_ekonomi_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `registrasi` (`id_registrasi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `berkas_keluarga`
--
ALTER TABLE `berkas_keluarga`
  ADD CONSTRAINT `berkas_keluarga_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `registrasi` (`id_registrasi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `berkas_nilai`
--
ALTER TABLE `berkas_nilai`
  ADD CONSTRAINT `berkas_nilai_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `registrasi` (`id_registrasi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `berkas_prestasi`
--
ALTER TABLE `berkas_prestasi`
  ADD CONSTRAINT `berkas_prestasi_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `berkas_prestasi` (`id_prestasi`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
