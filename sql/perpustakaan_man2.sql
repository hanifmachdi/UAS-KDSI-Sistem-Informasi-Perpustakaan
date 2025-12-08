-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2025 pada 05.58
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_man2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tipe_anggota` enum('Siswa','Guru','Staf') NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '12345',
  `status_akun` enum('Aktif','Pending') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_lengkap`, `tipe_anggota`, `kelas`, `no_telepon`, `password`, `status_akun`) VALUES
(2, 'Adi Saputra', 'Siswa', 'X-1', '08123456001', '12345', 'Aktif'),
(3, 'Bayu Nugraha', 'Siswa', 'X-1', '08123456002', '12345', 'Aktif'),
(4, 'Candra Wijaya', 'Siswa', 'X-1', '08123456003', '12345', 'Aktif'),
(5, 'Dewi Sartika', 'Siswa', 'X-1', '08123456004', '12345', 'Aktif'),
(6, 'Eka Pratiwi', 'Siswa', 'X-1', '08123456005', '12345', 'Aktif'),
(7, 'Fajar Santoso', 'Siswa', 'X-1', '08123456006', '12345', 'Aktif'),
(8, 'Gita Gutawa', 'Siswa', 'X-1', '08123456007', '12345', 'Aktif'),
(9, 'Hadi Purnomo', 'Siswa', 'X-1', '08123456008', '12345', 'Aktif'),
(10, 'Indah Permata', 'Siswa', 'X-1', '08123456009', '12345', 'Aktif'),
(11, 'Joko Susilo', 'Siswa', 'X-1', '08123456010', '12345', 'Aktif'),
(12, 'Kartika Sari', 'Siswa', 'X-1', '08123456011', '12345', 'Aktif'),
(13, 'Lukman Hakim', 'Siswa', 'X-1', '08123456012', '12345', 'Aktif'),
(14, 'Maya Anggraini', 'Siswa', 'X-1', '08123456013', '12345', 'Aktif'),
(15, 'Nina Zatulini', 'Siswa', 'X-1', '08123456014', '12345', 'Aktif'),
(16, 'Oki Setiana', 'Siswa', 'X-1', '08123456015', '12345', 'Aktif'),
(17, 'Putra Bangsa', 'Siswa', 'X-1', '08123456016', '12345', 'Aktif'),
(18, 'Qori Sandioriva', 'Siswa', 'X-1', '08123456017', '12345', 'Aktif'),
(19, 'Rina Nose', 'Siswa', 'X-1', '08123456018', '12345', 'Aktif'),
(20, 'Sandi Sandoro', 'Siswa', 'X-1', '08123456019', '12345', 'Aktif'),
(21, 'Taufik Hidayat', 'Siswa', 'X-1', '08123456020', '12345', 'Aktif'),
(22, 'Umar Bakri', 'Siswa', 'X-1', '08123456021', '12345', 'Aktif'),
(23, 'Vina Panduwinata', 'Siswa', 'X-1', '08123456022', '12345', 'Aktif'),
(24, 'Wahyu Setiawan', 'Siswa', 'X-1', '08123456023', '12345', 'Aktif'),
(25, 'Xavier Hernandez', 'Siswa', 'X-1', '08123456024', '12345', 'Aktif'),
(26, 'Yuni Shara', 'Siswa', 'X-1', '08123456025', '12345', 'Aktif'),
(27, 'Zaskia Gotik', 'Siswa', 'X-1', '08123456026', '12345', 'Aktif'),
(28, 'Abdul Somad', 'Siswa', 'X-1', '08123456027', '12345', 'Aktif'),
(29, 'Bambang Pamungkas', 'Siswa', 'X-1', '08123456028', '12345', 'Aktif'),
(30, 'Citra Kirana', 'Siswa', 'X-1', '08123456029', '12345', 'Aktif'),
(31, 'Dimas Anggara', 'Siswa', 'X-1', '08123456030', '12345', 'Aktif'),
(32, 'Elly Sugigi', 'Siswa', 'X-2', '08123456031', '12345', 'Aktif'),
(33, 'Farah Quinn', 'Siswa', 'X-2', '08123456032', '12345', 'Aktif'),
(34, 'Gading Marten', 'Siswa', 'X-2', '08123456033', '12345', 'Aktif'),
(35, 'Hamish Daud', 'Siswa', 'X-2', '08123456034', '12345', 'Aktif'),
(36, 'Irfan Hakim', 'Siswa', 'X-2', '08123456035', '12345', 'Aktif'),
(37, 'Jessica Iskandar', 'Siswa', 'X-2', '08123456036', '12345', 'Aktif'),
(38, 'Kevin Julio', 'Siswa', 'X-2', '08123456037', '12345', 'Aktif'),
(39, 'Luna Maya', 'Siswa', 'X-2', '08123456038', '12345', 'Aktif'),
(40, 'Melly Goeslaw', 'Siswa', 'X-2', '08123456039', '12345', 'Aktif'),
(41, 'Naff Urban', 'Siswa', 'X-2', '08123456040', '12345', 'Aktif'),
(42, 'Olga Syahputra', 'Siswa', 'X-2', '08123456041', '12345', 'Aktif'),
(43, 'Prilly Latuconsina', 'Siswa', 'X-2', '08123456042', '12345', 'Aktif'),
(44, 'Qibil Changcuters', 'Siswa', 'X-2', '08123456043', '12345', 'Aktif'),
(45, 'Raffi Ahmad', 'Siswa', 'X-2', '08123456044', '12345', 'Aktif'),
(46, 'Sule Prikitiw', 'Siswa', 'X-2', '08123456045', '12345', 'Aktif'),
(47, 'Titi Kamal', 'Siswa', 'X-2', '08123456046', '12345', 'Aktif'),
(48, 'Uya Kuya', 'Siswa', 'X-2', '08123456047', '12345', 'Aktif'),
(49, 'Vicky Prasetyo', 'Siswa', 'X-2', '08123456048', '12345', 'Aktif'),
(50, 'Wendi Cagur', 'Siswa', 'X-2', '08123456049', '12345', 'Aktif'),
(51, 'Xena Warrior', 'Siswa', 'X-2', '08123456050', '12345', 'Aktif'),
(52, 'Yuki Kato', 'Siswa', 'X-2', '08123456051', '12345', 'Aktif'),
(53, 'Zayn Malik', 'Siswa', 'X-2', '08123456052', '12345', 'Aktif'),
(54, 'Andre Taulany', 'Siswa', 'X-2', '08123456053', '12345', 'Aktif'),
(55, 'Baim Wong', 'Siswa', 'X-2', '08123456054', '12345', 'Aktif'),
(56, 'Cinta Laura', 'Siswa', 'X-2', '08123456055', '12345', 'Aktif'),
(57, 'Deddy Corbuzier', 'Siswa', 'X-2', '08123456056', '12345', 'Aktif'),
(58, 'Eko Patrio', 'Siswa', 'X-2', '08123456057', '12345', 'Aktif'),
(59, 'Ferry Maryadi', 'Siswa', 'X-2', '08123456058', '12345', 'Aktif'),
(60, 'Gilang Dirga', 'Siswa', 'X-2', '08123456059', '12345', 'Aktif'),
(61, 'Hesti Purwadinata', 'Siswa', 'X-2', '08123456060', '12345', 'Aktif'),
(62, 'Indro Warkop', 'Siswa', 'XI-1', '08123456061', '12345', 'Aktif'),
(63, 'Jojon Pelawak', 'Siswa', 'XI-1', '08123456062', '12345', 'Aktif'),
(64, 'Komeng Spontan', 'Siswa', 'XI-1', '08123456063', '12345', 'Aktif'),
(65, 'Lulung Lunggana', 'Siswa', 'XI-1', '08123456064', '12345', 'Aktif'),
(66, 'Mandra Si Doel', 'Siswa', 'XI-1', '08123456065', '12345', 'Aktif'),
(67, 'Nunung Srimulat', 'Siswa', 'XI-1', '08123456066', '12345', 'Aktif'),
(68, 'Omaswati', 'Siswa', 'XI-1', '08123456067', '12345', 'Aktif'),
(69, 'Parto Patrio', 'Siswa', 'XI-1', '08123456068', '12345', 'Aktif'),
(70, 'Qomar Empat', 'Siswa', 'XI-1', '08123456069', '12345', 'Aktif'),
(71, 'Rina Gunawan', 'Siswa', 'XI-1', '08123456070', '12345', 'Aktif'),
(72, 'Soimah Pancawati', 'Siswa', 'XI-1', '08123456071', '12345', 'Aktif'),
(73, 'Tukul Arwana', 'Siswa', 'XI-1', '08123456072', '12345', 'Aktif'),
(74, 'Ucok Baba', 'Siswa', 'XI-1', '08123456073', '12345', 'Aktif'),
(75, 'Vincent Rompies', 'Siswa', 'XI-1', '08123456074', '12345', 'Aktif'),
(76, 'Warkop DKI', 'Siswa', 'XI-1', '08123456075', '12345', 'Aktif'),
(77, 'Xenia Daihatsu', 'Siswa', 'XI-1', '08123456076', '12345', 'Aktif'),
(78, 'Yadi Sembako', 'Siswa', 'XI-1', '08123456077', '12345', 'Aktif'),
(79, 'Zainuddin MZ', 'Siswa', 'XI-1', '08123456078', '12345', 'Aktif'),
(80, 'Agnez Mo', 'Siswa', 'XI-1', '08123456079', '12345', 'Aktif'),
(81, 'Bunga Citra', 'Siswa', 'XI-1', '08123456080', '12345', 'Aktif'),
(82, 'Chakra Khan', 'Siswa', 'XI-1', '08123456081', '12345', 'Aktif'),
(83, 'Dewa Budjana', 'Siswa', 'XI-1', '08123456082', '12345', 'Aktif'),
(84, 'Ebiet G Ade', 'Siswa', 'XI-1', '08123456083', '12345', 'Aktif'),
(85, 'Fatin Shidqia', 'Siswa', 'XI-1', '08123456084', '12345', 'Aktif'),
(86, 'Glenn Fredly', 'Siswa', 'XI-1', '08123456085', '12345', 'Aktif'),
(87, 'Haddad Alwi', 'Siswa', 'XI-1', '08123456086', '12345', 'Aktif'),
(88, 'Isyana Sarasvati', 'Siswa', 'XI-1', '08123456087', '12345', 'Aktif'),
(89, 'Judika Sihotang', 'Siswa', 'XI-1', '08123456088', '12345', 'Aktif'),
(90, 'Krisdayanti', 'Siswa', 'XI-1', '08123456089', '12345', 'Aktif'),
(91, 'Lyodra Ginting', 'Siswa', 'XI-1', '08123456090', '12345', 'Aktif'),
(92, 'Maher Zain', 'Siswa', 'XI-2', '08123456091', '12345', 'Aktif'),
(93, 'Nissa Sabyan', 'Siswa', 'XI-2', '08123456092', '12345', 'Aktif'),
(94, 'Opick Tomboati', 'Siswa', 'XI-2', '08123456093', '12345', 'Aktif'),
(95, 'Pasha Ungu', 'Siswa', 'XI-2', '08123456094', '12345', 'Aktif'),
(96, 'Qorygore Youtube', 'Siswa', 'XI-2', '08123456095', '12345', 'Aktif'),
(97, 'Rhoma Irama', 'Siswa', 'XI-2', '08123456096', '12345', 'Aktif'),
(98, 'Slank Band', 'Siswa', 'XI-2', '08123456097', '12345', 'Aktif'),
(99, 'Tulus Monokrom', 'Siswa', 'XI-2', '08123456098', '12345', 'Aktif'),
(100, 'Ungu Band', 'Siswa', 'XI-2', '08123456099', '12345', 'Aktif'),
(101, 'Vidi Aldiano', 'Siswa', 'XI-2', '08123456100', '12345', 'Aktif'),
(102, 'Wali Band', 'Siswa', 'XI-2', '08123456101', '12345', 'Aktif'),
(103, 'XoXo Exo', 'Siswa', 'XI-2', '08123456102', '12345', 'Aktif'),
(104, 'Yovie Widianto', 'Siswa', 'XI-2', '08123456103', '12345', 'Aktif'),
(105, 'Zaskia Sungkar', 'Siswa', 'XI-2', '08123456104', '12345', 'Aktif'),
(106, 'Afgan Syahreza', 'Siswa', 'XI-2', '08123456105', '12345', 'Aktif'),
(107, 'Bondan Prakoso', 'Siswa', 'XI-2', '08123456106', '12345', 'Aktif'),
(108, 'Charlie ST12', 'Siswa', 'XI-2', '08123456107', '12345', 'Aktif'),
(109, 'Duta Sheila', 'Siswa', 'XI-2', '08123456108', '12345', 'Aktif'),
(110, 'Eross Candra', 'Siswa', 'XI-2', '08123456109', '12345', 'Aktif'),
(111, 'Faank Wali', 'Siswa', 'XI-2', '08123456110', '12345', 'Aktif'),
(112, 'Giring Nidji', 'Siswa', 'XI-2', '08123456111', '12345', 'Aktif'),
(113, 'Hengky Kurniawan', 'Siswa', 'XI-2', '08123456112', '12345', 'Aktif'),
(114, 'Iwan Fals', 'Siswa', 'XI-2', '08123456113', '12345', 'Aktif'),
(115, 'Jamrud Band', 'Siswa', 'XI-2', '08123456114', '12345', 'Aktif'),
(116, 'Kangen Band', 'Siswa', 'XI-2', '08123456115', '12345', 'Aktif'),
(117, 'Letto Band', 'Siswa', 'XI-2', '08123456116', '12345', 'Aktif'),
(118, 'Momo Geisha', 'Siswa', 'XI-2', '08123456117', '12345', 'Aktif'),
(119, 'Nidji Band', 'Siswa', 'XI-2', '08123456118', '12345', 'Aktif'),
(120, 'Once Mekel', 'Siswa', 'XI-2', '08123456119', '12345', 'Aktif'),
(121, 'Peterpan Noah', 'Siswa', 'XI-2', '08123456120', '12345', 'Aktif'),
(122, 'Radja Band', 'Siswa', 'XII-1', '08123456121', '12345', 'Aktif'),
(123, 'Sheila On7', 'Siswa', 'XII-1', '08123456122', '12345', 'Aktif'),
(124, 'The Changcuters', 'Siswa', 'XII-1', '08123456123', '12345', 'Aktif'),
(125, 'Utopia Band', 'Siswa', 'XII-1', '08123456124', '12345', 'Aktif'),
(126, 'Vierra Band', 'Siswa', 'XII-1', '08123456125', '12345', 'Aktif'),
(127, 'Wiro Sableng', 'Siswa', 'XII-1', '08123456126', '12345', 'Aktif'),
(128, 'X-Men Logan', 'Siswa', 'XII-1', '08123456127', '12345', 'Aktif'),
(129, 'Yana Julio', 'Siswa', 'XII-1', '08123456128', '12345', 'Aktif'),
(130, 'Zigaz Band', 'Siswa', 'XII-1', '08123456129', '12345', 'Aktif'),
(131, 'Anang Hermansyah', 'Siswa', 'XII-1', '08123456130', '12345', 'Aktif'),
(132, 'Bebi Romeo', 'Siswa', 'XII-1', '08123456131', '12345', 'Aktif'),
(133, 'Cakra Khan', 'Siswa', 'XII-1', '08123456132', '12345', 'Aktif'),
(134, 'Dani Ahmad', 'Siswa', 'XII-1', '08123456133', '12345', 'Aktif'),
(135, 'Ello Tahitoe', 'Siswa', 'XII-1', '08123456134', '12345', 'Aktif'),
(136, 'Fadly Padi', 'Siswa', 'XII-1', '08123456135', '12345', 'Aktif'),
(137, 'Gita Wirjawan', 'Siswa', 'XII-1', '08123456136', '12345', 'Aktif'),
(138, 'Harry Tanoe', 'Siswa', 'XII-1', '08123456137', '12345', 'Aktif'),
(139, 'Ical Bakrie', 'Siswa', 'XII-1', '08123456138', '12345', 'Aktif'),
(140, 'Jokowi Dodo', 'Siswa', 'XII-1', '08123456139', '12345', 'Aktif'),
(141, 'Kaesang Pangarep', 'Siswa', 'XII-1', '08123456140', '12345', 'Aktif'),
(142, 'Luhut Panjaitan', 'Siswa', 'XII-1', '08123456141', '12345', 'Aktif'),
(143, 'Mahfud MD', 'Siswa', 'XII-1', '08123456142', '12345', 'Aktif'),
(144, 'Nadiem Makarim', 'Siswa', 'XII-1', '08123456143', '12345', 'Aktif'),
(145, 'Oesman Sapta', 'Siswa', 'XII-1', '08123456144', '12345', 'Aktif'),
(146, 'Prabowo Subianto', 'Siswa', 'XII-1', '08123456145', '12345', 'Aktif'),
(147, 'Quraish Shihab', 'Siswa', 'XII-1', '08123456146', '12345', 'Aktif'),
(148, 'Ridwan Kamil', 'Siswa', 'XII-1', '08123456147', '12345', 'Aktif'),
(149, 'Sandiaga Uno', 'Siswa', 'XII-1', '08123456148', '12345', 'Aktif'),
(150, 'Tri Rismaharini', 'Siswa', 'XII-1', '08123456149', '12345', 'Aktif'),
(151, 'Ustadz Maulana', 'Siswa', 'XII-1', '08123456150', '12345', 'Aktif'),
(152, 'Vicky Shu', 'Siswa', 'XII-2', '08123456151', '12345', 'Aktif'),
(153, 'Wiranto Menko', 'Siswa', 'XII-2', '08123456152', '12345', 'Aktif'),
(154, 'Xi Jinping', 'Siswa', 'XII-2', '08123456153', '12345', 'Aktif'),
(155, 'Yusuf Mansur', 'Siswa', 'XII-2', '08123456154', '12345', 'Aktif'),
(156, 'Zulkifli Hasan', 'Siswa', 'XII-2', '08123456155', '12345', 'Aktif'),
(157, 'Ahok Basuki', 'Siswa', 'XII-2', '08123456156', '12345', 'Aktif'),
(158, 'Bj Habibie', 'Siswa', 'XII-2', '08123456157', '12345', 'Aktif'),
(159, 'Chairul Tanjung', 'Siswa', 'XII-2', '08123456158', '12345', 'Aktif'),
(160, 'Dahlan Iskan', 'Siswa', 'XII-2', '08123456159', '12345', 'Aktif'),
(161, 'Erick Thohir', 'Siswa', 'XII-2', '08123456160', '12345', 'Aktif'),
(162, 'Fadli Zon', 'Siswa', 'XII-2', '08123456161', '12345', 'Aktif'),
(163, 'Ganjar Pranowo', 'Siswa', 'XII-2', '08123456162', '12345', 'Aktif'),
(164, 'Hatta Rajasa', 'Siswa', 'XII-2', '08123456163', '12345', 'Aktif'),
(165, 'Indra Bekti', 'Siswa', 'XII-2', '08123456164', '12345', 'Aktif'),
(166, 'Jeremy Thomas', 'Siswa', 'XII-2', '08123456165', '12345', 'Aktif'),
(167, 'Kiki Fatmala', 'Siswa', 'XII-2', '08123456166', '12345', 'Aktif'),
(168, 'Lydia Kandou', 'Siswa', 'XII-2', '08123456167', '12345', 'Aktif'),
(169, 'Meriam Bellina', 'Siswa', 'XII-2', '08123456168', '12345', 'Aktif'),
(170, 'Nafa Urbach', 'Siswa', 'XII-2', '08123456169', '12345', 'Aktif'),
(171, 'Onky Alexander', 'Siswa', 'XII-2', '08123456170', '12345', 'Aktif'),
(172, 'Paramitha Rusady', 'Siswa', 'XII-2', '08123456171', '12345', 'Aktif'),
(173, 'Qomaruddin', 'Siswa', 'XII-2', '08123456172', '12345', 'Aktif'),
(174, 'Roy Marten', 'Siswa', 'XII-2', '08123456173', '12345', 'Aktif'),
(175, 'Sophan Sophiaan', 'Siswa', 'XII-2', '08123456174', '12345', 'Aktif'),
(176, 'Tamara Bleszynski', 'Siswa', 'XII-2', '08123456175', '12345', 'Aktif'),
(177, 'Uci Bing Slamet', 'Siswa', 'XII-2', '08123456176', '12345', 'Aktif'),
(178, 'Venna Melinda', 'Siswa', 'XII-2', '08123456177', '12345', 'Aktif'),
(179, 'Widyawati', 'Siswa', 'XII-2', '08123456178', '12345', 'Aktif'),
(180, 'Xaverius Surya', 'Siswa', 'XII-2', '08123456179', '12345', 'Aktif'),
(181, 'Yati Octavia', 'Siswa', 'XII-2', '08123456180', '12345', 'Aktif'),
(182, 'Drs. Ahmad Dahlan', 'Guru', NULL, '08130000001', '12345', 'Aktif'),
(183, 'Ir. Soekarno', 'Guru', NULL, '08130000002', '12345', 'Aktif'),
(184, 'Dra. RA Kartini', 'Guru', NULL, '08130000003', '12345', 'Aktif'),
(185, 'Mohammad Hatta', 'Guru', NULL, '08130000004', '12345', 'Aktif'),
(186, 'Ki Hajar Dewantara', 'Guru', NULL, '08130000005', '12345', 'Aktif'),
(187, 'Cut Nyak Dien', 'Guru', NULL, '08130000006', '12345', 'Aktif'),
(188, 'Pangeran Diponegoro', 'Guru', NULL, '08130000007', '12345', 'Aktif'),
(189, 'Imam Bonjol', 'Guru', NULL, '08130000008', '12345', 'Aktif'),
(190, 'Jenderal Sudirman', 'Guru', NULL, '08130000009', '12345', 'Aktif'),
(191, 'Bung Tomo', 'Guru', NULL, '08130000010', '12345', 'Aktif'),
(192, 'Dewi Sartika', 'Guru', NULL, '08130000011', '12345', 'Aktif'),
(193, 'H. Agus Salim', 'Guru', NULL, '08130000012', '12345', 'Aktif'),
(194, 'Teuku Umar', 'Guru', NULL, '08130000013', '12345', 'Aktif'),
(195, 'Pattimura', 'Guru', NULL, '08130000014', '12345', 'Aktif'),
(196, 'Sisingamangaraja', 'Guru', NULL, '08130000015', '12345', 'Aktif'),
(197, 'Mang Ujang (OB)', 'Staf', NULL, '08140000001', '12345', 'Aktif'),
(198, 'Pak Satpam 1', 'Staf', NULL, '08140000002', '12345', 'Aktif'),
(199, 'Bu Kantin', 'Staf', NULL, '08140000003', '12345', 'Aktif'),
(200, 'Mas IT Support', 'Staf', NULL, '08140000004', '12345', 'Aktif'),
(201, 'Mba Tata Usaha', 'Staf', NULL, '08140000005', '12345', 'Aktif'),
(202, 'hanif', 'Guru', '', '098766554321', '12345', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `jumlah_total` int(11) NOT NULL,
  `jumlah_tersedia` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penulis`, `penerbit`, `jumlah_total`, `jumlah_tersedia`, `id_kategori`, `id_rak`) VALUES
(2, 'Fiqih Islam Wa Adillatuhu', 'Prof. Dr. Wahbah Az-Zuhaili', 'Gema Insani', 5, 5, 1, 1),
(3, 'Sejarah Kebudayaan Islam X', 'Kemenag RI', 'Kemenag', 30, 28, 2, 2),
(4, 'Matematika Wajib Kelas XI', 'Sukino', 'Erlangga', 40, 35, 2, 2),
(5, 'Biologi Campbell Jilid 1', 'Neil A. Campbell', 'Erlangga', 5, 5, 3, 4),
(6, 'Pemrograman Web dengan PHP', 'Budi Raharjo', 'Informatika', 3, 2, 3, 4),
(7, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 10, 7, 6, 5),
(8, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Lentera Dipantara', 8, 0, 6, 5),
(9, 'Kamus Besar Bahasa Indonesia', 'Tim Penyusun', 'Balai Pustaka', 5, 5, 7, 3),
(10, 'Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Gramedia', 6, 4, 6, 5),
(11, 'Fisika Dasar Jilid 1', 'Halliday & Resnick', 'Erlangga', 10, 9, 3, 4),
(12, 'Sosiologi Suatu Pengantar', 'Soerjono Soekanto', 'Rajawali Pers', 7, 7, 4, 2),
(13, 'Negeri 5 Menara', 'A. Fuadi', 'Gramedia', 12, 10, 6, 5),
(14, 'Bahasa Arab untuk Madrasah Aliyah', 'Tim Guru', 'Toha Putra', 50, 47, 5, 3),
(15, 'Atlas Sejarah Indonesia', 'Slamet Muljana', 'Pustaka Jaya', 4, 4, 4, 6),
(16, 'Algoritma dan Struktur Data', 'Rinaldi Munir', 'Informatika', 5, 4, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Agama Islam'),
(2, 'Buku Pelajaran (Wajib)'),
(3, 'Sains & Teknologi'),
(4, 'Sejarah & Sosial'),
(5, 'Bahasa & Sastra'),
(6, 'Fiksi / Novel'),
(7, 'Ensiklopedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_wajib_kembali` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status` enum('Booking','Dipinjam','Selesai','Batal') DEFAULT 'Booking',
  `denda` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_buku`, `id_petugas`, `tanggal_pinjam`, `tanggal_wajib_kembali`, `tanggal_pengembalian`, `status`, `denda`) VALUES
(7, 114, 9, 3, '2025-11-25', '2025-12-02', '2025-11-26', 'Selesai', '0.00'),
(8, 84, 7, 1, '2025-11-25', '2025-12-02', NULL, 'Dipinjam', '0.00'),
(11, 99, 7, 1, '2025-11-26', '2025-12-03', '2025-11-26', 'Selesai', '0.00'),
(12, 2, 14, 1, '2025-12-08', '2025-12-15', '2025-12-08', 'Selesai', '0.00'),
(13, 2, 16, 1, '2025-12-08', '2025-12-15', NULL, 'Dipinjam', '0.00'),
(14, 202, 16, 1, '2025-12-08', '2025-12-15', '2025-12-08', 'Selesai', '0.00'),
(15, 202, 14, 1, '2025-12-08', '2025-12-15', NULL, 'Dipinjam', '0.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_akses` enum('Admin','Staf') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `level_akses`) VALUES
(1, 'Administrator', 'admin', '12345', 'Admin'),
(2, 'Siti Pustakawan', 'siti', '12345', 'Staf'),
(3, 'Budi Penjaga', 'budi', '12345', 'Staf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi`) VALUES
(1, 'RAK-A1', 'Lantai 1 - Area Agama'),
(2, 'RAK-A2', 'Lantai 1 - Area Pelajaran'),
(3, 'RAK-B1', 'Lantai 1 - Area Bahasa'),
(4, 'RAK-C1', 'Lantai 2 - Area Sains'),
(5, 'RAK-C2', 'Lantai 2 - Area Fiksi'),
(6, 'RAK-D1', 'Lantai 2 - Gudang Referensi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
