-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 04:14 PM
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
(4, 'Apa arti rambu persegi hijau dengan simbol jalan tol?', 'Petunjuk', 'Larangan', 'Peringatan', 'Informasi', 'A'),
(5, 'Apa arti rambu segitiga dengan gambar anak-anak menyeberang jalan?', 'Larangan berhenti', 'Hati-hati, area sekolah', 'Larangan parkir', 'Dilarang masuk', 'B'),
(6, 'Apa arti rambu segitiga dengan garis zig-zag di dalamnya?', 'Jalan licin', 'Jalan bergelombang', 'Tikungan tajam', 'Jalan menurun', 'A'),
(7, 'Apa arti rambu segitiga dengan gambar sapi?', 'Area peternakan', 'Hati-hati, ada hewan melintas', 'Larangan membawa hewan', 'Tempat parkir hewan', 'B'),
(8, 'Apa arti rambu segitiga dengan tanda seru di tengahnya?', 'Perhatian khusus', 'Larangan masuk', 'Jalan rusak', 'Tikungan tajam', 'A'),
(9, 'Apa arti rambu segitiga dengan gambar kereta api tanpa palang pintu?', 'Perlintasan kereta api tanpa palang pintu', 'Perlintasan kereta api dengan palang pintu', 'Stasiun kereta api', 'Tempat pemberhentian kereta api', 'A'),
(10, 'Apa arti rambu lingkaran merah dengan garis diagonal dan gambar mobil?', 'Larangan parkir', 'Larangan masuk untuk kendaraan bermotor', 'Larangan berhenti', 'Larangan melintas', 'B'),
(11, 'Apa arti rambu lingkaran merah dengan angka \"50\" di dalamnya?', 'Kecepatan minimum 50 km/jam', 'Kecepatan maksimum 50 km/jam', 'Jalan khusus kendaraan roda dua', 'Jalan satu arah', 'B'),
(12, 'Apa arti rambu lingkaran merah dengan gambar sepeda motor?', 'Larangan masuk untuk sepeda motor', 'Jalur khusus sepeda motor', 'Tempat parkir sepeda motor', 'Area balapan sepeda motor', 'A'),
(13, 'Apa arti rambu lingkaran merah dengan tanda \"P\" dicoret?', 'Larangan berhenti', 'Larangan parkir', 'Parkir khusus kendaraan besar', 'Parkir berbayar', 'B'),
(14, 'Apa arti rambu lingkaran merah dengan tanda \"U\" berbalik dicoret?', 'Larangan memutar balik arah', 'Jalur khusus kendaraan besar', 'Tikungan tajam ke kanan', 'Jalur satu arah', 'A'),
(15, 'Apa arti rambu persegi panjang biru dengan huruf \"P\" putih di dalamnya?', 'Tempat parkir', 'Jalur sepeda motor', 'Jalur kendaraan umum', 'Tempat pemberhentian bus', 'A'),
(16, 'Apa arti rambu persegi panjang biru dengan gambar telepon?', 'Tempat istirahat pengemudi', 'Lokasi telepon umum', 'Lokasi kantor polisi terdekat', 'Lokasi rumah sakit terdekat', 'B'),
(17, 'Apa arti rambu persegi panjang biru dengan gambar huruf \"H\"?', 'Rumah sakit', 'Hotel', 'Helipad', 'Halt (berhenti)', 'A'),
(18, 'Apa arti rambu persegi panjang biru dengan gambar bus?', 'Terminal bus', 'Tempat pemberhentian bus', 'Area parkir bus', 'Bus dilarang masuk', 'B'),
(19, 'Apa arti rambu persegi panjang biru dengan tanda panah ke atas?', 'Lurus terus', 'Jalan prioritas', 'Ikuti jalan utama', 'Dilarang belok', 'A'),
(20, 'Apa arti rambu lingkaran biru dengan panah ke kiri?', 'Belok kiri wajib', 'Belok kiri hati-hati', 'Belok kiri dilarang', 'Belok kiri opsional', 'A'),
(21, 'Apa arti rambu lingkaran biru dengan gambar sepeda motor?', 'Jalur khusus sepeda motor', 'Sepeda motor wajib masuk jalur ini', 'Sepeda motor dilarang masuk jalur ini', 'Parkir sepeda motor tersedia di sini', 'A'),
(22, 'Apa arti rambu lingkaran biru dengan tanda panah melingkar?', 'Putar balik wajib', 'Putar balik opsional', 'Putar balik dilarang', 'Ikuti jalan memutar', 'A'),
(23, 'Apa arti rambu lingkaran biru dengan tanda panah ke kanan?', 'Belok kanan wajib', 'Belok kanan opsional', 'Belok kanan hati-hati', 'Belok kanan dilarang', 'A'),
(24, 'Apa arti rambu lingkaran biru kosong tanpa simbol?', 'Ikuti perintah berikutnya di jalan utama', 'Zona perintah dimulai dari sini', '', 'Zona aman dimulai dari sini. ', 'A'),
(25, 'Rambu berbentuk segitiga terbalik berwarna merah tanpa simbol berarti? ', 'Berhenti total ', 'Berikan prioritas ', 'Zona bahaya ', 'Ikuti jalan utama ', 'B'),
(26, 'Rambu berbentuk kotak hijau menunjukkan? ', 'Informasi tambahan ', 'Zona aman ', 'Area istirahat ', 'Petunjuk arah ', 'D'),
(27, 'Apa arti rambu segitiga dengan gambar jalan bergelombang?', 'Jalan licin', 'Jalan bergelombang', 'Jalan menurun', 'Jalan rusak', 'B'),
(28, 'Apa arti rambu segitiga dengan gambar batu jatuh?', 'Hati-hati ada longsor', 'Hati-hati ada batu jatuh', 'Jalan licin', 'Jalan bergelombang', 'B'),
(29, 'Apa arti rambu segitiga dengan gambar tikungan ke kanan?', 'Tikungan tajam ke kanan', 'Larangan belok kanan', 'Jalan utama ke kanan', 'Belok kanan wajib', 'A'),
(30, 'Apa arti rambu segitiga dengan gambar dua anak berjalan kaki?', 'Perlintasan anak sekolah', 'Area bermain anak-anak', 'Zona aman pejalan kaki', 'Zona dilarang masuk kendaraan besar', 'A'),
(31, 'Apa arti rambu segitiga dengan gambar pesawat?', 'Bandara di depan', 'Zona larangan terbang rendah', 'Hati-hati pesawat melintas rendah', 'Pangkalan militer di depan', 'C'),
(32, 'Apa arti rambu lingkaran merah dengan tanda \"S\" dicoret?', 'Dilarang berhenti di area ini', 'Dilarang parkir di area ini', 'Dilarang melewati jalan ini', 'Dilarang memutar arah di area ini', 'A'),
(33, 'Apa arti rambu lingkaran merah dengan tanda \"E\" dicoret?', 'Dilarang masuk kendaraan besar', 'Dilarang parkir kendaraan berat', 'Dilarang parkir sepanjang hari kerja', 'Dilarang parkir pada jam tertentu', 'C'),
(34, 'Apa arti rambu lingkaran merah dengan tanda \"60\" di dalamnya?', 'Kecepatan minimum 60 km/jam', 'Kecepatan maksimum 60 km/jam', 'Kecepatan rata-rata 60 km/jam wajib dipatuhi', 'Zona aman untuk kecepatan 60 km/jam saja', 'B'),
(35, 'Apa arti rambu lingkaran merah dengan tanda \"P\" dicoret dan garis diagonal?', 'Parkir dilarang total di area ini.', 'Parkir hanya diperbolehkan pada malam hari.', 'Parkir hanya diperbolehkan untuk kendaraan roda dua.', 'Parkir diperbolehkan untuk kendaraan besar.', 'A'),
(36, 'Apa arti rambu lingkaran merah dengan tanda \"U\" dicoret?', 'Larangan memutar balik arah.', 'Larangan belok kiri.', 'Larangan belok kanan.', 'Larangan berhenti.', 'A'),
(37, 'Apa arti rambu persegi panjang biru dengan gambar tempat tidur?', 'Hotel atau penginapan di depan.', 'Rumah sakit terdekat.', 'Tempat istirahat pengemudi.', 'Zona aman untuk berkemah.', 'A'),
(38, 'Apa arti rambu persegi panjang biru dengan gambar huruf \"R\"?', 'Restoran atau tempat makan di depan.', 'Rumah sakit terdekat.', 'Area peristirahatan.', 'Zona aman untuk kendaraan besar.', 'A'),
(39, 'Apa arti rambu persegi panjang biru dengan gambar bus?', 'Terminal bus di depan.', 'Tempat pemberhentian bus.', 'Area parkir bus.', 'Bus dilarang masuk area ini.', 'B'),
(40, 'Apa arti rambu persegi panjang biru dengan tanda panah ke atas dan ke kanan?', 'Ikuti jalan utama ke kanan.', 'Belok kanan wajib.', 'Belok kanan opsional.', 'Lurus atau belok kanan diperbolehkan.', 'D'),
(41, 'Apa arti rambu persegi panjang biru dengan simbol telepon?', 'Lokasi telepon umum tersedia.', 'Tempat istirahat pengemudi.', 'Lokasi kantor polisi terdekat.', 'Lokasi rumah sakit terdekat.', 'A'),
(42, 'Apa arti rambu segitiga dengan gambar jalan menurun?', 'Hati-hati jalan menurun', 'Jalan licin', 'Jalan bergelombang', 'Zona bahaya', 'A'),
(43, 'Apa arti rambu segitiga dengan gambar kendaraan tergelincir?', 'Jalan rusak', 'Jalan licin', 'Jalan bergelombang', 'Jalan menurun', 'B'),
(44, 'Apa arti rambu segitiga dengan gambar dua garis menyempit?', 'Jalan menyempit di depan', 'Jalan bercabang', 'Jalan utama ke kiri', 'Zona aman', 'A'),
(45, 'Apa arti rambu segitiga dengan gambar lampu lalu lintas?', 'Persimpangan jalan', 'Zona lampu lalu lintas', 'Hati-hati lampu lalu lintas di depan', 'Zona aman kendaraan besar', 'C'),
(46, 'Apa arti rambu segitiga dengan gambar perahu?', 'Area pelabuhan di depan', 'Hati-hati ada perahu melintas', 'Zona aman untuk kendaraan besar', 'Area penyeberangan sungai di depan', 'D'),
(47, 'Apa arti rambu lingkaran merah dengan tanda \"T\" dicoret?', 'Larangan masuk ke jalur tertentu', 'Larangan berhenti total di area ini', 'Larangan belok kiri atau kanan', 'Larangan memutar arah di area ini', 'C'),
(48, 'Apa arti rambu lingkaran merah dengan tanda \"30\" di dalamnya?', 'Kecepatan minimum 30 km/jam', 'Kecepatan maksimum 30 km/jam', 'Kecepatan rata-rata wajib 30 km/jam', 'Zona aman untuk kecepatan 30 km/jam saja', 'B'),
(49, 'Apa arti rambu lingkaran merah dengan gambar truk dicoret?', 'Dilarang masuk untuk kendaraan berat atau truk.', 'Truk hanya diperbolehkan pada malam hari.', 'Truk dilarang parkir di area ini.', 'Truk hanya diperbolehkan membawa muatan ringan.', 'A'),
(50, 'Apa arti rambu lingkaran merah dengan tanda \"S\" dicoret?', 'Dilarang berhenti di area ini.', 'Dilarang parkir sepanjang hari.', 'Dilarang melewati jalan ini.', 'Dilarang memutar arah di area ini.', 'A'),
(51, 'Apa arti rambu lingkaran merah dengan tanda \"L\" dicoret?', 'Larangan belok kiri.', 'Larangan belok kanan.', 'Larangan berhenti total.', 'Larangan memutar arah.', 'A'),
(52, 'Apa arti rambu persegi panjang biru dengan simbol rumah sakit?', 'Rumah sakit terdekat.', 'Zona aman untuk kendaraan besar.', 'Area istirahat pengemudi.', 'Tempat pemberhentian bus.', 'A'),
(53, 'Apa arti rambu persegi panjang biru dengan simbol huruf \"P\"?', 'Tempat parkir tersedia.', 'Parkir dilarang total.', 'Parkir hanya diperbolehkan untuk kendaraan besar.', 'Parkir hanya diperbolehkan pada malam hari.', 'A'),
(54, 'Apa arti rambu persegi panjang biru dengan simbol restoran?', 'Restoran atau tempat makan tersedia di depan.', 'Rumah sakit terdekat.', 'Area istirahat pengemudi.', 'Zona aman untuk kendaraan berat.', 'A'),
(55, 'Apa arti rambu persegi panjang biru dengan simbol telepon umum?', 'Lokasi telepon umum tersedia.', 'Tempat istirahat pengemudi.', 'Lokasi kantor polisi terdekat.', 'Lokasi rumah sakit terdekat.', 'A'),
(56, 'Apa arti rambu persegi panjang biru dengan simbol bus?', 'Terminal bus tersedia di depan.', 'Tempat pemberhentian bus.', 'Area parkir bus.', 'Bus dilarang masuk area ini.', 'B'),
(57, 'Apa arti rambu lingkaran biru dengan tanda panah lurus ke atas?', 'Lurus terus wajib.', 'Lurus terus opsional.', 'Lurus terus dilarang.', 'Lurus terus hati-hati.', 'A'),
(58, 'Apa arti rambu lingkaran biru dengan tanda panah ke kiri?', 'Belok kiri wajib.', 'Belok kiri opsional.', 'Dilarang belok kiri.', 'Hati-hati belok kiri.', 'A'),
(59, 'Apa arti rambu lingkaran biru dengan tanda panah melingkar?', 'Putar balik wajib dilakukan.', 'Dilarang putar balik arah.', 'Hati-hati saat memutar balik arah.', 'Opsi putar balik tersedia.', 'A'),
(60, 'Apa arti rambu lingkaran biru kosong tanpa simbol?', 'Mengikuti aturan lalu lintas berikutnya wajib dilakukan.', 'Tidak ada perintah khusus berlaku di area ini.', 'Mengikuti jalur utama opsional dilakukan.', 'Mengikuti aturan jalur utama dilarang dilakukan.', 'A');

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
  `profile_photo` varchar(255) DEFAULT 'images/default_avatar.jpg',
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_photo`, `is_admin`, `created_at`) VALUES
(3, 'sulthan', 's@gmail.com', '$2y$10$2R4GAVFM1fsIpLcL4nqkAu9x8y3m/cZjjm6nwkiXdOJauqwf16YBW', 'images/6768b17b65814.jpg', 0, '2024-12-19 18:24:46'),
(4, 'a', 'a@a', '$2y$10$LAImR3LCdTJ6.nqr3GgJLOnID1DTcUIiKPaXpkWfWGBf33aY7aCU6', 'default-avatar.png', 1, '2024-12-21 10:34:04'),
(6, 'b', 'b@gmail.com', '$2y$10$Lg1L/Ml0At3CpfaJV.XxY.Tm3Tr1Z4Nt1Rb2BFkAAkin/SqkaB4Ja', 'images/6768bdf9d3fc0.jpg', 0, '2024-12-23 01:31:53'),
(9, 'c', 'c@gmail.com', '$2y$10$QWkJcLsq3FqhUkvyr4bW6OWqb/XDvopLmxVh76XE6tyyWIiY.w0pq', 'images/67697b33e8abc.jpg', 0, '2024-12-23 14:15:35'),
(10, 'd', 'd@gmail.com', '$2y$10$IWEo3Vp8Kl9o/pfWMd11F.iZ0YkMAkiaNA4SDffr2g.CGdhuAuDFy', 'images/default_avatar.jpg', 0, '2024-12-23 15:13:33');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `rambu`
--
ALTER TABLE `rambu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
