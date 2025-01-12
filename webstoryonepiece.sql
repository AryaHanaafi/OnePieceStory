-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2025 pada 22.23
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
-- Database: `webstoryonepiece`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Monkey D. Luffy', 'Monkey D. Luffy adalah kapten Bajak Laut Topi Jerami yang bercita-cita menjadi Raja Bajak Laut. Ia terkenal dengan topi jerami ikonisnya yang merupakan warisan dari Shanks. Luffy memiliki tubuh elastis seperti karet karena memakan Gomu Gomu no Mi, yang kemudian terungkap sebagai Hito Hito no Mi, Model: Nika. ', 'luffy.jpg', '2024-12-05 13:44:58', 'atemincuy'),
(2, 'Roronoa Zoro', 'Name: Roronoa Zoro\r\nRole: Combatant of the Straw Hat Pirates, Swordsman\r\nDream: To become the World\'s Greatest Swordsman\r\nSignature Swords: Wado Ichimonji, Enma, Sandai Kitetsu', 'zoro.jpg', '2024-12-05 13:44:58', 'atemincuy'),
(3, 'Nami', 'Nami adalah navigator cerdas yang bertugas memandu kapal Bajak Laut Topi Jerami melewati perairan berbahaya. Ia memiliki kemampuan luar biasa dalam membaca cuaca dan membuat peta, bercita-cita untuk menggambar peta seluruh dunia. Nami dulunya adalah pencuri yang bekerja untuk Bajak Laut Arlong, namun bergabung dengan Luffy setelah dibebaskan dari perbudakan.', 'nami.jpg', '2024-12-11 20:58:12', 'atemincuy'),
(4, 'Vinsmoke Sanji', 'Vinsmoke Sanji adalah koki kapal Bajak Laut Topi Jerami yang juga seorang ahli bela diri dengan gaya bertarung khas \"Black Leg\". Ia terlahir sebagai bagian dari keluarga bangsawan Germa 66, namun meninggalkan mereka karena perbedaan prinsip. Sanji sangat sopan terhadap wanita dan memiliki prinsip kuat untuk tidak pernah menyakiti mereka, bahkan dalam situasi genting.', 'sanjii.jpg', '2024-12-11 21:01:09', 'atemincuy'),
(5, 'Nico Robin', 'Nico Robin adalah arkeolog kapal dan satu-satunya orang yang mampu membaca Poneglyph, prasasti kuno yang menyimpan rahasia sejarah dunia. Robin memakan Hana Hana no Mi, yang memungkinkannya membuat bagian tubuhnya tumbuh di berbagai permukaan. Masa lalunya penuh penderitaan karena ia diburu oleh Pemerintah Dunia sejak kecil akibat kemampuannya.', 'robin.jpg', '2025-01-11 11:58:55', 'atemincuy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(11) NOT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `gambar`, `tanggal`, `username`) VALUES
(52, '20250112031459.jpg', '2025-01-12 03:14:59', 'aryahanaafi'),
(53, '20250112021125.jpg', '2025-01-12 02:11:25', 'admin'),
(54, '20250112021136.jpg', '2025-01-12 02:11:36', 'admin'),
(55, '20250112021149.jpg', '2025-01-12 02:11:49', 'admin'),
(56, '20250112021158.jpg', '2025-01-12 02:11:58', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, '', '9cd618641f27b1af8a21cb68d7cc497f', '20250112032138.jpg'),
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '20250112032514.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
