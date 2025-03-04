-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2025 pada 07.10
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
-- Database: `web_trpl2d`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(28) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `prodi_id`, `foto`) VALUES
('124671236', 'Abdhu dudu', 6, 'uploads/555627.jpg'),
('12645781283', 'Rafi Sukaisih', 6, 'uploads/973967.jpg'),
('13212412', 'Cuy cihuy', 8, 'uploads/1614.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `prodi_id`, `email`, `nim`, `gender`, `hobi`, `alamat`) VALUES
(11, 'Nabil Achmad Khoir', 6, 'nabilachmad316@gmail.com', '2311082032', 'L', 'Berenang, Sepak Bola, Voli', 'ubud'),
(13, 'kacau', 6, 'kacau@gmail.com', '12121212', 'P', 'Voli', 'disana banh'),
(17, 'Santiago', 10, 'Santiago@gmail.com', '231123211', 'L', 'Gaming', 'Spanyol kesini dikit'),
(19, 'Sitanggang', 6, 'nabilachmad316@gmail.com', '1231224', 'L', 'Sepak Bola', 'dfsgsregre');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mk` varchar(32) NOT NULL,
  `nama_mk` varchar(120) NOT NULL,
  `sks` int(11) NOT NULL,
  `dosen_nip` varchar(28) DEFAULT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mk`, `nama_mk`, `sks`, `dosen_nip`, `semester`) VALUES
('1', 'Pemograman Web', 4, '124671236', 4),
('3', 'Basis Data', 4, '13212412', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` enum('D2','D3','D4','S1','S2') NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `jenjang`, `keterangan`) VALUES
(6, 'Teknologi Rekayasa Perangkat Lunak', 'D4', 'Teknologi Rekayasa Perangkat Lunak'),
(8, 'Manajemen Informatika', 'D3', 'Manajemen Informatika'),
(9, 'Teknik Komputer', 'D3', 'Teknik Komputer'),
(10, 'Animasi', 'D4', 'Animasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `level` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrator', 'admin'),
(6, 'nabilachmad316@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Nabil Achmad Khoir', 'staff'),
(10, 'cihuyy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Cihuyy', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `Index` (`prodi_id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`nim`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mk`),
  ADD KEY `INDEX` (`dosen_nip`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Ketidakleluasaan untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`dosen_nip`) REFERENCES `dosen` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
