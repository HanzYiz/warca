-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2025 at 03:11 PM
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
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publisher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year_book` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cover_img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `desc_book` varchar(900) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publisher`, `year_book`, `isbn`, `category`, `cover_img`, `stock`, `price`, `desc_book`) VALUES
(95, '7 in 1 PEMROGRAMAN WEB UNTUK PEMULA', 'Rohi Abdullah', 'PT Elex Media Komputindo', '2022-12', '978-602-04-7943-9', 'Education', '7in1_Pemrograman Web untuk Pemula.jpg', 10, '60.000', 'Buku 7 in 1 Pemrograman Web untuk Pemula merupakan panduan praktis bagi siapa saja yang ingin mempelajari dasar-dasar pengembangan web. Diterbitkan pada tahun 2022, buku ini menyajikan tujuh topik penting dalam satu paket, termasuk HTML, CSS, JavaScript, PHP, MySQL, Bootstrap, dan pengenalan framework. Setiap topik dijelaskan dengan bahasa yang mudah dipahami, dilengkapi dengan contoh dan latihan yang aplikatif. Cocok untuk pemula yang ingin membangun fondasi kuat dalam dunia pemrograman web'),
(97, 'Bandung After Rain', 'Wulan Nur Amalia', 'PT Sinar Angsa Media – Black S', '2024-10', '978-623-10-3143-3', 'Novel', 'Bandung-After-Rain.jpg', 30, '90.000', 'Bandung After Rain adalah novel romansa yang mengisahkan perjalanan cinta Hema dan Rania, dua insan yang telah menjalin hubungan selama enam tahun lebih. Namun, hubungan mereka harus berakhir tepat sebulan sebelum hari jadi ketujuh mereka karena kesalahan fatal yang dilakukan Hema.\r\n\r\nSetelah perpisahan itu, Hema diliputi penyesalan dan menyadari bahwa cinta bukan hanya tentang memberi apa yang diinginkan pasangan, tetapi juga tentang memahami, menghargai, dan berjuang bersama.\r\n\r\nDengan latar Kota Bandung yang penuh kenangan, novel ini menggambarkan upaya Hema untuk merebut kembali hati Rania.\r\n\r\nDapatkah kenangan manis dan hujan di Bandung menyatukan mereka kembali?'),
(98, 'Ubur-Ubur Lembur', 'Raditya Dika', 'GagasMedia', '2018-02', '978-979-780-915-7', 'Novel', 'Ubur-ubur-Lembur.jpg', 20, '66.000', 'Ubur-Ubur Lembur adalah kumpulan esai humor yang diangkat dari pengalaman pribadi Raditya Dika. Buku ini menampilkan 14 cerita yang menggabungkan humor khas Radit dengan refleksi kehidupan sehari-hari, mulai dari cinta, patah hati, hingga dinamika kehidupan publik figur.\r\nDelina Books\r\n\r\nDengan gaya penulisan yang ringan dan menghibur, Radit mengajak pembaca untuk melihat sisi lucu dari hal-hal remeh dalam kehidupan.\r\n\r\nBuku ini cocok untuk pembaca yang mencari hiburan sekaligus pelajaran hidup dari sudut pandang yang unik dan jenaka.\r\n\r\n                '),
(99, '9 Langkah Praktis Mahir Microsoft Office Word 2007', 'Fahri Rahadianka', 'WahyuMedia', '2009-01', '978-979-795-270-9', 'Education', '9 Langkah Praktis Mahir Microsoft Office Word 2007.jpeg', 30, '31.000', 'Buku ini dirancang untuk membantu pembaca menguasai Microsoft Office Word 2007 secara mudah dan cepat melalui sembilan langkah praktis. Setiap langkah dibahas secara jelas dan tuntas, dilengkapi dengan CD tutorial untuk mempermudah pemahaman dan praktik.'),
(100, 'Kita Pasti Sendiri', 'Hello Bagas', 'Studio Helobagas', '2024-10', '978-623-104-060-2', 'Novel', 'kita pasti sendiri.jpg', 40, '90.000', 'Kita Pasti Sendiri adalah buku esai reflektif yang mengajak pembaca untuk merenungi makna kesendirian dan kehilangan dalam kehidupan. Melalui bab-bab yang ditulis dengan tulus dan jujur, Helo Bagas berbagi pemikiran tentang bagaimana menghadapi perpisahan, kehilangan orang terdekat, dan proses menyayangi diri sendiri. Buku ini cocok bagi siapa saja yang sedang menjalani fase kesepian atau ingin memahami lebih dalam tentang pentingnya mencintai diri sendiri.\r\n\r\n'),
(101, 'THE PROMISED NEVERLAND', 'Kaiu Shirai &amp; Posuka Demizu', 'Shueisha', '2025-01', '978-4-08-880872-7', 'Manga', 'THE PROMISED NEVERLAND.jpg', 12, '32.000', 'Pada tahun 2045, Emma, Norman, dan Ray adalah tiga anak yatim piatu berusia 11 tahun yang tinggal di panti asuhan Grace Field House bersama 37 anak lainnya. Mereka menjalani kehidupan yang tampaknya ideal di bawah asuhan &quot;Mama&quot; Isabella. Namun, kehidupan bahagia mereka berubah drastis ketika mereka menemukan bahwa panti asuhan tersebut sebenarnya adalah peternakan manusia, di mana anak-anak dibesarkan untuk menjadi santapan bagi makhluk yang disebut &quot;demon&quot;. Mengetahui kebenaran mengerikan ini, ketiganya merencanakan pelarian untuk menyelamatkan diri dan anak-anak lainnya, menghadapi berbagai tantangan dan bahaya di dunia luar yang tidak mereka kenal.                '),
(102, 'Poconggg Juga Pocong', 'Arief Muhammad', 'Bukune', '2011-06', '602-220-002-4', 'Novel', 'Poconggg Juga Pocong.jpg', 40, '36.000', 'Poconggg Juga Pocong adalah buku bergenre komedi yang ditulis oleh @Poconggg, sosok fenomenal dari dunia maya yang dikenal melalui akun Twitter-nya. Buku ini menyajikan kisah-kisah kocak dan absurd dari sudut pandang seorang pocong jomblo yang berusaha menjalani \"kehidupan\" setelah kematian.\r\nDengan gaya bahasa yang ringan dan penuh humor, pembaca diajak untuk menyelami pengalaman-pengalaman unik sang pocong, mulai dari kisah cinta sejenis (dengan sesama setan), perjuangan menjadi pocong jantan sejati, hingga ramalan-ramalan konyol yang menggelitik.\r\nDengan gaya bahasa yang ringan dan penuh humor, pembaca diajak untuk menyelami pengalaman-pengalaman unik sang pocong, mulai dari kisah cinta sejenis (dengan sesama setan), perjuangan menjadi pocong jantan sejati, hingga ramalan-ramalan konyol yang menggelitik.\r\n'),
(104, 'Semua Ada Prosesnya, Berhentilah Membandingkan Dirimu dengan Orang Lain', 'Rendy Ariyanto', 'Ranah Buku', '2022-10', '978-623-09-0462-2', 'Motivation', '6828b8a1f1c6b.jpeg', 0, '60.000', 'Dalam buku ini, Rendy Ariyanto menekankan bahwa kebiasaan membandingkan diri dengan orang lain dapat menyebabkan hilangnya identitas diri, memicu perasaan iri, dan menurunkan rasa percaya diri. Penulis mengajak pembaca untuk memahami bahwa setiap individu memiliki proses dan waktu yang berbeda dalam mencapai tujuan hidupnya. Dengan menyadari hal ini, pembaca diharapkan dapat lebih menghargai diri sendiri dan perjalanan hidupnya tanpa terpengaruh oleh pencapaian orang lain.');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `borrowing_id` int NOT NULL,
  `users_id` int NOT NULL,
  `book_id` int NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `type` enum('Borrow','Buy') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('pending','approved','returned','rejected') COLLATE utf8mb4_general_ci NOT NULL,
  `receipt` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`borrowing_id`, `users_id`, `book_id`, `borrow_date`, `return_date`, `type`, `status`, `receipt`) VALUES
(70, 22, 97, '2025-06-20', '2025-06-20', 'Buy', 'approved', '685570d905f9b.jpg'),
(71, 22, 95, '2025-06-20', '2025-06-20', 'Borrow', 'returned', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` int NOT NULL,
  `borrowing_id` int NOT NULL,
  `return_date` date NOT NULL,
  `fine` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`return_id`, `borrowing_id`, `return_date`, `fine`) VALUES
(21, 71, '2025-06-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auth_key` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `name`, `email`, `password`, `profile`, `role`, `gender`, `address`, `phone`, `auth_key`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$7mBVvn0nGh1cvduIlbnlju7QdbvL89PIurXz9j0puyAv9xEUsWI0S', '682a04604dbcb.jpg', 'admin', 'male', 'Bekasi', '111111', 'GS2WB5422L5ZDOBG'),
(22, 'Iib Ibrahim', 'iibibrhm@gmail.com', '$2y$10$VhF7gf6/fzYVm6Q2BElDluoksPmfwfaMt/axTKfS9TtrqVA8Yn6HK', 'profile.jpg', 'user', 'male', 'Ujung Harapan', '111', 'AWSZSID6BBHJNP7N'),
(29, 'Hafidz Prasetyo', 'apis@gmail.com', '$2y$10$VGSFSlaS/WNt/CybsycNcu3MJtVoi9e3f2WHQYU/aaqAYMGylIQt6', '682848929b111.jpg', 'user', 'male', 'Taruma Jaya', '11111', 'LZEYH42WXMEZ7CMY'),
(32, 'Sandy Fitriansyah', 'sandy@gmail.com', '$2y$10$HGikBETaHw3e8xXqNbBAY.pcmtKYmLXVX2.Cl5JrHXVfp2HCdw.me', '682aea1844653.jpg', 'user', 'male', 'Tambun', '11111', NULL),
(149, 'Riri Yuliana Febriyanti', 'riri@gmail.com', '$2y$10$zQzNcKzkTtvWvkJu81jhiOyuhbIKSbD2pxz0bUBYxABdnO8aCV90i', NULL, 'user', NULL, NULL, NULL, NULL),
(150, 'Elsya Salsabila', 'elsya@gmail.com', '$2y$10$L/l.NoutffucsDg4uHxwq.Cr.whseKjbS8/Px6IzqyGTPOXGkJbsW', NULL, 'user', NULL, NULL, NULL, NULL),
(159, 'test', 'test@gmail.com', '$2y$10$b1RER0LYeTlZUGMDl.2Ki..sYceJfn/yr3O9reWNW2cGclJWtbqji', NULL, 'admin', NULL, NULL, NULL, 'RRZCTAVVHHL2GGAF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `borrowing_id` (`borrowing_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `borrowing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `return_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`borrowing_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
