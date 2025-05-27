-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2025 pada 15.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siswacare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_uks`
--

CREATE TABLE `siswa_uks` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa_uks`
--

INSERT INTO `siswa_uks` (`id`, `nisn`, `nama_lengkap`, `kelas`, `keluhan`, `tanggal`) VALUES
(4, '0081453217', 'ResilaDamayanti', 'RPL', 'capek banget', '2025-05-23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `siswa_uks`
--
ALTER TABLE `siswa_uks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `siswa_uks`
--
ALTER TABLE `siswa_uks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
