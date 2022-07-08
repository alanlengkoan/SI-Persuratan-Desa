-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 08, 2022 at 03:54 AM
-- Server version: 5.7.37
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_persuratan_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_agama`
--

CREATE TABLE `tb_agama` (
  `id_agama` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_agama`
--

INSERT INTO `tb_agama` (`id_agama`, `nama`, `ins`, `upd`) VALUES
(2, 'Kristen', '2022-03-06 14:53:34', '2022-03-06 14:53:34'),
(3, 'Katolik', '2022-03-06 14:53:43', '2022-03-06 14:53:43'),
(4, 'Hindu', '2022-03-06 14:53:49', '2022-03-06 14:53:55'),
(5, 'Buddha', '2022-03-06 14:54:04', '2022-03-06 14:54:04'),
(6, 'Konghucu', '2022-03-06 14:54:13', '2022-03-06 14:54:13'),
(7, 'ISLAM', '2022-03-12 09:14:16', '2022-03-12 09:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `nama_kk` varchar(50) DEFAULT NULL,
  `alamat` text,
  `rt_rw` varchar(10) DEFAULT NULL,
  `kd_pos` varchar(10) DEFAULT NULL,
  `desa_kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten_kota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id_keluarga`, `no_kk`, `nama_kk`, `alamat`, `rt_rw`, `kd_pos`, `desa_kelurahan`, `kecamatan`, `kabupaten_kota`, `provinsi`, `ins`, `upd`) VALUES
(1, '7302022809120005', 'abd latif ', 'bonto tangnga', '001/001', '92512', 'bonto suka', 'bontotiro', 'bulukumba', 'sulawesi selatan', '2022-06-05 12:31:51', '2022-06-05 12:31:51'),
(2, '7302022809120009', 'zulfikar', 'bonto tangnga', '001/001', '92514', 'bonto tangnga', 'bontotiro', 'bulukumba', 'sulawesi selatan', '2022-06-05 13:28:48', '2022-06-05 13:28:48'),
(3, '7302042705070044', 'Tanri', 'bonto suka', '001/002', '92572', 'Bonto Tangnga', 'BontoTiro', 'Bulukumba', 'Sulawesi Selatan', '2022-06-06 07:03:59', '2022-06-06 07:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluarga_anggota`
--

CREATE TABLE `tb_keluarga_anggota` (
  `id_keluarga_anggota` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_agama` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `kewarganegaraan` enum('wni','wna') DEFAULT NULL,
  `pendidikan` varchar(20) DEFAULT NULL,
  `status_nikah` enum('y','n') DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keluarga_anggota`
--

INSERT INTO `tb_keluarga_anggota` (`id_keluarga_anggota`, `id_users`, `id_agama`, `id_pekerjaan`, `no_kk`, `no_ktp`, `nama`, `kelamin`, `tmp_lahir`, `tgl_lahir`, `alamat`, `kewarganegaraan`, `pendidikan`, `status_nikah`, `ins`, `upd`) VALUES
(1, 45418239, 7, 12, '7302022809120005', '7302020406980002', 'jusnadi daeng matasa', 'L', 'bonto suka', '1998-12-15', 'jl.faisal 17', 'wni', 'S1', 'n', '2022-06-05 12:35:56', '2022-06-24 02:08:47'),
(3, NULL, 7, 4, '7302022809120005', '7302027112640105', 'nur dewa', 'P', 'bonto suka', '1998-07-06', 'sajgdshgvh', 'wni', 's1', 'y', '2022-06-05 13:26:12', '2022-06-13 14:05:05'),
(4, NULL, 7, 2, '7302022809120009', '7302020406980005', 'zulkifli', 'L', 'bontosuka', '1998-08-13', NULL, 'wni', 's1', 'n', '2022-06-05 13:30:04', '2022-06-05 13:30:04'),
(5, NULL, 7, 4, '7302042705070044', '7302044505880001', 'juharni', 'P', 'Bonto Tangnga', '1968-05-05', NULL, 'wni', 's1', 'y', '2022-06-06 07:11:19', '2022-06-06 07:11:19'),
(6, NULL, 7, 3, '7302042705070044', '7302047012920001', 'lisnawati.T', 'P', 'Bulukumba', '1992-12-30', NULL, 'wni', 's1', 'y', '2022-06-06 07:31:01', '2022-06-06 07:31:01'),
(7, NULL, 7, 2, '7302022809120005', '7302042506930002', 'jusriadi', 'L', 'Bulukumba', '1993-06-25', NULL, 'wni', 's1', 'n', '2022-06-06 07:33:00', '2022-06-06 07:33:00'),
(8, NULL, 7, 2, '7302022809120009', '7302041106970001', 'andri', 'L', 'bilamporoa', '1997-06-11', 'bontotiro', 'wni', 's1', 'n', '2022-06-14 10:23:42', '2022-06-14 10:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan`
--

CREATE TABLE `tb_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pekerjaan`
--

INSERT INTO `tb_pekerjaan` (`id_pekerjaan`, `nama`, `ins`, `upd`) VALUES
(2, 'TNI', '2022-03-05 08:48:35', '2022-06-16 21:56:19'),
(3, 'Petani', '2022-03-06 14:55:23', '2022-03-06 14:55:23'),
(4, 'Ibu Rumah Tangga', '2022-03-06 14:55:37', '2022-03-06 14:55:37'),
(6, 'akuntansi', '2022-03-06 14:56:14', '2022-06-16 22:00:47'),
(8, 'Nelayan', '2022-03-06 14:56:38', '2022-03-06 14:56:38'),
(9, 'POLISI', '2022-03-06 14:56:49', '2022-06-16 21:56:33'),
(10, 'Guru', '2022-03-06 14:56:59', '2022-06-16 22:10:03'),
(12, 'pelajar/mahasiswa', '2022-06-16 21:45:22', '2022-06-16 21:45:22'),
(13, 'Marketing', '2022-06-16 22:01:13', '2022-06-16 22:01:13'),
(14, 'Perajin', '2022-06-16 22:02:19', '2022-06-16 22:02:19'),
(15, 'Peternak', '2022-06-16 22:02:41', '2022-06-16 22:02:41'),
(16, 'Penjahit', '2022-06-16 22:03:08', '2022-06-16 22:03:08'),
(17, 'Karyawan atau Pegawai', '2022-06-16 22:03:59', '2022-06-16 22:03:59'),
(18, 'Dokter', '2022-06-16 22:04:22', '2022-06-16 22:04:22'),
(20, 'PNS (pegawai negeri sipil)', '2022-06-16 22:11:12', '2022-06-16 22:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `situs_web` text,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `logo`, `nama`, `alamat`, `email`, `telepon`, `fax`, `situs_web`, `facebook`, `instagram`, `twitter`, `youtube`, `ins`, `upd`) VALUES
(1, NULL, 'H. Andi Muh. Ali Rote S.Sos', 'Jln. Andi Tamar Jaya No. 2 Bontotangnga 92572', 'a@aa.com', 'a', 'a', 'a', '', '', '', '', '2022-03-03 04:11:57', '2022-03-06 14:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `isi` longtext,
  `gambar` varchar(100) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama`, `isi`, `gambar`, `ins`, `upd`) VALUES
(22907154, 'Peta', '<p>asdfasdf</p>\r\n', 'fe074fa89605547a4052849c40e80fbf.jpeg', '2022-03-10 14:36:28', '2022-06-14 05:36:02'),
(40265718, 'Struktur', '<p><strong>struktur desa bonto tangnga</strong></p>\r\n', 'd4282e55d8ea747b0465b4e522b17962.jpg', '2022-03-10 14:27:53', '2022-06-13 13:49:31'),
(66341529, 'Visi & Misi', '<blockquote>\r\n<h2><strong>VISI</strong></h2>\r\n\r\n<h2><strong>Terwujudnya Bonto Tangnga maju yang unggul, mandiri, dan bermartabat.</strong></h2>\r\n\r\n<h2><strong>MISI</strong></h2>\r\n\r\n<h2><strong>1. Menciptakan penyelenggaraan pemerintahan desa yang professional, transparan, mengayomi, bertanggung jawab dan mengutamakan pelayanan kepada masyarakat serta meningkatkan peran kelembagaan desa dalam pembangunan desa.</strong></h2>\r\n\r\n<h2><strong>2. Meningkatkan sumber daya manusia yang berkualitas melalui peningkatan kualitas pendidikan dan kesehatan dasar masyarakat.</strong></h2>\r\n\r\n<h2><strong>3. Meningkatkan pembangunan sarana dan prasarana desa yang mendukung kemajuan desa.</strong></h2>\r\n\r\n<h2><strong>4. Mewujudkan percepatan pertumbuhan ekonomi masyarakat yang berdaya saing dan berkelanjutan dengan mengembangkan Desa Wisata , usaha ekonomi kreatif, pertanian, Perikanan Kelautan.</strong></h2>\r\n\r\n<h2><strong>5. Mewujudkan  masyarakat yang berkepribadian dengan mematuhi aturan hukum, menerapkan nilai-nilai keagamaan, budaya luhur dan kearifan lokal, dalam rangka memantapkan landasan spiritual, dan etika pembangunan.</strong></h2>\r\n</blockquote>\r\n', '379c501acca0ea8933b0765775e49a52.png', '2022-06-14 06:10:09', '2022-06-17 03:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_asal`
--

CREATE TABLE `tb_surat_asal` (
  `id_surat_asal` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` text,
  `fax` varchar(10) DEFAULT NULL,
  `situs_web` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_asal`
--

INSERT INTO `tb_surat_asal` (`id_surat_asal`, `nama`, `email`, `telepon`, `alamat`, `fax`, `situs_web`, `ins`, `upd`) VALUES
(2, 'Sekolah', 'smanegeri01@gmail.com', '081340613330', 'jl.pendidikan', '-', 'https://dapo.kemdikbud.go.id/sekolah/', '2022-02-23 11:53:07', '2022-06-06 09:43:43'),
(5, 'penduduk', 'jdgjusndy@gmail.com', '081242397656', 'bonto tangnga', '-', 'https://sekolah.data.kemdikbud.go.id/', '2022-02-23 15:18:32', '2022-06-06 09:44:22'),
(6, 'kampus', '-@gmail.com', '-', '-', '-', '-', '2022-06-16 22:24:52', '2022-06-16 22:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_jenis`
--

CREATE TABLE `tb_surat_jenis` (
  `id_surat_jenis` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surat_jenis`
--

INSERT INTO `tb_surat_jenis` (`id_surat_jenis`, `nama`, `ins`, `upd`) VALUES
(7, 'Surat Keterangan domisili', '2022-03-05 10:32:43', '2022-06-06 08:54:12'),
(8, 'surat keterangan beda identitas', '2022-06-06 07:59:46', '2022-06-06 07:59:46'),
(9, 'surat keterangan kehilangan ', '2022-06-06 08:54:59', '2022-06-06 08:54:59'),
(10, 'surat keterangan kematian', '2022-06-06 08:55:14', '2022-06-06 08:55:14'),
(13, 'surat keterangan tidak mampu', '2022-06-06 08:56:18', '2022-06-06 08:56:18'),
(14, 'surat keterangan usaha', '2022-06-06 08:56:37', '2022-06-06 08:56:37'),
(15, 'surat pengantar pembuatan Kartu keluarga', '2022-06-06 08:57:11', '2022-06-06 08:57:33'),
(16, 'surat pengantar pembuatan KTP', '2022-06-06 08:58:01', '2022-06-06 08:58:01'),
(17, 'surat keterangan pindah', '2022-06-06 08:58:48', '2022-06-06 08:58:48'),
(19, 'Surat keterangan melahirkan', '2022-06-14 05:57:59', '2022-06-14 05:57:59'),
(20, 'Surat pengantar', '2022-06-14 05:58:34', '2022-06-14 05:58:34'),
(21, 'Surat keterangan belum menikah', '2022-06-14 05:58:52', '2022-06-14 05:58:52'),
(22, 'Surat keterangan nikah', '2022-06-14 05:59:42', '2022-06-14 05:59:42'),
(23, 'Surat keterangan pindah penduduk', '2022-06-14 06:00:09', '2022-06-14 06:00:09'),
(24, 'Surat keterangan kepemilikan/hak milik', '2022-06-14 06:00:32', '2022-06-14 06:00:32'),
(26, 'Surat keterangan ahli waris', '2022-06-14 06:01:18', '2022-06-14 06:01:18'),
(27, 'Surat keterangan ijin usaha', '2022-06-14 06:01:34', '2022-06-14 06:01:34'),
(28, 'Surat keterangan ijin tempat usaha', '2022-06-14 06:02:21', '2022-06-14 06:02:21'),
(29, 'Surat keterangan ijin keramaian', '2022-06-14 06:02:51', '2022-06-14 06:02:51'),
(30, 'Surat keterangan tidak mampu', '2022-06-14 06:03:09', '2022-06-14 06:03:09'),
(31, 'Surat rekomendasi penelitian ', '2022-06-14 06:03:27', '2022-06-14 06:03:27'),
(32, 'Surat pengantar pembuatan KTP', '2022-06-14 06:03:45', '2022-06-14 06:03:45'),
(34, 'surat pengantar SKCK', '2022-06-14 08:31:46', '2022-06-14 08:31:46'),
(35, 'Surat pengantar / keterangan lainnya', '2022-06-14 08:32:51', '2022-06-14 08:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_surat_tujuan` int(11) DEFAULT NULL,
  `id_surat_jenis` int(11) DEFAULT NULL,
  `no_surat` varchar(20) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `perihal` text,
  `approve` enum('0','1') DEFAULT NULL,
  `dok_lampiran` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `id_surat_asal` int(11) NOT NULL,
  `id_surat_sifat` int(11) NOT NULL,
  `id_surat_jenis` int(11) NOT NULL,
  `no_surat` varchar(20) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `perihal` text,
  `arsip` text,
  `arsip_tipe` enum('pdf','doc') DEFAULT NULL,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_sifat`
--

CREATE TABLE `tb_surat_sifat` (
  `id_surat_sifat` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_sifat`
--

INSERT INTO `tb_surat_sifat` (`id_surat_sifat`, `nama`, `keterangan`, `ins`, `upd`) VALUES
(3, 'pribadi', 'untuk kepentingan pribadi', '2022-02-23 12:08:24', '2022-06-10 04:14:27'),
(4, 'surat dinas pribadi', 'untuk instansi atau perusahaan', '2022-06-06 08:00:45', '2022-06-10 04:15:33'),
(5, 'surat dinas swasta', 'untuk karyawan, pelanggan, relasi, instansi dan perusahaan lainnya.', '2022-06-10 04:10:18', '2022-06-10 04:19:05'),
(6, 'surat niaga', 'surat penawaran , permintaan penawaran, pesanan barang.', '2022-06-10 04:11:03', '2022-06-10 04:21:00'),
(7, 'surat dinas pemerintah', 'untuk administrasi, contoh surat keputusan ', '2022-06-10 04:21:57', '2022-06-10 04:21:57'),
(10, ' Penting', 'surat dinas harus diselesaikan, dikirim, dan disampaikan menurut yang diterima oleh bagian pengiriman, sesuai dengan jadwal perjalanan caraka atau kurir, batas waktu 3 x 24 jam.', '2022-06-14 06:14:29', '2022-06-14 06:14:29'),
(11, 'Biasa', 'surat dinas harus diselesaikan, dikirim, dan disampaikan menurut yang diterima oleh bagian pengiriman sesuai dengan jadwal perjalanan caraka atau kurir dengan batas waktu 5 hari.', '2022-06-14 06:14:53', '2022-06-14 06:14:53'),
(12, 'pribadi', 'Surat pribadi adalah surat yang bersifat pribadi atau surat yang dibuat seseorang untuk kepentingan pribadi. ', '2022-06-14 09:30:40', '2022-06-14 09:30:40'),
(15, 'Surat pengantar', 'Surat pengantar adalah surat yang dikirim atau disertakan bersama-sama barang dan sebagainya.', '2022-06-14 09:34:03', '2022-06-14 09:34:03'),
(16, 'Surat sangat rahasia', 'Surat sangat rahasia hanya digunakan untuk surat atau dokumen yang erat hubungannya dengan keamanan negara. Surat sangat rahasia ditandai dengan SRHS atau SR.', '2022-06-14 09:35:11', '2022-06-14 09:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_tujuan`
--

CREATE TABLE `tb_surat_tujuan` (
  `id_surat_tujuan` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` text,
  `ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_tujuan`
--

INSERT INTO `tb_surat_tujuan` (`id_surat_tujuan`, `nama`, `email`, `telepon`, `alamat`, `ins`, `upd`) VALUES
(2, 'pernikahan', '-@gmail.com', '-', '-', '2022-03-01 14:56:26', '2022-06-06 09:45:20'),
(3, 'sekolah', '-@gmail.com', '-', '-', '2022-06-14 09:43:48', '2022-06-14 09:44:55'),
(4, 'instansi / perusahaan', '-@gmail.com', '-', '-', '2022-06-14 09:44:45', '2022-06-14 09:44:45'),
(5, 'kantor dinas', '-@gmail.com', '-', '-', '2022-06-14 09:45:22', '2022-06-14 09:45:22'),
(6, 'penelitian', '-@gmail.com', '-', '-', '2022-06-14 09:53:09', '2022-06-14 09:53:09'),
(7, 'kantor capil ( catatan sipil)', '-@gmail.com', '-', '-', '2022-06-14 09:54:48', '2022-06-14 09:54:48'),
(8, 'kantor urusan agama', '-@gmail.com', '-', '-', '2022-06-14 09:55:08', '2022-06-14 10:08:02'),
(9, 'dinas pendidikan', '-@gmail.com', '-', '-', '2022-06-14 09:55:50', '2022-06-14 09:55:50'),
(11, 'PUPR', '-@gmail.com', '-', '-', '2022-06-14 10:10:23', '2022-06-14 10:10:23'),
(12, 'kantor polisi', '-@gmail.com', '-', '-', '2022-06-14 10:11:49', '2022-06-14 10:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('admin','users') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `id_users`, `nama`, `email`, `telepon`, `foto`, `username`, `password`, `roles`, `ins`, `upd`) VALUES
(1, 1, 'BONTO TANGGA ', 'bontotangnga@gmail.com', '088088088', 'db7a8a1b3296b32f9a1c83b60656b374.png', 'admin', '$2y$10$UrvEbnhpVkCREvEz1WjUAu5EUEdbeTjFtQE0faPjufKxl68AtJmsi', 'admin', '2021-07-21 17:56:34', '2022-06-24 02:01:02'),
(4, 45418239, 'jusnadi daeng matasa', 'alan@gmail.com', '085242907596', NULL, 'alan', '$2y$10$psiTUsZqHJz.0ZiBESY0Yu.4EjeHa6jHQlJiE9brzzZM8Uct2TMYm', 'users', '2022-06-13 10:30:19', '2022-06-24 02:06:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD UNIQUE KEY `no_kk` (`no_kk`);

--
-- Indexes for table `tb_keluarga_anggota`
--
ALTER TABLE `tb_keluarga_anggota`
  ADD PRIMARY KEY (`id_keluarga_anggota`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`),
  ADD KEY `no_kk` (`no_kk`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`) USING BTREE;

--
-- Indexes for table `tb_surat_asal`
--
ALTER TABLE `tb_surat_asal`
  ADD PRIMARY KEY (`id_surat_asal`);

--
-- Indexes for table `tb_surat_jenis`
--
ALTER TABLE `tb_surat_jenis`
  ADD PRIMARY KEY (`id_surat_jenis`);

--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_surat_tujuan` (`id_surat_tujuan`,`id_surat_jenis`),
  ADD KEY `surat_jenis_to_surat_keluar` (`id_surat_jenis`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`),
  ADD KEY `id_surat_jenis` (`id_surat_jenis`),
  ADD KEY `surat_asal_to_surat_masuk` (`id_surat_asal`),
  ADD KEY `surat_sifat_to_surat_masuk` (`id_surat_sifat`);

--
-- Indexes for table `tb_surat_sifat`
--
ALTER TABLE `tb_surat_sifat`
  ADD PRIMARY KEY (`id_surat_sifat`);

--
-- Indexes for table `tb_surat_tujuan`
--
ALTER TABLE `tb_surat_tujuan`
  ADD PRIMARY KEY (`id_surat_tujuan`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649FA06E4D9` (`id_users`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `id_users` (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agama`
--
ALTER TABLE `tb_agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_keluarga_anggota`
--
ALTER TABLE `tb_keluarga_anggota`
  MODIFY `id_keluarga_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_surat_asal`
--
ALTER TABLE `tb_surat_asal`
  MODIFY `id_surat_asal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_surat_jenis`
--
ALTER TABLE `tb_surat_jenis`
  MODIFY `id_surat_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_surat_sifat`
--
ALTER TABLE `tb_surat_sifat`
  MODIFY `id_surat_sifat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_surat_tujuan`
--
ALTER TABLE `tb_surat_tujuan`
  MODIFY `id_surat_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_keluarga_anggota`
--
ALTER TABLE `tb_keluarga_anggota`
  ADD CONSTRAINT `agama_to_keluarga_anggota` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id_agama`),
  ADD CONSTRAINT `keluarga_to_keluarga_anggota` FOREIGN KEY (`no_kk`) REFERENCES `tb_keluarga` (`no_kk`),
  ADD CONSTRAINT `pekerjaan_to_keluarga_anggota` FOREIGN KEY (`id_pekerjaan`) REFERENCES `tb_pekerjaan` (`id_pekerjaan`),
  ADD CONSTRAINT `users_to_keluarga_anggota` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`);

--
-- Constraints for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD CONSTRAINT `surat_jenis_to_surat_keluar` FOREIGN KEY (`id_surat_jenis`) REFERENCES `tb_surat_jenis` (`id_surat_jenis`),
  ADD CONSTRAINT `surat_tujuan_to_surat_keluar` FOREIGN KEY (`id_surat_tujuan`) REFERENCES `tb_surat_tujuan` (`id_surat_tujuan`),
  ADD CONSTRAINT `users_to_surat_keluar` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`);

--
-- Constraints for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD CONSTRAINT `surat_asal_to_surat_masuk` FOREIGN KEY (`id_surat_asal`) REFERENCES `tb_surat_asal` (`id_surat_asal`),
  ADD CONSTRAINT `surat_jenis_to_surat_masuk` FOREIGN KEY (`id_surat_jenis`) REFERENCES `tb_surat_jenis` (`id_surat_jenis`),
  ADD CONSTRAINT `surat_sifat_to_surat_masuk` FOREIGN KEY (`id_surat_sifat`) REFERENCES `tb_surat_sifat` (`id_surat_sifat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
