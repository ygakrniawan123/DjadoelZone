-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2025 pada 14.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nostalgia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `Id_film` int(11) NOT NULL,
  `Id_genre` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Rilis` int(11) NOT NULL,
  `Type` enum('cuplikan','full') NOT NULL DEFAULT 'full',
  `Judul` varchar(255) NOT NULL,
  `Sutradara` varchar(255) NOT NULL,
  `Di_produksi` varchar(255) NOT NULL,
  `Di_tulis` varchar(255) NOT NULL,
  `Di_bintangi` varchar(255) NOT NULL,
  `Durasi` varchar(255) NOT NULL,
  `Gambar` text NOT NULL,
  `Buat_data` datetime NOT NULL DEFAULT current_timestamp(),
  `Update_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`Id_film`, `Id_genre`, `Nama`, `Rilis`, `Type`, `Judul`, `Sutradara`, `Di_produksi`, `Di_tulis`, `Di_bintangi`, `Durasi`, `Gambar`, `Buat_data`, `Update_data`) VALUES
(92, 1, 'testing', 1999, 'full', 'testting', 'testting', 'testting', 'testting', 'testting', '1 jam', '../cover/679c47329893d.jpg', '2025-01-31 10:44:50', '2025-01-31 10:44:50'),
(93, 1, 'testing', 1999, 'full', 'testing', 'testing', 'testing', 'testig', 'ddjjd', '1 jam', '../cover/679c73c1b9794.jpg', '2025-01-31 13:54:57', '2025-01-31 13:54:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `Id_genre` int(11) NOT NULL,
  `Nama_genre` varchar(255) NOT NULL,
  `Buat_data` datetime NOT NULL,
  `Update_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`Id_genre`, `Nama_genre`, `Buat_data`, `Update_data`) VALUES
(1, 'Action', '2024-12-16 03:12:44', '2024-12-16 03:12:44'),
(2, 'Komedi', '2024-12-16 03:12:44', '2024-12-16 03:12:44'),
(3, 'Horor', '2024-12-18 09:05:31', '2024-12-18 09:05:31'),
(4, 'drama', '2024-12-18 09:05:31', '2024-12-18 09:05:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori`
--

CREATE TABLE `histori` (
  `Id_histori` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Id_film` int(11) NOT NULL,
  `Durasi_nonton` varchar(255) NOT NULL,
  `Ditonton_pada` datetime NOT NULL,
  `Buar_data` datetime NOT NULL,
  `Update_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Logo` text NOT NULL,
  `Deskripsi` text DEFAULT NULL,
  `Buat_data` datetime NOT NULL,
  `Update_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `Nama_pengguna` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('admin','user') NOT NULL DEFAULT 'user',
  `Buat_data` datetime NOT NULL DEFAULT current_timestamp(),
  `Update_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`Id_user`, `Nama_pengguna`, `Email`, `Username`, `Password`, `Role`, `Buat_data`, `Update_data`) VALUES
(70, 'Admin3', 'admin3@gmail.com', 'admin3', '$2y$10$uX10Q.hqeOEVh5fPhHJxcuilRn0SLl9oomZEq.K8jALQ1qFHTxOsq', 'admin', '2025-01-30 10:11:54', '2025-01-30 10:11:54'),
(71, 'Aku User11', 'akuuser@gmail.com', 'akuUser', '$2y$10$sHdLcnt4Sh7.SpPUOz39GuHVcfP5CtlmKgA9rUSbcV3FWoYDfjbTy', 'user', '2025-01-30 22:10:12', '2025-01-30 22:10:12'),
(73, 'admin12', 'admin12@gmail.com', 'admin12', '$2y$10$AChvL9wDoFjJ9wldSedY0uGtnHdbWTS.ssEBVecwnxeYmoJLotMYy', 'admin', '2025-01-31 10:55:50', '2025-01-31 10:55:50'),
(75, 'salom123', 'salom@gmail.com', 'salom123', '$2y$10$zg/OjXemM7CmMpn4ijI9B.OgMML.KMMVBhTucrzmRBuERSA6obBkG', 'user', '2025-01-31 13:56:03', '2025-01-31 13:56:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`Id_film`),
  ADD KEY `Id_genre` (`Id_genre`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`Id_genre`);

--
-- Indeks untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`Id_histori`),
  ADD KEY `Id_user` (`Id_user`),
  ADD KEY `histori_ibfk_1` (`Id_film`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `Id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `Id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `histori`
--
ALTER TABLE `histori`
  MODIFY `Id_histori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`Id_genre`) REFERENCES `genre` (`Id_genre`);

--
-- Ketidakleluasaan untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD CONSTRAINT `histori_ibfk_1` FOREIGN KEY (`Id_film`) REFERENCES `film` (`Id_film`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
