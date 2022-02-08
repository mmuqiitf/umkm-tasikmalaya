-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 11:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm-tasikmalaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_umkm`
--

CREATE TABLE `jenis_umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_umkm`
--

INSERT INTO `jenis_umkm` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Usaha Bidang Pangan', 1, '2022-01-11 06:18:58', '2022-02-05 01:41:50'),
(4, 'Usaha Bidang Sandang', 1, '2022-01-11 06:20:23', '2022-02-05 01:39:48'),
(5, 'Usaha Bidang Teknologi', 1, '2022-01-11 06:20:46', '2022-01-11 06:20:46'),
(6, 'Usaha Bidang Kosmetik dan Kecantikan', 1, '2022-01-11 06:21:18', '2022-02-05 01:38:48'),
(7, 'Usaha Bidang Otomotif', 1, '2022-01-11 06:21:39', '2022-01-11 06:21:39'),
(8, 'Usaha Bidang Cendra Mata', 1, '2022-01-11 06:22:59', '2022-01-11 06:22:59'),
(9, 'Usaha Bidang Agrobisnis', 1, '2022-01-11 06:23:36', '2022-01-11 06:23:36'),
(10, 'Usaha Bidang Pendidikan', 1, '2022-02-05 01:43:07', '2022-02-05 01:43:07'),
(11, 'Usaha Bidang Tour dan Travel', 1, '2022-02-05 01:43:42', '2022-02-05 01:43:42'),
(12, 'Usaha Bidang Produk Kreatif', 1, '2022-02-05 01:44:24', '2022-02-05 01:44:24'),
(13, 'Usaha Bidang Jasa', 1, '2022-02-05 01:44:48', '2022-02-05 01:44:48'),
(14, 'Usaha Bidang Kebutuhan Anak', 1, '2022-02-05 01:45:40', '2022-02-05 01:45:40'),
(15, 'Usaha Bidang Event Organizer', 1, '2022-02-05 01:46:24', '2022-02-05 01:46:24'),
(16, 'Usaha Bidang Lain-lain', 1, '2022-02-05 01:47:02', '2022-02-05 01:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Kecamatan Bungursari', 1, '2021-12-25 14:38:36', '2021-12-25 14:38:56'),
(3, 'Kecamatan Cibeureum', 1, '2021-12-25 14:56:33', '2021-12-25 14:56:33'),
(4, 'Kecamatan Cihideung', 1, '2021-12-25 14:57:03', '2021-12-25 14:57:03'),
(5, 'Kecamatan Cipedes', 1, '2021-12-25 14:57:25', '2021-12-25 14:57:25'),
(6, 'Kecamatan Indihiang', 1, '2021-12-25 14:58:04', '2021-12-25 14:58:04'),
(7, 'Kecamatan Kawalu', 1, '2021-12-25 14:58:19', '2021-12-25 14:58:19'),
(8, 'Kecamatan Mangkubumi', 1, '2021-12-25 14:58:31', '2021-12-25 14:58:31'),
(9, 'Kecamatan Purbaratu', 1, '2021-12-25 14:58:56', '2021-12-25 14:58:56'),
(10, 'Kecamatan Tamansari', 1, '2021-12-25 14:59:11', '2021-12-25 14:59:11'),
(11, 'Kecamatan Tawang', 1, '2021-12-25 14:59:27', '2021-12-25 14:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_25_094001_create_kecamatan_table', 2),
(6, '2021_12_25_094445_create_jenis_umkm_table', 2),
(7, '2021_12_25_094700_create_umkm_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_umkm_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id`, `name`, `description`, `photo`, `address`, `jenis_umkm_id`, `user_id`, `kecamatan_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(10, 'Monalisa Jaya Bordir', 'Monalisa Jaya Bordir merupakan usaha membuat dan menjual pakaian bordir.', 'kawalu_-_monalisa_jaya_bordir.jpg', 'Jalan Perintis Kemerdekaan, Kec. Kawalu, Kota. Tasikmalaya', 4, 8, 7, '-7.372581031132136', '108.21264936507926', '2022-02-05 00:03:46', '2022-02-05 00:03:46'),
(11, 'Toko Kelontong Hidayah', 'Toko Kelontong Hidayah merupakan usaha yang menjual makanan kelontong.', 'kawalu_-_toko_kelontong_hidayah.jpg', 'Jl. Perintis Kemerdekaan, Kel. Karsamenak, Kec. Kawalu, Kota Tasikmalaya', 3, 9, 7, '-7.381976856117576', '108.20879131187405', '2022-02-05 00:09:08', '2022-02-05 00:09:08'),
(12, 'Dewi Cosmetic', 'Toko Dewi Cosmetic merupakan sebuah usaha yang menjual berbagai macam kosmetik.', 'cihideung_-_dewi_cosmetic.jpg', 'Jalan Pasar wetan ruko no 7, Argasari, Kec. Cihideung, Kota. Tasikmalaya', 6, 10, 4, '-7.3254159043729015', '108.21529759468295', '2022-02-05 00:15:37', '2022-02-05 00:15:37'),
(13, 'Zamzam Fashion', 'Zamzam Fashion merupakan sebuah usaha yang menjual berbagai macam pakaian.', 'cihideung_-_zam_zam_fashion.jpg', 'Jl. Tentara Pelajar No.36, Nagarawangi, Kec. Cihideung, Kota Tasikmalaya', 4, 11, 4, '-7.333503732208125', '108.22072562536697', '2022-02-05 00:19:42', '2022-02-05 01:20:33'),
(14, 'Istana Kaling Ayam Potong', 'Istana Kaling Ayam Potong merupakan sebuah usaha yang menjual ayam potong.', 'mangkubumi_-_istana_kaling_ayam_potong.jpg', 'Linggajaya, Mangkubumi, Tasikmalaya', 9, 12, 8, '-7.3390766484632435', '108.20474636769609', '2022-02-05 00:24:01', '2022-02-05 00:24:01'),
(15, 'AZA Sandal Sacral', 'AZA Sandal Sacral merupakan sebuah usaha yang memproduksi dan menjual berbagai sandal.', 'mangkubumi_-_aza_sandal_sacral.jpg', 'Jl. Sambong Asem, RT.04/RW.01,Kec. Mangkubumi,Kota Tasikmalaya', 4, 13, 8, '-7.348908458538745', '108.1963974118736', '2022-02-05 00:27:40', '2022-02-05 01:19:53'),
(16, 'Akbar Foto Studio', 'Akbar Foto Studi merupakan sebuah usaha menggunkan studio foto untuk mengabadikan moment.', 'tawang_-_akbar_foto_studio.PNG', 'Jl. Tanuwijaya No.1A, Empangsari, Kec. Tawang, Kota Tasikmalaya', 5, 14, 11, '-7.309972251605114', '108.2257992016231', '2022-02-05 00:31:00', '2022-02-05 00:31:00'),
(17, 'Toko Oneng', 'Toko Oneng merupakan usaha yang menjual makanan.', 'tawang_-_toko_oneng.jpg', 'Jl. BKR No.18, Kahuripan, Kec. Tawang, Kota Tasikmalaya', 3, 15, 11, '-7.34255214121415', '108.22276061899919', '2022-02-05 00:35:05', '2022-02-05 00:35:05'),
(18, 'Percetakan Agnia', 'Percetakan Agnia merupakan usaha percetakan memproduksi tulisan dan gambar, terutama dengan tinta di atas kertas menggunakan sebuah mesin cetak.', 'tamansari_-_percetakan_agnia.jpg', 'JL Taman Sari Gobras, No. 32, Kec. Tamansari, Kota Tasikmalaya', 5, 16, 10, '-7.374383498727961', '108.24309527354721', '2022-02-05 00:38:53', '2022-02-05 00:38:53'),
(19, 'Diana Konveksi', 'Diana Konveksi merupakan sebuah usaha memproduksi dan menjual pakaian.', 'tamansari_-_diana_konveksi.jpg', 'Perum Asri Residence Tamansari No.10, Mulyasari, Kec. Tamansari, Kota Tasikmalaya', 5, 17, 10, '-7.359948114854356', '108.22596901901862', '2022-02-05 00:44:21', '2022-02-05 00:44:21'),
(20, 'Hikmah Multimedia', 'Hikmah Multimedia merupakan sebuah usaha service barang elektronik.', 'indihiang_-_hikmah_multimedia.PNG', 'Jl. Ibrahim Adjie No.224 A, Sirnagalih, Kec. Indihiang, Kota Tasikmalaya', 7, 18, 6, '-7.287910295633318', '108.20057673414148', '2022-02-05 00:47:30', '2022-02-05 00:47:30'),
(21, 'Bengkel Sepeda Herdi', 'Bengkel Sepeda Herdi merupakan sebuah usaha service khusus sepeda.', 'indihiang_-_bengkel_sepeda_hardi.jpg', 'Indihiang, Kec. Indihiang, Kota Tasikmalaya', 7, 19, 6, '-7.291172517657596', '108.20046658085346', '2022-02-05 00:51:24', '2022-02-05 00:51:24'),
(22, 'Toko Subur Putra', 'Toko Subur Putra merupakan usaha yang menjual makanan kelontong.', 'cibeureum_-_toko_subur_putra.jpg', 'Jl. Kolonel Basyir Surya No.100, Setianagara, Kec. Cibeureum, Kota Tasikmalaya', 3, 20, 3, '-7.348192394432419', '108.25724941754055', '2022-02-05 00:54:17', '2022-02-05 00:54:17'),
(23, 'Warung Nasi Bu Nani', 'Warung Nasi Bu Nani merupakan usaha yang menjual makanan siap makan.', 'cibeureum-_warung_nasi_bu_nani.PNG', 'Jl. KH. Khoer Affandi, Setianagara, Kec. Cibeureum, Kota Tasikmalaya', 3, 21, 3, '-7.347371984343622', '108.25675450153086', '2022-02-05 00:57:37', '2022-02-05 00:57:37'),
(24, 'Seblak Teh Ima', 'Seblak Teh Ima merupakan usaha yang menjual makanan siap makan.', 'bungursari_-_seblak_teh_ima.PNG', 'Jl. Jati Pamijahan, Sukarindik, Kec. Bungursari, Kab. Tasikmalaya', 3, 22, 2, '-7.304683792943652', '108.19793881946353', '2022-02-05 01:00:23', '2022-02-05 01:19:05'),
(25, 'Kedai Salad Buah', 'Kedai Salad Buah merupakan usaha yang menjual salad buah dan aneka makanan ringan lainnya.', 'bungursari_-_kedai_salad_buah.jpg', 'Jl.setiarasa terusan, perum, Sukarindik, Kec. Bungursari, Kota Tasikmalaya', 3, 23, 2, '-7.30344004911866', '108.199790339755', '2022-02-05 01:03:35', '2022-02-05 01:03:35'),
(26, 'Cilok Goang Enyoy', 'Cilok goang Enyoy merupakan usaha yang menjual cilok goang.', 'cipedes_-_cilok_goang_enyoy.jpg', 'Jl. Mitra Batik No.73, Kec. Cipedes, Kota Tasikmalaya', 3, 24, 5, '-7.318583149011911', '108.21502694070877', '2022-02-05 01:06:08', '2022-02-05 01:06:08'),
(27, 'Sinar Terang', 'Sinar Terang merupakan usaha yang menjual barang elektronik khususnya lampu.', 'cipedes_-_sinar_terang.jpg', 'Jl. Mitra Batik No.113, Panglayungan, Kec. Cipedes, Kota Tasikmalaya', 5, 25, 5, '-7.320392188433821', '108.21520933091209', '2022-02-05 01:08:57', '2022-02-05 01:08:57'),
(28, 'Mie Baso Mas Roni', 'Mie Baso Mas Roni merupakan usaha yang menjual mie baso.', 'purbaratu_-_mie_baso_mas_roni.PNG', 'Kp. Lembur Warung, Purbaratu, Tasikmalaya', 3, 26, 9, '-7.329773969172206', '108.26416825999999', '2022-02-05 01:12:35', '2022-02-05 01:12:35'),
(29, 'Bubur Ayam Mang Iyan', 'Bubur Ayam Mang Iyan merupakan usaha yang menjual bubur ayam.', 'purbaratu_-_bubur_ayam_mang_iyan.jpg', 'Jl. Purbaratu, Singkup, Kec. Purbaratu, Kota Tasikmalaya', 3, 27, 9, '-7.335981240937641', '108.2700514231062', '2022-02-05 01:15:45', '2022-02-05 01:15:45'),
(30, 'Amda\'s Cosmetic', 'Amda\'s Cosmetic merupakan sebuah usaha memproduksi dan menjual segala macam alat kecantikan atau kosmetik.', 'cihideung_-_dewi_cosmetic.jpg', 'Jl. Sutisna Senjaya Kec. Tawang', 6, 28, 3, '-7.32832', '108.23127', '2022-02-05 03:37:13', '2022-02-05 03:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','umkm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umkm',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `nik`, `email`, `phone`, `address`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sistem', 'admin', '3273143110990001', 'admin@gmail.com', '081313448003', 'Sumedang', NULL, '$2y$10$ux1Y8gn6hf1v/ykl.ySFk.tdhqL5PjwwmCKekzTun2xI8kFAWL7GW', 'admin', NULL, '2021-12-25 02:43:51', '2022-01-31 07:12:42'),
(8, 'Maya', 'maya_kawalu', '3278010070006210', 'mayaumkmkawalu@gmail.com', '082316106198', 'Jalan Perintis Kemerdekaan, Kec. Kawalu, Kota. Tasikmalaya', NULL, '$2y$10$yt.qIlInpd3h9yYQDEq93uVQjfiLmkD/X9FmPmMikiWRuKQV9m7.K', 'umkm', NULL, '2022-02-04 15:01:34', '2022-02-05 01:22:29'),
(9, 'Hidayah', 'hidayah_kawalu', '3278010070017840', 'hidayahumkmkawalu@gmail.com', '08990605246', 'Jl. Perintis Kemerdekaan, Kel. Karsamenak, Kec. Kawalu, Kota Tasikmalaya', NULL, '$2y$10$VmFN/HnUv6Yo9THN21lfC.5COCYlWmoGk71Wz2IvK6/dEG1gdPujO', 'umkm', NULL, '2022-02-05 00:07:11', '2022-02-05 01:23:04'),
(10, 'Dewi', 'dewi_cihideung', '3278065411720007', 'dewiumkmcihideung@gmail.com', '085321900131', 'Jalan Pasar wetan ruko no 7, Argasari, Kec. Cihideung, Kota. Tasikmalaya', NULL, '$2y$10$So1gS543rSBd4bwyyTP5NenMUzyU3C.25zh0BgAtlIm0IjuFtRc4C', 'umkm', NULL, '2022-02-05 00:13:03', '2022-02-05 00:13:03'),
(11, 'Ina', 'ina_cihideung', '3278050050005500', 'inaumkmcihideung@gmail.com', '081261447976', 'Jl. Tentara Pelajar No.36, Nagarawangi, Kec. Cihideung, Kota Tasikmalaya', NULL, '$2y$10$2rGV95MqLrW8VM6t086xxOby0.6xQZGZ7ag6WO2v.N7JuLijZ64kS', 'umkm', NULL, '2022-02-05 00:17:56', '2022-02-05 00:17:56'),
(12, 'wawan', 'wawan_mangkubumi', '3278060060042200', 'wawanumkmmangkubumi@gmail.com', '085798101790', 'Linggajaya, Mangkubumi, Tasikmalaya', NULL, '$2y$10$lth0WfTosT0AKgiEt3lTHO2ObdmcpZ/kDoh6vz.Cb0nk0PXp3lffG', 'umkm', NULL, '2022-02-05 00:22:25', '2022-02-05 00:22:25'),
(13, 'Enceh', 'enceh_mangkubumi', '3278060070009280', 'encehumkmmangkubumi@gmail.com', '082321032220', 'Jl. Sambong Asem, RT.04/RW.01,Kec. Mangkubumi,Kota Tasikmalaya', NULL, '$2y$10$vbm7UaXzO0WIJwoIRH5CyefrcwyYn/hQW0UmZIQi7fdQWjM8Kjuu2', 'umkm', NULL, '2022-02-05 00:26:11', '2022-02-05 00:26:11'),
(14, 'Akbar', 'akbar_tawang', '3278040040004630', 'akbarumkmtawang@gmail.com', '085244505060', 'Jl. Tanuwijaya No.1A, Empangsari, Kec. Tawang, Kota Tasikmalaya', NULL, '$2y$10$EYYFjmAom/jYE9hS/DMtfePFJH.Vtnn68opGE.ynDCj8ul7TNuYpC', 'umkm', NULL, '2022-02-05 00:29:44', '2022-02-05 00:29:44'),
(15, 'Oneng', 'oneng_tawang', '3278040060016030', 'onengumkmtawang@gmail.com', '082119337151', 'Jl. BKR No.18, Kahuripan, Kec. Tawang, Kota Tasikmalaya', NULL, '$2y$10$4yB5eOtxg/iavEpZHpCCAeHwCfvjh3.bECpxyVQhbrcQoBf.VHa7a', 'umkm', NULL, '2022-02-05 00:33:46', '2022-02-05 00:33:46'),
(16, 'Ace', 'ace_tamansari', '3278020030005560', 'aceumkmtamansari@gmail.com', '082311175654', 'JL Taman Sari Gobras, No. 32, Kec. Tamansari, Kota Tasikmalaya', NULL, '$2y$10$nX2bB2327xdFHpqvufqsI.OMFYIl2JT/L6M3LW5typfy/h0/GWywm', 'umkm', NULL, '2022-02-05 00:36:48', '2022-02-05 00:36:48'),
(17, 'Diana', 'diana_tamansari', '3278020080001600', 'dianaumkmtamansari@gmail.com', '08112260889', 'Perum Asri Residence Tamansari No.10, Mulyasari, Kec. Tamansari, Kota Tasikmalaya', NULL, '$2y$10$NrCcXfZUrfOa2l.Gxo/AGOdC6.50059.GZPgRBqcp/EXfJ6cF6uFi', 'umkm', NULL, '2022-02-05 00:42:47', '2022-02-05 00:42:47'),
(18, 'Hikmah', 'hikmah_indihiang', '3278070040000790', 'hikmahumkmindihiang@gmail.com', '082218559220', 'Jl. Ibrahim Adjie No.224 A, Sirnagalih, Kec. Indihiang, Kota Tasikmalaya', NULL, '$2y$10$oXu7RJVHRGoTWHfwyrOb.e7DPqYT1pyl4UmxP9Ufyb4IhwbAI1Wl6', 'umkm', NULL, '2022-02-05 00:46:11', '2022-02-05 00:46:11'),
(19, 'Herdi', 'herdi_indihiang', '3278070070002560', 'herdiumkmindihiang@gmail.com', '082330000743', 'Indihiang, Kec. Indihiang, Kota Tasikmalaya', NULL, '$2y$10$E6bqjMSLFUHmbu8.icng8OF5MlHvCl9mq87iOIO3sBf1xovgR3jVu', 'umkm', NULL, '2022-02-05 00:49:35', '2022-02-05 00:49:35'),
(20, 'Rika', 'rika_cibeureum', '3278030070004080', 'rikaumkmcibeureum@gmail.com', '0895615235968', 'Jl. Kolonel Basyir Surya No.100, Setianagara, Kec. Cibeureum, Kota Tasikmalaya', NULL, '$2y$10$i6RdofhRUoU9nVnu1Tx7TOPwqfgx4n0zs.lCTPvuzmj/yS4UWQo3a', 'umkm', NULL, '2022-02-05 00:52:46', '2022-02-05 00:52:46'),
(21, 'Nani', 'nani_cibeureum', '3278030070007290', 'naniumkmcibeureum@gmail.com', '085223623616', 'Jl. KH. Khoer Affandi, Setianagara, Kec. Cibeureum, Kota Tasikmalaya', NULL, '$2y$10$Q1HJgkeFSF5GyBViahphceuV1sC81WGM9Eo4lz7GzmEz1VH5oV7su', 'umkm', NULL, '2022-02-05 00:56:10', '2022-02-05 00:56:10'),
(22, 'Ima Entin', 'ima_bungursari', '3278090080009460', 'imaumkmbungursari@gmail.com', '0895387240050', 'Jl. Jati Pamijahan, Sukarindik, Kec. Bungursari, Kab. Tasikmalaya', NULL, '$2y$10$hGWD6EGTxdvVhp8PYoIrbOtAEcLO3Bl8aPUnXiOwh1HrWlJpOv3oi', 'umkm', NULL, '2022-02-05 00:59:13', '2022-02-05 00:59:13'),
(23, 'Ovi', 'ovi_bungursari', '3278090070006130', 'oviumkmbungursari@gmail.com', '085223453016', 'Jl.setiarasa terusan, perum, Sukarindik, Kec. Bungursari, Kota Tasikmalaya', NULL, '$2y$10$mzWC/Q9QU65O1eUb9A0vxOawX1.j6bQz0E965aqpqCPH2rgWt6L7m', 'umkm', NULL, '2022-02-05 01:02:11', '2022-02-05 01:02:11'),
(24, 'Aan', 'aan_cipedes', '3278080040009790', 'aanumkmcipedes@gmail.com', '081323524622', 'Jl. Mitra Batik No.73, Kec. Cipedes, Kota Tasikmalaya', NULL, '$2y$10$syBJxU5UbP836hOKwLgpzOdbEAjBhDwm4c3iZkiTa797FoUCCdFTq', 'umkm', NULL, '2022-02-05 01:04:55', '2022-02-05 01:04:55'),
(25, 'ahmad', 'ahmad_cipedes', '3278080050008980', 'ahmadumkmcipedes@gmail.com', '082311888808', 'Jl. Mitra Batik No.113, Panglayungan, Kec. Cipedes, Kota Tasikmalaya', NULL, '$2y$10$yaeRukoeEbNVc4aJaBDYTuun3dRVt./OXlkLiqDuYqPIr1QLpLKAe', 'umkm', NULL, '2022-02-05 01:07:32', '2022-02-05 01:07:32'),
(26, 'Roni', 'roni_purbaratu', '3278100010003290', 'roniumkmpurbaratu@gmail.com', '081313662605', 'Kp. Lembur Warung, Purbaratu, Tasikmalaya', NULL, '$2y$10$A7mmS4HR/qnhp0wv7dPe.uKxDT8kNpOUtNQAIGjQo2du0xsaUvhAe', 'umkm', NULL, '2022-02-05 01:11:00', '2022-02-05 01:11:00'),
(27, 'Yayan', 'yayan_purbaratu', '3278100060004740', 'yayanumkmpurbaratu@gmail.com', '085220086158', 'Jl. Purbaratu, Singkup, Kec. Purbaratu, Kota Tasikmalaya', NULL, '$2y$10$W7mB9mc/bwhFkFHlAywoC.tWaoJTHV./P7a9PLB5OPlz9fOAJwI0e', 'umkm', NULL, '2022-02-05 01:14:15', '2022-02-05 01:14:15'),
(28, 'User', 'user', '1234567899876543', 'user@gmail.com', '085321416544', 'Jl. Sutisna Senjaya Kec. Tawanf', NULL, '$2y$10$yjs2b5qmyWy.asGhcnYpGOPd/tELv3yyuW.DbzjT/aXBSRoomyI/W', 'umkm', NULL, '2022-02-05 03:09:43', '2022-02-05 03:09:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_umkm`
--
ALTER TABLE `jenis_umkm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkm_jenis_umkm_id_foreign` (`jenis_umkm_id`),
  ADD KEY `umkm_user_id_foreign` (`user_id`),
  ADD KEY `umkm_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_umkm`
--
ALTER TABLE `jenis_umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `umkm_jenis_umkm_id_foreign` FOREIGN KEY (`jenis_umkm_id`) REFERENCES `jenis_umkm` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `umkm_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `umkm_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
