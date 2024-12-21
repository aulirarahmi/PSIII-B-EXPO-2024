-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 03:13 PM
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
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 'Apa arti rambu segitiga merah?', 'Larangan', 'Perintah', 'Peringatan', 'Petunjuk', 'C'),
(2, 'Apa arti rambu lingkaran merah?', 'Informasi', 'Larangan', 'Petunjuk', 'Perintah', 'B'),
(3, 'Apa arti rambu lingkaran biru?', 'Perintah', 'Larangan', 'Peringatan', 'Petunjuk', 'A'),
(4, 'Apa arti rambu persegi hijau dengan simbol jalan tol?', 'Petunjuk', 'Larangan', 'Peringatan', 'Informasi', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `rambu`
--

CREATE TABLE `rambu` (
  `id` int(11) NOT NULL,
  `nama_rambu` varchar(255) NOT NULL,
  `tipe_rambu` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rambu`
--

INSERT INTO `rambu` (`id`, `nama_rambu`, `tipe_rambu`, `image`, `deskripsi`) VALUES
(1, 'Rambu Stop', 'peringatan', 'rambu_stop.jpg', 'Rambu ini digunakan untuk menginstruksikan pengemudi agar berhenti.'),
(2, 'Rambu Dilarang Parkir', 'larangan', 'dilarang_parkir.jpg', 'Rambu ini melarang kendaraan untuk parkir di area tersebut.'),
(3, 'Rambu Jalan Tol', 'petunjuk', 'jalan_tol.jpg', 'Rambu ini memberikan petunjuk arah menuju jalan tol.'),
(4, 'Rambu Belok Kanan', 'perintah', 'belok_kanan.jpg', 'Rambu ini memerintahkan pengemudi untuk belok kanan terus jalan.'),
(5, 'Peringatan belok kanan', 'peringatan', 'peringatan_belok_kanan.jpg', 'peringatan ini menandakan akan ada belok kanan di jalan depan'),
(6, 'Peringatan ada pekerjaan', 'peringatan', 'peringatan_pekerjaan.png\r\n', 'peringatan ada pekerjaan perbaikan jalan'),
(7, 'Peringatan pejalan kaki', 'peringatan', 'peringatan_pejalan_kaki.jpg', 'rambu ini menandakan peringatan ada daerah pejalan kaki');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com\r\n', 'admin', 1, '2024-12-19 14:14:12'),
(2, 'user', '', 'user\r\n', 0, '2024-12-19 14:14:12'),
(3, 'sulthan', 's@gmail.com', '$2y$10$2R4GAVFM1fsIpLcL4nqkAu9x8y3m/cZjjm6nwkiXdOJauqwf16YBW', 0, '2024-12-19 18:24:46'),
(4, 'a', 'a@a', '$2y$10$LAImR3LCdTJ6.nqr3GgJLOnID1DTcUIiKPaXpkWfWGBf33aY7aCU6', 0, '2024-12-21 10:34:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rambu`
--
ALTER TABLE `rambu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rambu`
--
ALTER TABLE `rambu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
