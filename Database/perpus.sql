-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 01:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE perpus;
USE PERPUS;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` char(4) NOT NULL,
  `npm_anggota` char(11) NOT NULL,
  `nama_anggota` varchar(35) NOT NULL,
  `email_anggota` varchar(40) NOT NULL,
  `password_anggota` varchar(25) NOT NULL,
  `nomor_telepon_anggota` varchar(13) NOT NULL,
  `fakultas` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `jenis_kelamin_anggota` varchar(9) NOT NULL,
  `foto_profil_anggota` varchar(255) NOT NULL,
  `alamat_anggota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `npm_anggota`, `nama_anggota`, `email_anggota`, `password_anggota`, `nomor_telepon_anggota`, `fakultas`, `jurusan`, `jenis_kelamin_anggota`, `foto_profil_anggota`, `alamat_anggota`) VALUES
('A001', '23081010001', 'Mark Zuckerberg ', '23081010001@student.upnjatim.ac.id', 'mark001', '087238976140', 'Ilmu Komputer', 'Informatika', 'Laki-Laki', '6484560245241.jpg', 'Kec. Rungkut, Kota Surabaya, Jawa Timur'),
('A002', '22031010022', 'Vivi Novika', '22031010022@student.upnjatim.ac.id', 'vivi1234', '089605914946', 'Teknik', 'Teknik Kimia', 'Perempuan', '64845406e1c20.jpg', 'Kec. Waru Kab. Sidoarjo, Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` char(4) NOT NULL,
  `judul_buku` varchar(45) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `jenis_buku` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `pengarang` varchar(35) NOT NULL,
  `penerbit` varchar(35) NOT NULL,
  `cover_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `tahun_terbit`, `jenis_buku`, `jumlah`, `pengarang`, `penerbit`, `cover_buku`) VALUES
('B001', 'PHP Komplet ', '2017', 'Komputer & Teknologi', 44, 'Jubilee Enterprise', ' Elex Media Komputindo', '64844f82c384f.jpg'),
('B002', 'Biokimia', '2020', 'Sains', 29, 'La Ode Sumarlin', 'Raja Grafindo Persada', '648450cc6e220.jpg'),
('B003', 'Sistem Digital', '2018', 'Komputer & Teknologi', 15, 'Hidayat', 'Informatika', '64845717c9fca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_perpustakaan`
--

CREATE TABLE `pegawai_perpustakaan` (
  `id_pegawai` char(5) NOT NULL,
  `nip_pegawai` char(18) NOT NULL,
  `nama_pegawai` varchar(35) NOT NULL,
  `email_pegawai` varchar(40) NOT NULL,
  `password_pegawai` varchar(25) NOT NULL,
  `nomor_telepon_pegawai` varchar(13) NOT NULL,
  `jenis_kelamin_pegawai` varchar(9) NOT NULL,
  `foto_profil_pegawai` varchar(255) NOT NULL,
  `alamat_pegawai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai_perpustakaan`
--

INSERT INTO `pegawai_perpustakaan` (`id_pegawai`, `nip_pegawai`, `nama_pegawai`, `email_pegawai`, `password_pegawai`, `nomor_telepon_pegawai`, `jenis_kelamin_pegawai`, `foto_profil_pegawai`, `alamat_pegawai`) VALUES
('AD001', '198507232005022001', 'Irnanto Pradana', 'irnanto.pradana.pustaka@upnjatim.ac.id', 'Irnanto1234', '085135252023', 'Laki-Laki', '198507232005022001.jpg', 'Kec. Wonokromo, Kota Surabaya, Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` char(5) NOT NULL,
  `id_anggota` char(4) NOT NULL,
  `id_buku` char(4) NOT NULL,
  `id_pegawai` char(5) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_buku`, `id_pegawai`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
('PJ001', 'A002', 'B002', 'AD001', '2023-06-12 10:00:00', '2023-06-19 10:00:00', 'Pinjam'),
('PJ002', 'A001', 'B001', 'AD001', '2023-06-12 13:30:00', '2023-06-26 01:30:00', 'Pinjam'),
('PJ003', 'A001', 'B003', 'AD001', '2023-06-05 09:30:00', '2023-06-09 08:00:00', 'Kembali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `pegawai_perpustakaan`
--
ALTER TABLE `pegawai_perpustakaan`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai_perpustakaan` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
