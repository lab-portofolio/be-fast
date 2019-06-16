-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2018 pada 00.11
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `befast`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `game_play`
--

CREATE TABLE `game_play` (
  `id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  `wpm` int(10) NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `game_play`
--

INSERT INTO `game_play` (`id`, `player_id`, `wpm`, `tanggal`) VALUES
(114, 1, 44, '2018-11-18 22:49:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `players`
--

CREATE TABLE `players` (
  `id` int(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `xp` int(10) NOT NULL,
  `log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `players`
--

INSERT INTO `players` (`id`, `full_name`, `xp`, `log`) VALUES
(1, 'ANDY MAULANA YUSUF', 59, '2018-11-18 22:49:43');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_game_play`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_game_play` (
`id` int(10)
,`full_name` varchar(255)
,`xp` int(10)
,`log` varchar(255)
,`game_play_id` int(10)
,`wpm` int(10)
,`tanggal` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_game_play`
--
DROP TABLE IF EXISTS `view_game_play`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_game_play`  AS  select `players`.`id` AS `id`,`players`.`full_name` AS `full_name`,`players`.`xp` AS `xp`,`players`.`log` AS `log`,`game_play`.`id` AS `game_play_id`,`game_play`.`wpm` AS `wpm`,`game_play`.`tanggal` AS `tanggal` from (`game_play` join `players`) where (`game_play`.`player_id` = `players`.`id`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `game_play`
--
ALTER TABLE `game_play`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indeks untuk tabel `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `game_play`
--
ALTER TABLE `game_play`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `game_play`
--
ALTER TABLE `game_play`
  ADD CONSTRAINT `game_play_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
