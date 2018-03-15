-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26 Jan 2018 pada 16.11
-- Versi Server: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crm_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `company_cod` varchar(25) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `kode_cabang` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `company_cod`, `company_name`, `address`, `kode_cabang`, `created_at`, `update_at`) VALUES
(1, 'ID0010001', 'PT. BANK AGRIS', 'PT. BANK AGRIS Gedung Wisma GKBI Suite UG-01 Jl. Jendral Sudirman No 28 Jakarta 10210 - Indonesia', 'BNK', '2017-07-20 01:24:49', '0000-00-00 00:00:00'),
(2, 'ID0010100', 'KCU JAKARTA', 'Wisma GKBI Suite UG - 01 Jln. Jend. Sudirman No. 28 Jakarta 10210 Indonesia', 'A00', '2016-09-09 09:09:40', '0000-00-00 00:00:00'),
(3, 'ID0010101', 'KCP MUARA KARANG JKT', 'Jl Muara Karang Raya No. 109 Blok B 7 U Pluit Karang Raya, Pluit Jakarta 14450 021 66693984', 'A01', '2016-09-09 09:09:49', '0000-00-00 00:00:00'),
(4, 'ID0010102', 'KCP KELAPA GADING', 'Jl. Boulevard Barat Blok LC 8 No. 6 Kelapa Gading Barat Jakarta 14240 021 4525686', 'A02', '2016-09-09 09:10:00', '0000-00-00 00:00:00'),
(5, 'ID0010104', 'KK GADING SERPONG', 'Ruko Alexantride Jln Boulevard Gading Serpong Blok A Tangerang 15325 021 54220577', 'A04', '2016-09-09 09:10:10', '0000-00-00 00:00:00'),
(6, 'ID0010105', 'KK W INDOCEMENT JKT', 'Wisma Indocement Lt. 12 Jl. Jend. Sudirman Kav. 70 71 Jakarta 12910 021 5223968', 'A05', '2016-09-09 09:10:20', '0000-00-00 00:00:00'),
(7, 'ID0010106', 'KK MANGGA DUA JKT', 'Mangga Dua Lt.2 Blok KA No. 004 Gedung Pusat Grosir Pasar Pagi Jakarta Utara 14430 021 62306659', 'A06', '2016-09-09 09:10:45', '0000-00-00 00:00:00'),
(8, 'ID0010107', 'KK P KEMERDEKAAN BGR', 'Ruko Pusat Grosir Bogor (Ruko PGB) Jl. Perintis Kemerdekaan No. C / 23 Bogor 16112 021 . 5588965', 'A07', '2016-09-09 09:11:04', '0000-00-00 00:00:00'),
(9, 'ID0010200', 'KC IKAN TONGKOL LMPG', 'Jl Ikan Tongkol 01 03 Kel.Pesawahan Kec Teluk Betung Selatan Bandar Lampung 35223 0721 471300', 'B01', '2016-09-09 09:11:14', '0000-00-00 00:00:00'),
(10, 'ID0010202', 'KK KARTINI LMPG', 'Jl R A Kartini No 68 C Tanjung Karang Bandar Lampung 0721 . 5600088', 'B02', '2016-09-09 09:11:22', '0000-00-00 00:00:00'),
(11, 'ID0010203', 'KK JEN SUDIRMAN LMPG', 'Jl. Jend. Sudirman No. 68 F Rawa Laut, Tanjung Bandar Lampung 0721 . 260800', 'B03', '2016-09-09 09:11:33', '0000-00-00 00:00:00'),
(12, 'ID0010220', 'KC KOL ATMO PALEMBANG', 'Jl Kolonel Atmo No. 583 C-D Palembang - 30125 0711-318998', 'B20', '2016-09-09 09:11:46', '0000-00-00 00:00:00'),
(13, 'ID0010250', 'KC PALANG MERAH MEDAN', 'Jl. Palang Merah No. 112 AAA Medan 20112 061 . 7334445', 'B50', '2016-09-09 09:11:54', '0000-00-00 00:00:00'),
(14, 'ID0010251', 'KCP ASIA MEDAN', 'Jl. Asia No. 93 Medan 20214 Sumatera Utara 061 7334445', 'B07', '2016-09-09 09:12:04', '0000-00-00 00:00:00'),
(15, 'ID0010280', 'KC PEKANBARU', 'Jln. Riau no. 38 G Tampan Payung Sekaki Pekanbaru Riau 28292', 'B80', '2016-09-09 09:12:13', '0000-00-00 00:00:00'),
(16, 'ID0010300', 'KC RADEN SALEH SBY', 'RADEN SALEH 8 B 60174 RADEN SALEH 8 B 60174 Surabaya 031-5358988', 'C01', '2016-09-09 09:12:21', '0000-00-00 00:00:00'),
(17, 'ID0010350', 'KC MT HARYONO SEMARANG', 'Ruko Mataram Plaza Blok A/9 Jl. M.T Haryono Semarang 50136 024 . 3563327', 'C50', '2016-09-09 09:12:28', '0000-00-00 00:00:00'),
(18, 'ID0010360', 'KC VETERAN SOLO', 'Jl. Veteran No.140,142-143 Kel. Kraton, Kec. Serengan Surakarta, Jawa Tengah 57155 0271 - 630202', 'C60', '2016-09-09 09:12:39', '0000-00-00 00:00:00'),
(19, 'ID0010400', 'KC LENGKONG BANDUNG', 'Jl Lengkong Kecil No. 12A Bandung Jawa Barat', 'D00', '2016-09-09 09:12:47', '0000-00-00 00:00:00'),
(20, 'ID0010600', 'KC JUANDA PONTIANAK', 'Jl Ir. H. Juanda No.50-51 Pontianak Kalimantan Barat', 'F00', '2016-09-09 09:12:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `flag_asuransi`
--

CREATE TABLE `flag_asuransi` (
  `id_flag` int(11) NOT NULL,
  `flag_asuransi` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `flag_asuransi`
--

INSERT INTO `flag_asuransi` (`id_flag`, `flag_asuransi`, `create_at`, `update_at`) VALUES
(1, 'Ada Asuransi', '2017-07-14 09:27:44', '0000-00-00 00:00:00'),
(2, 'Tidak Ada Asuransi', '2017-07-14 09:27:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputasuransi`
--

CREATE TABLE `histinputasuransi` (
  `no` int(11) NOT NULL,
  `id_asuransi` int(11) NOT NULL,
  `jenis_asuransi` int(11) NOT NULL,
  `asuransi_lain` text NOT NULL,
  `objek_asuransi` int(11) NOT NULL,
  `objek_lain` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `nilai_pertanggungan` double NOT NULL,
  `nama_asuransi` varchar(150) NOT NULL,
  `polis` varchar(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputasuransifasilitas`
--

CREATE TABLE `histinputasuransifasilitas` (
  `no` int(11) NOT NULL,
  `id_asuransi` int(11) NOT NULL,
  `jenis_asuransi` int(11) NOT NULL,
  `asuransi_lain` text NOT NULL,
  `objek_asuransi` int(11) NOT NULL,
  `objek_lain` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `nilai_pertanggungan` double NOT NULL,
  `nama_asuransi` varchar(150) NOT NULL,
  `polis` varchar(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputcarapenarikan`
--

CREATE TABLE `histinputcarapenarikan` (
  `no` int(11) NOT NULL,
  `id_carapenarikan` int(11) NOT NULL,
  `penarikan` text NOT NULL,
  `nik` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputcovenant`
--

CREATE TABLE `histinputcovenant` (
  `no` int(11) NOT NULL,
  `id_inputconvenant` int(11) NOT NULL,
  `id_syarat` int(11) NOT NULL,
  `syarat_lainnya` varchar(250) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status_progress` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histinputcovenant`
--

INSERT INTO `histinputcovenant` (`no`, `id_inputconvenant`, `id_syarat`, `syarat_lainnya`, `tgl_mulai`, `tgl_target`, `tgl_pemenuhan`, `status_progress`, `nik`, `create_at`, `update_at`) VALUES
(1, 4, 0, '', '0000-00-00', '0000-00-00', '2018-01-25', 1, '17111023', '2018-01-25 04:42:10', '0000-00-00 00:00:00'),
(2, 1, 0, '', '0000-00-00', '0000-00-00', '2018-01-25', 1, '17111023', '2018-01-25 04:45:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputcovernote`
--

CREATE TABLE `histinputcovernote` (
  `no` int(11) NOT NULL,
  `id_inputcovernote` int(11) NOT NULL,
  `tgl_pengikatancovernote` date NOT NULL,
  `jenis_pengikatancovernote` int(11) NOT NULL,
  `nama_notaris` varchar(150) NOT NULL,
  `no_covernote` int(11) NOT NULL,
  `tgl_covernote` date NOT NULL,
  `nik` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputcrm`
--

CREATE TABLE `histinputcrm` (
  `no` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `nama_debitur` varchar(150) NOT NULL,
  `nik_marketing` varchar(25) NOT NULL,
  `tgl_terimacrm` date NOT NULL,
  `cif` int(100) NOT NULL,
  `ppk` varchar(100) NOT NULL,
  `crm` varchar(100) NOT NULL,
  `nik_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histinputcrm`
--

INSERT INTO `histinputcrm` (`no`, `id_crm`, `nama_debitur`, `nik_marketing`, `tgl_terimacrm`, `cif`, `ppk`, `crm`, `nik_user`, `status`, `keterangan`, `create_at`, `update_at`) VALUES
(1, 1, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-23 03:55:52', '0000-00-00 00:00:00'),
(2, 3, 'SARINDO, CV', '16070873', '2017-11-10', 30015842, '031/SMG-PPK/XI/17 ', '459/SMG-CRM/XI/2017 ', 17091008, 0, '', '2018-01-23 07:51:09', '0000-00-00 00:00:00'),
(3, 3, '', '', '0000-00-00', 0, '', '', 17091008, 5, '', '2018-01-23 08:49:11', '0000-00-00 00:00:00'),
(4, 4, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-23 09:46:04', '0000-00-00 00:00:00'),
(5, 5, 'HENDRI JAPAR', '006', '2017-09-19', 30015416, '013/PLG-PPK/VIII/2017', '404/PLG-CRM/IX/2017', 14030570, 0, '', '2018-01-24 03:26:07', '0000-00-00 00:00:00'),
(6, 5, '', '', '0000-00-00', 0, '', '', 14030570, 5, '', '2018-01-24 03:44:09', '0000-00-00 00:00:00'),
(7, 6, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-24 09:41:39', '0000-00-00 00:00:00'),
(8, 6, '', '', '0000-00-00', 0, '', '', 17111023, 7, '', '2018-01-25 04:38:24', '0000-00-00 00:00:00'),
(9, 5, '', '', '0000-00-00', 0, '', '', 17111023, 7, '', '2018-01-25 04:43:10', '0000-00-00 00:00:00'),
(10, 1, '', '', '0000-00-00', 0, '', '', 17111023, 4, 'Mohon untuk pengisian Document TBO & Deviasi dibedakan.\r\nDocument deviasi --> bukan merupakan kelengkapan dokumen yg wajib\r\nDocument TBO --> dokumen wajib namun dapat disusulkan', '2018-01-25 04:55:05', '0000-00-00 00:00:00'),
(11, 7, '', '', '0000-00-00', 0, '', '', 17070973, 5, '', '2018-01-25 06:02:59', '0000-00-00 00:00:00'),
(12, 8, '', '', '0000-00-00', 0, '', '', 17070973, 5, '', '2018-01-25 06:29:48', '0000-00-00 00:00:00'),
(13, 1, '', '', '0000-00-00', 0, '', '', 17111023, 3, 'Mohon untuk pengisian Document TBO & Deviasi dibedakan.\r\nDocument deviasi --> bukan merupakan kelengkapan dokumen yg wajib\r\nDocument TBO --> dokumen wajib namun dapat disusulkan', '2018-01-26 03:15:48', '0000-00-00 00:00:00'),
(14, 1, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-26 03:22:32', '0000-00-00 00:00:00'),
(15, 17, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-26 04:35:03', '0000-00-00 00:00:00'),
(16, 18, '', '', '0000-00-00', 0, '', '', 16120922, 5, '', '2018-01-26 04:55:43', '0000-00-00 00:00:00'),
(17, 2, '', '', '0000-00-00', 0, '', '', 16070881, 5, '', '2018-01-26 05:47:27', '0000-00-00 00:00:00'),
(18, 19, '', '', '0000-00-00', 0, '', '', 16050842, 5, '', '2018-01-26 08:17:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputdeviasi`
--

CREATE TABLE `histinputdeviasi` (
  `no` int(11) NOT NULL,
  `id_inpudeviasi` int(11) NOT NULL,
  `id_deviasi` int(11) NOT NULL,
  `deviasi_lain` varchar(250) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status_progress` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histinputdeviasi`
--

INSERT INTO `histinputdeviasi` (`no`, `id_inpudeviasi`, `id_deviasi`, `deviasi_lain`, `tgl_mulai`, `tgl_target`, `tgl_pemenuhan`, `status_progress`, `keterangan`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 1, '', '2018-01-23', '2018-04-23', '0000-00-00', 0, 'SURAT KETERANGAN PENGURUSAN IMB NO. 423/01/2018', '16050842', '2018-01-26 03:19:47', '0000-00-00 00:00:00'),
(2, 1, 4, '', '2018-01-23', '2018-04-23', '0000-00-00', 0, 'SURAT KETERANGAN PENGURUSAN SERTIFIKAT ', '16050842', '2018-01-26 03:22:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputdoc`
--

CREATE TABLE `histinputdoc` (
  `no` int(11) NOT NULL,
  `id_inputdoc` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `doc_lain` varchar(250) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histinputdoc`
--

INSERT INTO `histinputdoc` (`no`, `id_inputdoc`, `id_doc`, `doc_lain`, `tgl_pengurusan`, `tgl_target`, `tgl_pemenuhan`, `status`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 4, '', '2018-01-23', '2018-04-23', '0000-00-00', 0, '16050842', '2018-01-26 03:19:08', '0000-00-00 00:00:00'),
(2, 1, 5, '', '2018-01-23', '2018-04-23', '0000-00-00', 0, '16050842', '2018-01-26 03:20:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputfasilitas`
--

CREATE TABLE `histinputfasilitas` (
  `no` int(11) NOT NULL,
  `id_inputfasilitas` int(11) NOT NULL,
  `id_agunan` int(11) NOT NULL,
  `jenis_fasilitas` int(11) NOT NULL,
  `fascode` varchar(25) NOT NULL,
  `plafond` double NOT NULL,
  `id_tipkredit` int(11) NOT NULL,
  `tipkreditlain` varchar(150) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputjaminan`
--

CREATE TABLE `histinputjaminan` (
  `no` int(11) NOT NULL,
  `id_agunan` int(11) NOT NULL,
  `jaminan` int(11) NOT NULL,
  `jaminan_lain` varchar(150) NOT NULL,
  `duedate_hgb` date NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_certificate` varchar(100) NOT NULL,
  `nama_pemilik` varchar(250) NOT NULL,
  `pengikatan` int(11) NOT NULL,
  `pengikatan_lain` varchar(150) NOT NULL,
  `nilai_penjaminan` double NOT NULL,
  `no_akta` varchar(150) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_penyelesaian` date NOT NULL,
  `tgl_khasanah` date NOT NULL,
  `status` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histinputjaminan`
--

INSERT INTO `histinputjaminan` (`no`, `id_agunan`, `jaminan`, `jaminan_lain`, `duedate_hgb`, `alamat`, `no_certificate`, `nama_pemilik`, `pengikatan`, `pengikatan_lain`, `nilai_penjaminan`, `no_akta`, `tgl_pengurusan`, `tgl_target`, `tgl_penyelesaian`, `tgl_khasanah`, `status`, `nik`, `create_at`, `update_at`) VALUES
(1, 3, 2, '', '2018-11-21', 'Dukuh Sukolilo, Sidomukti, PAti', '1210/Sidomukti', 'SUHARDI', 1, '', 1165000000, '', '2017-11-21', '2018-02-21', '0000-00-00', '0000-00-00', 0, '17091008', '2018-01-23 08:06:08', '0000-00-00 00:00:00'),
(2, 12, 2, '', '1111-11-11', 'Jl Melati kel padang bulan Kec senapelan kota pekanbaru', 'SHM 758', 'mulianto', 1, '', 2412000000, '2943/2015', '2018-01-24', '2018-04-25', '0000-00-00', '0000-00-00', 0, '16050842', '2018-01-24 09:34:48', '0000-00-00 00:00:00'),
(3, 15, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 01:26:59', '0000-00-00 00:00:00'),
(4, 15, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 01:32:25', '0000-00-00 00:00:00'),
(5, 15, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-24', '0000-00-00', 1, '17111023', '2018-01-25 03:51:37', '0000-00-00 00:00:00'),
(6, 14, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 3, '17111023', '2018-01-25 03:52:34', '0000-00-00 00:00:00'),
(7, 14, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:52:51', '0000-00-00 00:00:00'),
(8, 13, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 3, '17111023', '2018-01-25 03:54:07', '0000-00-00 00:00:00'),
(9, 13, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:54:52', '0000-00-00 00:00:00'),
(10, 12, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:56:04', '0000-00-00 00:00:00'),
(11, 11, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:56:18', '0000-00-00 00:00:00'),
(12, 10, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:56:41', '0000-00-00 00:00:00'),
(13, 9, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 03:57:02', '0000-00-00 00:00:00'),
(14, 8, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 04:06:31', '0000-00-00 00:00:00'),
(15, 7, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 04:08:16', '0000-00-00 00:00:00'),
(16, 6, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 04:08:41', '0000-00-00 00:00:00'),
(17, 5, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 04:40:42', '0000-00-00 00:00:00'),
(18, 1, 0, '', '0000-00-00', '', '', '', 0, '', 0, '', '0000-00-00', '0000-00-00', '2018-01-25', '0000-00-00', 1, '17111023', '2018-01-25 04:44:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histinputsignpk`
--

CREATE TABLE `histinputsignpk` (
  `no` int(11) NOT NULL,
  `id_inputsign` int(11) NOT NULL,
  `no_pk` varchar(150) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `tgl_khasanah` date NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_login`
--

CREATE TABLE `log_login` (
  `no_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_login`
--

INSERT INTO `log_login` (`no_login`, `id_user`, `status`, `last_login`, `last_logout`) VALUES
(5, 17111023, 1, '2018-01-22 06:30:57', '0000-00-00 00:00:00'),
(6, 17111023, 1, '2018-01-22 06:35:02', '0000-00-00 00:00:00'),
(7, 17111023, 1, '2018-01-22 06:36:42', '0000-00-00 00:00:00'),
(8, 17111023, 1, '2018-01-22 06:48:39', '0000-00-00 00:00:00'),
(9, 17111023, 1, '2018-01-22 06:54:37', '0000-00-00 00:00:00'),
(10, 17091008, 1, '2018-01-22 07:25:37', '0000-00-00 00:00:00'),
(11, 17111023, 1, '2018-01-22 07:46:40', '0000-00-00 00:00:00'),
(12, 17111023, 1, '2018-01-22 07:48:03', '0000-00-00 00:00:00'),
(13, 15090766, 1, '2018-01-22 08:14:57', '0000-00-00 00:00:00'),
(14, 17030948, 1, '2018-01-22 08:27:46', '0000-00-00 00:00:00'),
(15, 14030572, 1, '2018-01-22 08:53:12', '0000-00-00 00:00:00'),
(16, 17111023, 1, '2018-01-22 09:12:46', '0000-00-00 00:00:00'),
(17, 15090766, 1, '2018-01-22 09:33:42', '0000-00-00 00:00:00'),
(18, 13040399, 1, '2018-01-22 09:51:38', '0000-00-00 00:00:00'),
(19, 13040399, 1, '2018-01-22 09:56:14', '0000-00-00 00:00:00'),
(20, 17111023, 1, '2018-01-23 01:07:23', '0000-00-00 00:00:00'),
(21, 15090766, 1, '2018-01-23 01:08:07', '0000-00-00 00:00:00'),
(22, 15090766, 1, '2018-01-23 01:42:02', '0000-00-00 00:00:00'),
(23, 17111023, 1, '2018-01-23 01:58:48', '0000-00-00 00:00:00'),
(24, 15090766, 1, '2018-01-23 02:08:59', '0000-00-00 00:00:00'),
(25, 17111023, 1, '2018-01-23 02:42:46', '0000-00-00 00:00:00'),
(26, 16050842, 1, '2018-01-23 03:10:51', '0000-00-00 00:00:00'),
(27, 17111023, 1, '2018-01-23 03:17:51', '0000-00-00 00:00:00'),
(28, 15090766, 1, '2018-01-23 03:43:15', '0000-00-00 00:00:00'),
(29, 16050842, 1, '2018-01-23 03:43:38', '0000-00-00 00:00:00'),
(30, 16050842, 1, '2018-01-23 03:45:40', '0000-00-00 00:00:00'),
(31, 16050842, 1, '2018-01-23 03:49:49', '0000-00-00 00:00:00'),
(32, 17111023, 1, '2018-01-23 03:49:59', '0000-00-00 00:00:00'),
(33, 15090766, 1, '2018-01-23 03:59:49', '0000-00-00 00:00:00'),
(34, 17111023, 1, '2018-01-23 04:00:04', '0000-00-00 00:00:00'),
(35, 16070881, 1, '2018-01-23 05:53:45', '0000-00-00 00:00:00'),
(36, 17091008, 1, '2018-01-23 07:43:42', '0000-00-00 00:00:00'),
(37, 16050842, 1, '2018-01-23 09:22:28', '0000-00-00 00:00:00'),
(38, 14030570, 1, '2018-01-24 02:22:31', '0000-00-00 00:00:00'),
(39, 14030570, 1, '2018-01-24 02:24:46', '0000-00-00 00:00:00'),
(40, 15090766, 1, '2018-01-24 02:44:06', '0000-00-00 00:00:00'),
(41, 16050842, 1, '2018-01-24 02:44:38', '0000-00-00 00:00:00'),
(42, 17111023, 1, '2018-01-24 02:44:46', '0000-00-00 00:00:00'),
(43, 14030570, 1, '2018-01-24 03:12:23', '0000-00-00 00:00:00'),
(44, 16050842, 1, '2018-01-24 04:02:09', '0000-00-00 00:00:00'),
(45, 14030570, 1, '2018-01-24 04:21:26', '0000-00-00 00:00:00'),
(46, 16050842, 1, '2018-01-24 08:17:20', '0000-00-00 00:00:00'),
(47, 14030570, 1, '2018-01-24 08:22:59', '0000-00-00 00:00:00'),
(48, 14030570, 1, '2018-01-24 09:23:38', '0000-00-00 00:00:00'),
(49, 17111023, 1, '2018-01-25 01:25:22', '0000-00-00 00:00:00'),
(50, 17111023, 1, '2018-01-25 03:50:54', '0000-00-00 00:00:00'),
(51, 14030570, 1, '2018-01-25 04:02:30', '0000-00-00 00:00:00'),
(52, 17111023, 1, '2018-01-25 04:35:04', '0000-00-00 00:00:00'),
(53, 17070973, 1, '2018-01-25 04:53:12', '0000-00-00 00:00:00'),
(54, 17070973, 1, '2018-01-25 06:02:36', '0000-00-00 00:00:00'),
(55, 17070973, 1, '2018-01-25 07:14:51', '0000-00-00 00:00:00'),
(56, 14030570, 1, '2018-01-25 07:44:47', '0000-00-00 00:00:00'),
(57, 14030572, 1, '2018-01-25 07:50:20', '0000-00-00 00:00:00'),
(58, 13040399, 1, '2018-01-25 08:51:29', '0000-00-00 00:00:00'),
(59, 17070973, 1, '2018-01-25 09:09:04', '0000-00-00 00:00:00'),
(60, 13040399, 1, '2018-01-25 09:27:26', '0000-00-00 00:00:00'),
(61, 13040399, 1, '2018-01-25 09:27:45', '0000-00-00 00:00:00'),
(62, 15090766, 1, '2018-01-25 10:46:07', '0000-00-00 00:00:00'),
(63, 17111023, 1, '2018-01-25 10:46:22', '0000-00-00 00:00:00'),
(64, 17111023, 1, '2018-01-25 11:57:15', '0000-00-00 00:00:00'),
(65, 17111023, 1, '2018-01-25 11:57:53', '0000-00-00 00:00:00'),
(66, 14030570, 1, '2018-01-25 11:58:29', '0000-00-00 00:00:00'),
(67, 17111023, 1, '2018-01-25 12:03:03', '0000-00-00 00:00:00'),
(68, 15090766, 1, '2018-01-25 12:07:21', '0000-00-00 00:00:00'),
(69, 16050842, 1, '2018-01-25 12:07:47', '0000-00-00 00:00:00'),
(70, 16050842, 1, '2018-01-25 12:08:02', '0000-00-00 00:00:00'),
(71, 15090766, 1, '2018-01-25 12:08:08', '0000-00-00 00:00:00'),
(72, 17111023, 1, '2018-01-25 12:08:14', '0000-00-00 00:00:00'),
(73, 13040399, 1, '2018-01-26 01:47:04', '0000-00-00 00:00:00'),
(74, 17111023, 1, '2018-01-26 02:36:00', '0000-00-00 00:00:00'),
(75, 16050842, 1, '2018-01-26 02:59:24', '0000-00-00 00:00:00'),
(76, 17111023, 1, '2018-01-26 03:14:06', '0000-00-00 00:00:00'),
(77, 16050842, 1, '2018-01-26 03:14:16', '0000-00-00 00:00:00'),
(78, 15090766, 1, '2018-01-26 03:15:32', '0000-00-00 00:00:00'),
(79, 17111023, 1, '2018-01-26 03:15:38', '0000-00-00 00:00:00'),
(80, 16050842, 1, '2018-01-26 03:15:58', '0000-00-00 00:00:00'),
(81, 16050842, 1, '2018-01-26 03:18:26', '0000-00-00 00:00:00'),
(82, 16050842, 1, '2018-01-26 03:18:45', '0000-00-00 00:00:00'),
(83, 16050842, 1, '2018-01-26 03:20:33', '0000-00-00 00:00:00'),
(84, 17111023, 1, '2018-01-26 03:23:53', '0000-00-00 00:00:00'),
(85, 16050842, 1, '2018-01-26 03:23:59', '0000-00-00 00:00:00'),
(86, 17111023, 1, '2018-01-26 03:33:30', '0000-00-00 00:00:00'),
(87, 17111023, 1, '2018-01-26 03:34:18', '0000-00-00 00:00:00'),
(88, 16120922, 1, '2018-01-26 03:43:07', '0000-00-00 00:00:00'),
(89, 16120922, 1, '2018-01-26 04:42:02', '0000-00-00 00:00:00'),
(90, 16070881, 1, '2018-01-26 05:29:53', '0000-00-00 00:00:00'),
(91, 16070881, 1, '2018-01-26 05:42:16', '0000-00-00 00:00:00'),
(92, 17070973, 1, '2018-01-26 06:20:57', '0000-00-00 00:00:00'),
(93, 17111023, 1, '2018-01-26 06:30:15', '0000-00-00 00:00:00'),
(94, 17070973, 1, '2018-01-26 06:35:13', '0000-00-00 00:00:00'),
(95, 16050842, 1, '2018-01-26 06:50:09', '0000-00-00 00:00:00'),
(96, 16050842, 1, '2018-01-26 07:54:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_carapenarikan`
--

CREATE TABLE `master_carapenarikan` (
  `id_carapenarikan` int(11) NOT NULL,
  `cara_penarikan` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_carapenarikan`
--

INSERT INTO `master_carapenarikan` (`id_carapenarikan`, `cara_penarikan`, `create_at`, `update_at`) VALUES
(1, 'Tata Cara Penarikan PRK', '2017-07-14 04:22:24', '0000-00-00 00:00:00'),
(2, 'Tata Cara Penarikan DL', '2017-07-14 04:22:24', '0000-00-00 00:00:00'),
(3, 'Tata Cara Penarikan DLN', '2017-07-14 04:23:18', '0000-00-00 00:00:00'),
(4, 'Tata Cara Penarikan DLD', '2017-07-14 04:23:18', '0000-00-00 00:00:00'),
(5, 'Tata Cara Penarikan IL', '2017-07-31 09:14:57', '0000-00-00 00:00:00'),
(6, 'Tata Cara Penarikan KI', '2017-07-31 09:14:57', '0000-00-00 00:00:00'),
(7, 'Tata Cara Penarikan KI-MAS', '2017-07-31 09:37:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_deviasi`
--

CREATE TABLE `master_deviasi` (
  `id_masterdeviasi` int(11) NOT NULL,
  `deviasi` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_deviasi`
--

INSERT INTO `master_deviasi` (`id_masterdeviasi`, `deviasi`, `create_at`, `update_at`) VALUES
(1, 'Ijin Mendirikan Bangunan (IMB)', '2017-07-14 07:33:17', '0000-00-00 00:00:00'),
(2, 'Ijin Usaha', '2017-07-14 07:33:17', '0000-00-00 00:00:00'),
(3, 'Asuransi Non Rekanan', '2017-07-14 07:33:39', '0000-00-00 00:00:00'),
(4, 'Notaris Non Rekanan', '2017-07-14 07:33:39', '0000-00-00 00:00:00'),
(5, 'Laporan Keuangan Audited', '2017-07-14 07:33:58', '0000-00-00 00:00:00'),
(6, 'Lainnya', '2017-07-14 07:33:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_document`
--

CREATE TABLE `master_document` (
  `id_masterdoc` int(11) NOT NULL,
  `document` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_document`
--

INSERT INTO `master_document` (`id_masterdoc`, `document`, `create_at`, `update_at`) VALUES
(1, 'Laporan Eksternal Appraisal', '2017-07-14 07:29:43', '0000-00-00 00:00:00'),
(2, 'Laporan Keuangan Inhouse', '2017-07-14 07:29:43', '0000-00-00 00:00:00'),
(3, 'Laporan Keuangan Audited', '2017-07-14 07:30:16', '0000-00-00 00:00:00'),
(4, 'Ijin Mendirikan Bangunan (IMB)', '2017-07-14 07:30:16', '0000-00-00 00:00:00'),
(5, 'Ijin Usaha', '2017-07-14 07:30:56', '0000-00-00 00:00:00'),
(6, 'Legalitas (NPWP, SK Domisili, SIUP, TDP, HO, Dll)', '2017-07-14 07:30:56', '0000-00-00 00:00:00'),
(7, 'Asli List Inventory ', '2017-11-16 06:00:12', '0000-00-00 00:00:00'),
(8, 'Kelengkapan Anggaran Dasar (AD terbaru, SK MenKUMHAM, Pendaftaran PN)', '2017-11-16 05:39:13', '0000-00-00 00:00:00'),
(9, 'Asli Surat Persetujuan Komisaris', '2017-11-16 05:39:13', '0000-00-00 00:00:00'),
(10, 'Asli Invoice/PO/SPK ', '2017-11-16 05:41:10', '0000-00-00 00:00:00'),
(11, 'Surat Keterangan Lunas', '2017-11-16 05:41:10', '0000-00-00 00:00:00'),
(12, 'Surat Roya', '2017-11-16 05:42:26', '0000-00-00 00:00:00'),
(13, 'Cover Note Dealer/Cover Note Notaris/Cover Note Developer', '2017-11-16 05:42:26', '0000-00-00 00:00:00'),
(14, 'BPKB', '2017-11-16 05:43:31', '0000-00-00 00:00:00'),
(15, 'Asli Invoice mesin/alat berat ', '2017-11-16 05:43:31', '0000-00-00 00:00:00'),
(16, 'Laporan Appraisal Internal untuk kendaraan/mesin/alat berat', '2017-11-16 05:44:02', '0000-00-00 00:00:00'),
(17, 'Surat Pernyataan Menyewakan / Akta Pengosongan', '2017-11-16 05:44:02', '0000-00-00 00:00:00'),
(18, 'Surat Pernyataan', '2017-11-16 05:44:23', '0000-00-00 00:00:00'),
(19, 'Asli Surat Persetujuan Istri/Suami ', '2017-11-16 05:44:23', '0000-00-00 00:00:00'),
(20, 'Asli List Piutang', '2017-11-16 05:44:46', '0000-00-00 00:00:00'),
(21, 'Lainnya', '2017-11-16 06:00:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_fasilitas`
--

CREATE TABLE `master_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `fasilitas` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_fasilitas`
--

INSERT INTO `master_fasilitas` (`id_fasilitas`, `fasilitas`, `create_at`, `update_at`) VALUES
(1, 'Pinjaman Rekening Koran (PRK)', '2017-07-14 03:58:27', '0000-00-00 00:00:00'),
(2, 'Demand Load (DL)', '2017-07-14 03:58:27', '0000-00-00 00:00:00'),
(3, 'Demand Loan Nonrevolving (DLN)', '2017-07-14 03:59:36', '0000-00-00 00:00:00'),
(4, 'Demand Loan Diskonta (DLD)', '2017-07-14 03:59:36', '0000-00-00 00:00:00'),
(5, 'Bank Garansi (BG)', '2017-11-01 04:13:45', '0000-00-00 00:00:00'),
(6, 'Installment Loan (IL)', '2017-07-14 04:00:49', '0000-00-00 00:00:00'),
(7, 'kredit Investasi (KI)', '2017-07-14 04:01:45', '0000-00-00 00:00:00'),
(8, 'Kredit Investasi - Grace Period (KI-GP)', '2017-07-14 04:01:45', '0000-00-00 00:00:00'),
(9, 'Kredit Investasi - Mikro Agris Solusi (KI-MAS)', '2017-07-14 04:02:29', '0000-00-00 00:00:00'),
(10, 'Kredit Multiguna (KMG)', '2017-07-14 04:02:29', '0000-00-00 00:00:00'),
(11, 'Kredit Pemilikan Rumah (KPR)', '2017-07-14 04:03:01', '0000-00-00 00:00:00'),
(12, 'Kredit Kendaraan Bermotor (KKB)', '2017-07-14 04:03:01', '0000-00-00 00:00:00'),
(13, 'Kredit Investasi Line (KI Line)', '2017-11-01 04:13:25', '0000-00-00 00:00:00'),
(14, 'Bank Garansi Line (BG Line)', '2017-11-01 04:13:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenisagunan`
--

CREATE TABLE `master_jenisagunan` (
  `id_jenisagunan` int(11) NOT NULL,
  `jenis_agunan` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_jenisagunan`
--

INSERT INTO `master_jenisagunan` (`id_jenisagunan`, `jenis_agunan`, `create_at`, `update_at`) VALUES
(1, 'Tanah Kosong', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(2, 'Tanah dan Bangunan', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(3, 'Bangunan/Pabrik', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(4, 'Resi Gudang', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(5, 'Kendaraan', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(6, 'Alat Berat', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(7, 'Mesin', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(8, 'Kandang Ayam', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(9, 'Peralatan', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(10, 'Inventory', '2017-07-14 07:38:49', '0000-00-00 00:00:00'),
(11, 'Piutang', '2017-07-14 07:39:19', '0000-00-00 00:00:00'),
(12, 'Personal Guarantee (PG)', '2017-07-14 07:39:19', '0000-00-00 00:00:00'),
(13, 'Corporate Guarantee (CG)', '2017-07-14 07:39:47', '0000-00-00 00:00:00'),
(14, 'Deposito', '2017-07-14 07:39:47', '0000-00-00 00:00:00'),
(15, 'Blokir Rekening', '2017-07-14 07:40:02', '0000-00-00 00:00:00'),
(16, 'Saham', '2017-07-14 07:40:02', '0000-00-00 00:00:00'),
(17, 'Margin Deposit', '2017-07-14 07:40:30', '0000-00-00 00:00:00'),
(18, 'Logam Mulia/Emas', '2017-07-14 07:40:30', '0000-00-00 00:00:00'),
(19, 'Lainnya', '2017-07-14 07:40:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenisasuransi`
--

CREATE TABLE `master_jenisasuransi` (
  `id_jenisasuransi` int(11) NOT NULL,
  `jenis_asuransi` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_jenisasuransi`
--

INSERT INTO `master_jenisasuransi` (`id_jenisasuransi`, `jenis_asuransi`, `create_at`, `update_at`) VALUES
(1, 'Kerugian/Kebakaran', '2017-07-14 09:34:58', '0000-00-00 00:00:00'),
(2, 'Jiwa Kredit', '2017-07-14 09:34:58', '0000-00-00 00:00:00'),
(3, 'Lainnya', '2017-07-14 09:36:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jenispengikatanagunan`
--

CREATE TABLE `master_jenispengikatanagunan` (
  `id_jenispengikatanagunan` int(11) NOT NULL,
  `jenis_pengikatanagunan` varchar(150) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_jenispengikatanagunan`
--

INSERT INTO `master_jenispengikatanagunan` (`id_jenispengikatanagunan`, `jenis_pengikatanagunan`, `create_at`, `update_at`) VALUES
(1, 'Hak Tanggungan (HT)', '2017-07-14 07:50:29', '0000-00-00 00:00:00'),
(2, 'Fidusia', '2017-07-14 07:50:29', '0000-00-00 00:00:00'),
(3, 'Gadai', '2017-07-14 07:50:47', '0000-00-00 00:00:00'),
(4, 'Blokir Rekening', '2017-07-14 07:50:47', '0000-00-00 00:00:00'),
(5, 'PG', '2017-07-14 07:50:59', '0000-00-00 00:00:00'),
(6, 'CG', '2017-07-14 07:50:59', '0000-00-00 00:00:00'),
(7, 'Lainnya', '2017-07-14 07:51:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_marketing`
--

CREATE TABLE `master_marketing` (
  `id_marketing` int(11) NOT NULL,
  `nik_marketing` varchar(11) NOT NULL,
  `nama_marketing` varchar(150) NOT NULL,
  `code_ho` varchar(5) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `aktif` varchar(11) NOT NULL,
  `nik_user` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_marketing`
--

INSERT INTO `master_marketing` (`id_marketing`, `nik_marketing`, `nama_marketing`, `code_ho`, `id_cabang`, `aktif`, `nik_user`, `create_at`, `update_at`) VALUES
(1, '030', 'Natalia', '030', 2, 'Y', 17111023, '2018-01-22 08:06:02', '0000-00-00 00:00:00'),
(2, '001', 'Thing Na', '001', 9, 'Y', 17111023, '2018-01-22 08:07:11', '0000-00-00 00:00:00'),
(3, '002', 'Rony Wibowo', '002', 18, 'Y', 17111023, '2018-01-22 08:07:40', '0000-00-00 00:00:00'),
(4, '003', 'DIKA KUSUMA JAYA', '003', 16, 'Y', 17111023, '2018-01-22 08:08:08', '0000-00-00 00:00:00'),
(5, '004', 'AILING', '004', 13, 'Y', 17111023, '2018-01-22 08:09:02', '0000-00-00 00:00:00'),
(6, '005', 'Sri Mulyani Dwi Astuti', '005', 17, 'Y', 17111023, '2018-01-22 08:09:58', '0000-00-00 00:00:00'),
(7, '006', 'AGUSTINA', '006', 12, 'Y', 17111023, '2018-01-22 08:10:44', '0000-00-00 00:00:00'),
(8, '007', 'V HUSEIN RAMALIE', '007', 19, 'Y', 17111023, '2018-01-22 08:12:22', '0000-00-00 00:00:00'),
(9, '008', 'Riantanto', '008', 20, 'Y', 17111023, '2018-01-22 08:12:55', '0000-00-00 00:00:00'),
(10, '009', 'KARDI SUHARDI', '009', 15, 'Y', 17111023, '2018-01-22 08:14:23', '0000-00-00 00:00:00'),
(11, '13110512', 'Husen Ramalie', '114', 19, 'Y', 17111023, '2018-01-23 02:51:25', '0000-00-00 00:00:00'),
(12, '17070977', 'Hendri Senjaya', '367', 19, 'Y', 17111023, '2018-01-23 02:52:06', '0000-00-00 00:00:00'),
(13, '15120790', 'Hevi Kurniawan', '216', 19, 'Y', 17111023, '2018-01-23 02:52:27', '0000-00-00 00:00:00'),
(14, '16040830', 'Ferry Nurdiyana', '217', 19, 'Y', 17111023, '2018-01-23 02:52:45', '0000-00-00 00:00:00'),
(15, '17121036', 'Eka Mulyana', '379', 19, 'Y', 17111023, '2018-01-23 02:53:06', '0000-00-00 00:00:00'),
(16, '17101022', 'Ika Rikana Sudjadi', '375', 19, 'Y', 17111023, '2018-01-23 02:53:25', '0000-00-00 00:00:00'),
(17, '17121032', 'Sri Lestari Purwanegara', '377', 19, 'Y', 17111023, '2018-01-23 02:53:46', '0000-00-00 00:00:00'),
(18, '14070613', 'KARDI SUHARDI', '155', 15, 'Y', 17111023, '2018-01-23 03:01:16', '0000-00-00 00:00:00'),
(19, '17080984', 'Timotius Sapta Budi Wibowo', '355', 18, 'Y', 17111023, '2018-01-23 03:02:06', '0000-00-00 00:00:00'),
(20, '17040949', 'CH Eko Yuliati', '369', 18, 'Y', 17111023, '2018-01-23 03:02:50', '0000-00-00 00:00:00'),
(21, '15060748', 'Yazid Al Makzhumi', '202', 18, 'Y', 17111023, '2018-01-23 03:03:15', '0000-00-00 00:00:00'),
(22, '15060747', 'Rony Wibowo', '199', 18, 'Y', 17111023, '2018-01-23 03:03:30', '0000-00-00 00:00:00'),
(23, '13010385', 'CING WIE', '028', 9, 'Y', 17111023, '2018-01-23 03:17:42', '0000-00-00 00:00:00'),
(24, '16060857', 'ERWIN', '340', 9, 'Y', 17111023, '2018-01-23 03:18:23', '0000-00-00 00:00:00'),
(25, '13080468', 'ROSE MARIE', '070', 9, 'Y', 17111023, '2018-01-23 03:18:49', '0000-00-00 00:00:00'),
(26, '15010700', 'Riantanto', '166', 20, 'Y', 17111023, '2018-01-23 03:21:18', '0000-00-00 00:00:00'),
(27, '15110787', 'Novelia', '205', 20, 'Y', 17111023, '2018-01-23 03:21:39', '0000-00-00 00:00:00'),
(28, '14070608', 'Agus Kristanto Setiono', '121', 17, 'Y', 17111023, '2018-01-23 03:22:10', '0000-00-00 00:00:00'),
(29, '16070873', 'Lindawati Hendrawan', '331', 17, 'Y', 17111023, '2018-01-23 03:22:25', '0000-00-00 00:00:00'),
(30, '11070296', 'Sri Mulyani Dwi Astuti', '167', 17, 'Y', 17111023, '2018-01-23 03:22:41', '0000-00-00 00:00:00'),
(31, '13030392', 'Winarjo', '106', 13, 'Y', 17111023, '2018-01-23 03:23:21', '0000-00-00 00:00:00'),
(32, '13010380', 'Ai Ling', '021', 13, 'Y', 17111023, '2018-01-23 03:23:46', '0000-00-00 00:00:00'),
(33, '16080882', 'Billy', '339', 13, 'Y', 17111023, '2018-01-23 03:24:02', '0000-00-00 00:00:00'),
(34, '17101016', 'Eka Tandiono', '373', 13, 'Y', 17111023, '2018-01-23 03:24:34', '0000-00-00 00:00:00'),
(35, '14100672', 'Anastasya', '177', 13, 'Y', 17111023, '2018-01-23 03:26:07', '0000-00-00 00:00:00'),
(36, '17080983', 'Agustina', '368', 12, 'Y', 17111023, '2018-01-24 02:45:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_objekasuransi`
--

CREATE TABLE `master_objekasuransi` (
  `id_objekasuransi` int(11) NOT NULL,
  `objek_asuransi` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_objekasuransi`
--

INSERT INTO `master_objekasuransi` (`id_objekasuransi`, `objek_asuransi`, `create_at`, `update_at`) VALUES
(1, 'Rumah', '2017-07-14 09:38:30', '0000-00-00 00:00:00'),
(2, 'Apartment', '2017-07-14 09:38:30', '0000-00-00 00:00:00'),
(3, 'Gedung/Pabrik', '2017-07-14 09:38:46', '0000-00-00 00:00:00'),
(4, 'Ruko', '2017-07-14 09:38:46', '0000-00-00 00:00:00'),
(5, 'Inventory', '2017-07-14 09:39:03', '0000-00-00 00:00:00'),
(6, 'Lainnya', '2017-07-14 09:39:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pengikatan`
--

CREATE TABLE `master_pengikatan` (
  `id_pengikatan` int(11) NOT NULL,
  `pengikatan` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_pengikatan`
--

INSERT INTO `master_pengikatan` (`id_pengikatan`, `pengikatan`, `create_at`, `update_at`) VALUES
(1, 'Notaril', '2017-07-14 04:09:33', '0000-00-00 00:00:00'),
(2, 'Unnotaril', '2017-07-14 04:09:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_statusaplikasi`
--

CREATE TABLE `master_statusaplikasi` (
  `id_progress` int(11) NOT NULL,
  `status_progress` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_statusaplikasi`
--

INSERT INTO `master_statusaplikasi` (`id_progress`, `status_progress`, `create_at`, `update_at`) VALUES
(1, 'Done', '2017-07-14 04:17:15', '0000-00-00 00:00:00'),
(2, 'Undone', '2017-07-14 04:17:15', '0000-00-00 00:00:00'),
(3, 'On Progress', '2017-10-18 04:24:06', '0000-00-00 00:00:00'),
(4, 'Rejected', '2017-10-26 02:18:05', '0000-00-00 00:00:00'),
(5, 'Review Progress', '2017-10-30 04:01:05', '0000-00-00 00:00:00'),
(6, 'Reviewed', '2017-10-30 04:01:05', '0000-00-00 00:00:00'),
(7, 'Approved', '2017-11-15 02:44:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_statusprogress`
--

CREATE TABLE `master_statusprogress` (
  `id_progress` int(11) NOT NULL,
  `status_progress` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_statusprogress`
--

INSERT INTO `master_statusprogress` (`id_progress`, `status_progress`, `create_at`, `update_at`) VALUES
(1, 'Done', '2017-07-14 04:17:15', '0000-00-00 00:00:00'),
(2, 'Undone', '2017-07-14 04:17:15', '0000-00-00 00:00:00'),
(3, 'On Progress', '2017-10-18 04:24:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_syaratcovenant`
--

CREATE TABLE `master_syaratcovenant` (
  `id_syarat` int(11) NOT NULL,
  `syarat` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_syaratcovenant`
--

INSERT INTO `master_syaratcovenant` (`id_syarat`, `syarat`, `create_at`, `update_at`) VALUES
(1, 'Menjaga Perputaran Rekening Koran Debitur di Bank Secara Aktif', '2017-07-14 04:12:58', '0000-00-00 00:00:00'),
(2, 'Melaporkan Keuangan Inhouse', '2017-07-14 04:12:58', '0000-00-00 00:00:00'),
(3, 'Melaporkan Laporan Keuangan Audited', '2017-07-14 04:13:47', '0000-00-00 00:00:00'),
(4, 'Melakukan Eksternal Appraisal', '2017-07-14 04:13:47', '0000-00-00 00:00:00'),
(5, 'Lainnya', '2017-07-14 04:13:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tipekredit`
--

CREATE TABLE `master_tipekredit` (
  `id_tipekredit` int(11) NOT NULL,
  `tipe_kredit` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_tipekredit`
--

INSERT INTO `master_tipekredit` (`id_tipekredit`, `tipe_kredit`, `create_at`, `update_at`) VALUES
(1, 'New', '2017-07-14 04:05:47', '0000-00-00 00:00:00'),
(2, 'ReNew', '2017-07-14 04:05:47', '0000-00-00 00:00:00'),
(3, 'Reduce', '2017-07-14 04:06:25', '0000-00-00 00:00:00'),
(4, 'Addition', '2017-07-14 04:06:25', '0000-00-00 00:00:00'),
(5, 'Restructure', '2017-07-14 04:06:54', '0000-00-00 00:00:00'),
(6, 'ReNew + Reduce', '2017-07-14 04:06:54', '0000-00-00 00:00:00'),
(7, 'ReNew + Addition', '2017-07-14 04:07:20', '0000-00-00 00:00:00'),
(8, 'Lainnya', '2017-07-14 04:07:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputasuransi`
--

CREATE TABLE `tb_inputasuransi` (
  `id_asuransi` int(11) NOT NULL,
  `id_agunan` int(11) NOT NULL,
  `jenis_asuransi` int(11) NOT NULL,
  `asuransi_lain` text NOT NULL,
  `objek_asuransi` int(11) NOT NULL,
  `objek_lain` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `nilai_pertanggungan` double NOT NULL,
  `nama_asuransi` varchar(150) NOT NULL,
  `polis` varchar(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputasuransi`
--

INSERT INTO `tb_inputasuransi` (`id_asuransi`, `id_agunan`, `jenis_asuransi`, `asuransi_lain`, `objek_asuransi`, `objek_lain`, `alamat`, `nilai_pertanggungan`, `nama_asuransi`, `polis`, `start_date`, `end_date`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 1, '', 4, '', 'Jln Tuanku Tambusai Ujung Ruko 15 No 15 kota Pekanbaru', 585000000, 'ASURANSI BCA ', '120851182018', '2018-01-23', '2019-01-23', '16050842', '2018-01-23 03:51:13', '0000-00-00 00:00:00'),
(2, 4, 1, '', 1, '', 'JL REPELITA I KOMPLEK PONDOK MUTIARA BLOK E NO 15 KOTA PEKANBARU ', 223737000, 'ABDA', '01018011700185', '2018-01-23', '2019-01-23', '16050842', '2018-01-23 09:39:48', '0000-00-00 00:00:00'),
(3, 5, 1, '', 1, '', 'Jl. Letnan Simanjuntak No. 1788 RT. 026 RW. 010 Kel. Pahlawan Kec. Kemuning, Palembang', 1050000000, 'ABDA', '01020011700237', '2017-10-05', '2018-10-05', '14030570', '2018-01-24 03:30:02', '0000-00-00 00:00:00'),
(4, 15, 1, '', 1, '', 'JLN Sungai Rokan Komplek 80 No. 80 AK', 700000000, 'ABDA', '1018011700077', '2018-01-24', '2019-01-24', '16050842', '2018-01-24 09:30:16', '0000-00-00 00:00:00'),
(5, 13, 1, '', 4, '', 'JL SETIABUDI GG INDRAPURI NO 1C KOTA PEKANBARU\r\n', 250000000, 'ABDA', '1018011700080', '2018-01-24', '2018-01-24', '16050842', '2018-01-24 09:32:18', '0000-00-00 00:00:00'),
(6, 13, 1, '', 4, '', 'SULTAN SYARIF QASIM GG RINTIS I kOTA PEKANBARU\r\n', 900000000, 'ABDA', '1018011700076', '2018-01-24', '2019-01-24', '16050842', '2018-01-24 09:34:21', '0000-00-00 00:00:00'),
(7, 12, 1, '', 4, '', 'JL MELATI KEL PADANG BULAN KEC SENAPELAN KOTA PEKANBARU \r\n', 1300000000, 'ABDA', '1018011700079', '2018-01-24', '2019-01-24', '16050842', '2018-01-24 09:36:40', '0000-00-00 00:00:00'),
(8, 8, 1, '', 6, '', 'JL SIAK II No 168 KOTA PEKANBARU ', 1147125000, 'ABDA', '1018011700075', '2018-01-24', '2019-01-24', '16050842', '2018-01-24 09:38:54', '0000-00-00 00:00:00'),
(9, 7, 1, '', 6, '', 'JL SIAK II NO. 168 KOTA PEKANBARU', 1147125000, 'ABDA', '1018011700075', '2018-01-24', '2019-01-24', '16050842', '2018-01-24 09:40:41', '0000-00-00 00:00:00'),
(10, 16, 1, '', 1, '', 'PERUM CITRA GARDEN TYPE BRENTWOOD BLOK C NO 18 \r\nKEL NEGRI OLOK GADING TELUK BETUNG BARAT BANDAR LAMPUNG ', 691790000, 'ASURANSI WAHANA TATA ', '008.4050.201.20', '2017-10-01', '2018-10-01', '17070973', '2018-01-25 06:21:34', '0000-00-00 00:00:00'),
(11, 17, 3, 'HEAVY EQUITMENT ', 6, '', 'PEKON MATARAM ', 775500000, 'ASURANSI DAYIN MITRA ', 'CN NO 003/ADM/B', '2018-01-24', '2019-01-24', '17070973', '2018-01-25 06:40:02', '0000-00-00 00:00:00'),
(12, 18, 1, '', 1, '', 'JL. PUTRI CANDRAMIDI RT. 004 KEL. 014 KEL, SUI. BANGKONG KEC. PONTIANAK KAL-BAR', 322000000, 'ABDA', '01027011501870', '2015-10-06', '2022-10-05', '14030572', '2018-01-25 08:29:51', '0000-00-00 00:00:00'),
(13, 20, 1, '', 1, '', 'jln Inti sari No. 5 Pekanbaru', 271500000, 'abda', '1232451819', '2018-01-26', '2019-01-26', '16050842', '2018-01-26 04:32:47', '0000-00-00 00:00:00'),
(14, 22, 3, 'KENDARAAN ', 6, '', 'JL IKAN TONGKOL NO 1-3 TELUK BETUNG', 2700000000, 'ASURANSI DAYIN MITRA ', '05.300.3000053.', '2018-01-15', '2019-01-15', '17070973', '2018-01-26 06:36:42', '0000-00-00 00:00:00'),
(15, 24, 1, '', 6, '', 'JL KESEHATAN PANGKALAN KERINCI KABUPATEN PELALAWAN ', 1250000000, 'BCA INSURANCE ', '201828200018', '2018-01-26', '2019-01-26', '16050842', '2018-01-26 08:15:35', '0000-00-00 00:00:00'),
(16, 23, 1, '', 6, '', 'JL KESEHATAN PANGKALAN KERINCI KABUPATEN PELALAWAN ', 1250000000, 'BCA INSURANCE', '282920182015', '2018-01-26', '2019-01-26', '16050842', '2018-01-26 08:17:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputasuransifasilitas`
--

CREATE TABLE `tb_inputasuransifasilitas` (
  `id_asuransi` int(11) NOT NULL,
  `id_inputfasilitas` int(11) NOT NULL,
  `jenis_asuransi` int(11) NOT NULL,
  `asuransi_lain` text NOT NULL,
  `objek_asuransi` int(11) NOT NULL,
  `objek_lain` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `nilai_pertanggungan` double NOT NULL,
  `nama_asuransi` varchar(150) NOT NULL,
  `polis` varchar(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputasuransifasilitas`
--

INSERT INTO `tb_inputasuransifasilitas` (`id_asuransi`, `id_inputfasilitas`, `jenis_asuransi`, `asuransi_lain`, `objek_asuransi`, `objek_lain`, `alamat`, `nilai_pertanggungan`, `nama_asuransi`, `polis`, `start_date`, `end_date`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 2, '', 6, 'JIWA ', 'JL DUYUNG No. 7 Kota Pekanbaru ', 300000000, 'indosuryalife', '230812002018', '2018-01-23', '2019-01-23', '16050842', '2018-01-23 03:53:24', '0000-00-00 00:00:00'),
(2, 8, 2, '', 6, 'jiwa', 'jl Inti sari No 05 Pekanbaru', 325000000, 'MNC LIFE ', 'pk00196', '2018-01-26', '2020-01-24', '16050842', '2018-01-26 04:34:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputcarapenarikan`
--

CREATE TABLE `tb_inputcarapenarikan` (
  `id_carapenarikan` int(11) NOT NULL,
  `id_inputfasilitas` int(11) NOT NULL,
  `penarikan` text NOT NULL,
  `nik` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputcarapenarikan`
--

INSERT INTO `tb_inputcarapenarikan` (`id_carapenarikan`, `id_inputfasilitas`, `penarikan`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 'PENARIKAN DENGAN CEK / BG ', '16050842', '2018-01-23 03:30:03', '0000-00-00 00:00:00'),
(2, 2, 'Menggunakan Surat Aksep', '17091008', '2018-01-23 08:07:40', '0000-00-00 00:00:00'),
(3, 3, 'PENARIKAN MELALUI CEK/BG ', '16050842', '2018-01-23 09:34:08', '0000-00-00 00:00:00'),
(4, 4, 'Menjaga perputaran Rekening Koran debitur di Bank secara aktif dan mengalihkan omset usaha debitur ke Bank', '14030570', '2018-01-24 03:34:52', '0000-00-00 00:00:00'),
(5, 5, 'CEK & BG ', '16050842', '2018-01-24 09:24:10', '0000-00-00 00:00:00'),
(6, 6, '0', '17070973', '2018-01-25 06:24:02', '0000-00-00 00:00:00'),
(7, 7, '0', '17070973', '2018-01-25 06:41:19', '0000-00-00 00:00:00'),
(8, 8, 'pencairan langsung Ke Rekening Debitur ', '16050842', '2018-01-26 04:27:27', '0000-00-00 00:00:00'),
(9, 9, 'AKSEP', '16120922', '2018-01-26 04:51:04', '0000-00-00 00:00:00'),
(10, 10, 'Tidak ada', '16070881', '2018-01-26 05:41:38', '0000-00-00 00:00:00'),
(11, 11, '0', '17070973', '2018-01-26 06:29:20', '0000-00-00 00:00:00'),
(12, 12, 'SURAT PERNYATAAN DEALER, COPY FAKTUR PAJAK, BAST ALAT BERAT, & kWITANSI PELUNASAN & DP TELAH DITERIMA', '16050842', '2018-01-26 08:09:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputcovenant`
--

CREATE TABLE `tb_inputcovenant` (
  `id_input_covenant` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `id_syarat` int(11) NOT NULL,
  `syarat_lainnya` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status_progress` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputcovenant`
--

INSERT INTO `tb_inputcovenant` (`id_input_covenant`, `id_crm`, `id_syarat`, `syarat_lainnya`, `tgl_mulai`, `tgl_target`, `tgl_pemenuhan`, `status_progress`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 1, '', '2018-01-23', '2018-02-23', '2018-01-25', 1, '16050842', '2018-01-23 03:32:55', '2018-01-25 04:45:47'),
(2, 3, 1, '', '2017-11-21', '2018-11-21', '0000-00-00', 3, '17091008', '2018-01-23 08:13:50', '0000-00-00 00:00:00'),
(3, 4, 1, '', '2018-01-23', '2018-02-23', '0000-00-00', 3, '16050842', '2018-01-23 09:42:31', '0000-00-00 00:00:00'),
(4, 5, 1, '', '2017-10-05', '2018-10-05', '2018-01-25', 1, '14030570', '2018-01-24 03:39:10', '2018-01-25 04:42:10'),
(5, 6, 4, '', '2018-01-24', '2018-04-24', '0000-00-00', 3, '16050842', '2018-01-24 09:25:17', '0000-00-00 00:00:00'),
(6, 17, 5, 'menyerahakan fotokopy rencana anggaran dasar bangunan ', '2018-01-26', '2018-02-23', '0000-00-00', 3, '16050842', '2018-01-26 04:29:17', '0000-00-00 00:00:00'),
(7, 2, 5, '1.	Dana hasil panen dari kemitraan ditransfer langsung ke rekening atas nama Debitur di Bank Agris\r\n\r\n2.	Dana hasil panen yang masuk ke rekening Debitur di Bank Agris, wajib diblokir 2 bulan angsuran. Jika kondisi sudah membaik, dan dana tersedia di Rekening Debitur', '2018-01-29', '2018-01-01', '0000-00-00', 3, '16070881', '2018-01-26 05:43:46', '0000-00-00 00:00:00'),
(8, 19, 5, 'JAMINAN ALAT BERAT BERKERJA DI DARATAN TIDAK DI PERAIRAN ', '2018-01-26', '2018-02-22', '0000-00-00', 3, '16050842', '2018-01-26 08:11:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputcovernote`
--

CREATE TABLE `tb_inputcovernote` (
  `id_inputcovertnote` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `tgl_pengikatancovernote` date NOT NULL,
  `jenis_pengikatancovernote` int(11) NOT NULL,
  `nama_notaris` varchar(150) NOT NULL,
  `no_covernote` int(11) NOT NULL,
  `tgl_covernote` date NOT NULL,
  `nik` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputcovernote`
--

INSERT INTO `tb_inputcovernote` (`id_inputcovertnote`, `id_crm`, `tgl_pengikatancovernote`, `jenis_pengikatancovernote`, `nama_notaris`, `no_covernote`, `tgl_covernote`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, '2018-01-23', 1, 'SUHAIMAH SIMANJUNTAK SH', 23, '2018-04-23', '16050842', '2018-01-23 03:31:37', '0000-00-00 00:00:00'),
(2, 3, '2017-11-21', 1, 'LILIANA TEDJOSAPUTRO', 15, '2018-02-21', '17091008', '2018-01-23 08:11:49', '0000-00-00 00:00:00'),
(3, 4, '2018-01-23', 2, '', 4, '2018-01-29', '16050842', '2018-01-23 09:42:01', '0000-00-00 00:00:00'),
(4, 5, '2017-10-05', 1, 'Heniwati Ridwan, SH', 710, '2018-01-05', '14030570', '2018-01-24 03:37:57', '0000-00-00 00:00:00'),
(5, 6, '2018-01-24', 2, '', 24, '2018-02-22', '16050842', '2018-01-24 09:24:52', '0000-00-00 00:00:00'),
(6, 8, '2018-01-23', 1, 'EVA SURIANI ', 5114, '2018-04-23', '17070973', '2018-01-25 06:25:42', '0000-00-00 00:00:00'),
(7, 9, '2018-01-23', 1, 'BUDI KRISTIYANTO', 7719, '2018-03-23', '17070973', '2018-01-25 06:42:51', '0000-00-00 00:00:00'),
(8, 17, '2018-01-26', 2, 'suhaimah siman', 1, '2018-02-22', '16050842', '2018-01-26 04:28:07', '0000-00-00 00:00:00'),
(9, 18, '2018-01-25', 1, 'IMAM SUDJONO HERMANTO', 25, '2018-05-25', '16120922', '2018-01-26 04:52:04', '0000-00-00 00:00:00'),
(10, 11, '2018-01-26', 1, 'BUDI KRISTIYANTO', 7724, '2018-03-26', '17070973', '2018-01-26 06:33:16', '0000-00-00 00:00:00'),
(11, 19, '2018-01-26', 1, 'AFFIN SH', 28, '2018-03-26', '16050842', '2018-01-26 08:10:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputcrm`
--

CREATE TABLE `tb_inputcrm` (
  `id_crm` int(11) NOT NULL,
  `nama_debitur` varchar(250) NOT NULL,
  `cabang` varchar(150) NOT NULL,
  `nik_marketing` varchar(25) NOT NULL,
  `tgl_terimacrm` date NOT NULL,
  `cif` int(100) NOT NULL,
  `ppk` varchar(100) NOT NULL,
  `crm` varchar(100) NOT NULL,
  `nik_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputcrm`
--

INSERT INTO `tb_inputcrm` (`id_crm`, `nama_debitur`, `cabang`, `nik_marketing`, `tgl_terimacrm`, `cif`, `ppk`, `crm`, `nik_user`, `status`, `keterangan`, `create_at`, `update_at`) VALUES
(1, 'ALAMSYAH', 'KC PEKANBARU', '009', '2018-01-23', 30008268, '034/PKU-PPK/XII/2016', '574/PKU-CRM/12/2016', 16050842, 5, 'Mohon untuk pengisian Document TBO & Deviasi dibedakan.\r\nDocument deviasi --> bukan merupakan kelengkapan dokumen yg wajib\r\nDocument TBO --> dokumen wajib namun dapat disusulkan', '2018-01-23 03:14:19', '2018-01-26 03:22:32'),
(2, 'ROSIDA REZEKI', 'KC LENGKONG BANDUNG', '15120790', '2018-01-19', 30006579, '001/BDG-MAS/I/2018', '005/BDG-CRM-CRAM/I/2018', 16070881, 5, '', '2018-01-23 06:11:29', '2018-01-26 05:47:27'),
(3, 'SARINDO, CV', 'KC MT HARYONO SEMARANG', '16070873', '2017-11-10', 30015842, '031/SMG-PPK/XI/17 ', '459/SMG-CRM/XI/2017 ', 17091008, 5, '', '2018-01-23 07:49:37', '2018-01-23 08:49:11'),
(4, 'WILLY ARIFIN', 'KC PEKANBARU', '009', '2018-01-23', 30006702, '024/PKU-PPK/IX/2017', '406/PKU-CRM/IX/2017', 16050842, 5, '', '2018-01-23 09:27:34', '2018-01-23 09:46:04'),
(5, 'HENDRI JAPAR', 'KC KOL ATMO PALEMBANG', '006', '2017-09-19', 30015416, '013/PLG-PPK/VIII/2017', '404/PLG-CRM/IX/2017', 14030570, 7, '', '2018-01-24 03:15:37', '2018-01-25 04:43:10'),
(6, 'MULIANTO', 'KC PEKANBARU', '009', '2017-03-20', 3000674, '007/PKU-PPK/III/2017 ', '138/PKU-CRM/III/2017', 16050842, 7, '', '2018-01-24 04:04:49', '2018-01-25 04:38:24'),
(7, 'PT AGUNG PUTRA NIAGA MANDIRI', 'KC IKAN TONGKOL LMPG', '13010385', '2018-01-03', 11791, '227/PPK-LPG/12/17', '011/LPG-CRM/1/2018', 17070973, 5, '', '2018-01-25 05:05:22', '2018-01-25 06:02:59'),
(8, 'ERIC SURYADI CHANDRA ', 'KC IKAN TONGKOL LMPG', '13010385', '2017-11-27', 6225, '203/LPG-PPK/11/2017', '524/LPG-CRM/11/2017', 17070973, 5, '', '2018-01-25 06:12:17', '2018-01-25 06:29:48'),
(9, 'MARTIN GUNAWAN ', 'KC IKAN TONGKOL LMPG', '13010385', '2018-01-03', 30008314, '219/LPG-PPK/12/2017', '005/LPG-CRM/I/2018', 17070973, 3, '', '2018-01-25 06:31:47', '0000-00-00 00:00:00'),
(10, 'GOUW JONG KWANG', 'KC JUANDA PONTIANAK', '15010700', '2017-11-13', 30005582, '063/PTK-PPK/10/2017', '490/PTK-CRM/11/2017', 14030572, 3, '', '2018-01-25 07:54:32', '0000-00-00 00:00:00'),
(11, 'GUNUNG MAS KENCANA PUTRA , CV', 'KC IKAN TONGKOL LMPG', '13080468', '2018-01-11', 30011580, '224/PPK-LPG/12/2017 ', '002/LPG-CRM/I/2018 ', 13040399, 3, '', '2018-01-25 08:54:13', '0000-00-00 00:00:00'),
(12, 'EDWIN DARMAWAN ', 'KC IKAN TONGKOL LMPG', '13080468', '2018-01-12', 30010869, '235/LPG-PPK/XII/17 ', '015 /LPG-CRM/01/2018 ', 13040399, 3, '', '2018-01-25 08:55:45', '0000-00-00 00:00:00'),
(13, 'SERIBU BUNGA MEKAR, PT', 'KC IKAN TONGKOL LMPG', '13010385', '2017-11-23', 30011940, '198/LPG-PPK/XI/2017 ', '508/LPG-CRM/11/2017 ', 13040399, 3, '', '2018-01-25 08:59:22', '0000-00-00 00:00:00'),
(14, 'PEK GUNAWAN ', 'KC IKAN TONGKOL LMPG', '13010385', '2018-01-24', 1046, '226/LPG-PPK/XII/2017', '008/LPG-CRM/I/2018 ', 13040399, 3, '', '2018-01-25 09:08:31', '0000-00-00 00:00:00'),
(15, 'SUSAMA DJOHAN ', 'KC IKAN TONGKOL LMPG', '13080468', '2018-01-24', 11239, '001/LPG-PPK/I/18  ', '019  /LPG-CRM/I/2018', 13040399, 3, '', '2018-01-25 09:09:40', '0000-00-00 00:00:00'),
(16, 'Yovie', 'KC PEKANBARU', '009', '2018-01-31', 0, 'PPK', 'CRM', 16050842, 3, '', '2018-01-26 03:24:50', '0000-00-00 00:00:00'),
(17, 'Hafidz Safaat', 'KC PEKANBARU', '009', '2018-01-01', 30006290, '035/0909/PPK', '035/0909/CRM', 16050842, 5, '', '2018-01-26 03:47:11', '2018-01-26 04:35:03'),
(18, 'ANSORI', 'KC RADEN SALEH SBY', '003', '2018-01-22', 30004272, '008/PPK-MIKRO/SBY/XI/17', '013/SBY-CRM-CRAM/XII/17', 16120922, 5, '', '2018-01-26 04:43:24', '2018-01-26 04:55:43'),
(19, 'CV PUTRA ALAM JAYA', 'KC PEKANBARU', '009', '2018-01-26', 30002252, '007/PKU-PPK/02/2016', '110/PKU-CRM/02/2016', 16050842, 5, '', '2018-01-26 08:02:46', '2018-01-26 08:17:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputdeviasi`
--

CREATE TABLE `tb_inputdeviasi` (
  `id_inputdeviasi` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `id_deviasi` int(11) NOT NULL,
  `deviasi_lain` varchar(250) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status_progress` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputdeviasi`
--

INSERT INTO `tb_inputdeviasi` (`id_inputdeviasi`, `id_crm`, `id_deviasi`, `deviasi_lain`, `tgl_mulai`, `tgl_target`, `tgl_pemenuhan`, `status_progress`, `keterangan`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 4, '', '2018-01-23', '2018-04-23', '0000-00-00', 3, 'SURAT KETERANGAN PENGURUSAN SERTIFIKAT ', '16050842', '2018-01-23 03:35:23', '2018-01-26 03:22:19'),
(2, 4, 2, '', '2018-01-23', '2018-04-23', '0000-00-00', 3, 'WAKTU PENGURUSAN 3 BULAN ', '16050842', '2018-01-23 09:44:56', '0000-00-00 00:00:00'),
(3, 6, 5, '', '2018-01-24', '2018-04-24', '0000-00-00', 3, 'LAPORAN KEUANGAN AUDITED', '16050842', '2018-01-24 09:26:26', '0000-00-00 00:00:00'),
(4, 17, 2, '', '2018-01-25', '2018-02-22', '0000-00-00', 3, 'Surat Keterangan Usaha dari dinas terkait ', '16050842', '2018-01-26 04:31:04', '0000-00-00 00:00:00'),
(5, 2, 1, '', '2018-01-29', '2018-01-29', '0000-00-00', 3, 'Deviasi luas bangunan IMB tidak sesuai dengan fisik bangunan', '16070881', '2018-01-26 05:45:51', '0000-00-00 00:00:00'),
(6, 2, 1, '', '2018-01-29', '2018-01-29', '0000-00-00', 3, 'Deviasi luas bangunan IMB tidak sesuai dengan fisik bangunan', '16070881', '2018-01-26 05:45:51', '0000-00-00 00:00:00'),
(7, 19, 5, '', '2018-01-26', '2018-03-26', '0000-00-00', 3, 'LAPORAN KEUANGAN AUDITED SEDANG PROSES PEMBUATAN OLEH AKUNTAN PUBLIK ', '16050842', '2018-01-26 08:13:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputdoc`
--

CREATE TABLE `tb_inputdoc` (
  `id_inputdoc` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `doc_lain` varchar(250) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `status` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputdoc`
--

INSERT INTO `tb_inputdoc` (`id_inputdoc`, `id_crm`, `id_doc`, `doc_lain`, `tgl_pengurusan`, `tgl_target`, `tgl_pemenuhan`, `status`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 5, '', '2018-01-23', '2018-04-23', '0000-00-00', 3, '16050842', '2018-01-23 03:33:50', '2018-01-26 03:20:56'),
(2, 3, 7, '', '2017-11-21', '2018-01-21', '0000-00-00', 3, '17091008', '2018-01-23 08:12:55', '0000-00-00 00:00:00'),
(3, 4, 5, '', '2018-01-23', '2018-04-23', '0000-00-00', 3, '16050842', '2018-01-23 09:43:19', '0000-00-00 00:00:00'),
(4, 6, 1, '', '2018-01-24', '2018-04-24', '0000-00-00', 3, '16050842', '2018-01-24 09:25:37', '0000-00-00 00:00:00'),
(5, 17, 18, '', '2018-01-26', '2018-02-07', '0000-00-00', 3, '16050842', '2018-01-26 04:29:55', '0000-00-00 00:00:00'),
(6, 2, 5, '', '2018-01-29', '2018-02-01', '0000-00-00', 3, '16070881', '2018-01-26 05:44:33', '0000-00-00 00:00:00'),
(7, 19, 10, '', '2018-01-26', '2018-04-26', '0000-00-00', 3, '16050842', '2018-01-26 08:12:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputfasilitas`
--

CREATE TABLE `tb_inputfasilitas` (
  `id_inputfasilitas` int(11) NOT NULL,
  `id_agunan` int(11) NOT NULL,
  `jenis_fasilitas` int(11) NOT NULL,
  `fascode` varchar(25) NOT NULL,
  `plafond` double NOT NULL,
  `id_tipkredit` int(11) NOT NULL,
  `tipkreditlain` varchar(150) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputfasilitas`
--

INSERT INTO `tb_inputfasilitas` (`id_inputfasilitas`, `id_agunan`, `jenis_fasilitas`, `fascode`, `plafond`, `id_tipkredit`, `tipkreditlain`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 1, 'PRK01', 300000000, 1, '', '16050842', '2018-01-23 03:30:03', '0000-00-00 00:00:00'),
(2, 3, 2, 'DL1', 13000000000, 1, '', '17091008', '2018-01-23 08:07:40', '0000-00-00 00:00:00'),
(3, 4, 1, 'PRK02', 200000000, 2, '', '16050842', '2018-01-23 09:34:08', '0000-00-00 00:00:00'),
(4, 5, 1, 'PRK01', 2200000000, 1, '', '14030570', '2018-01-24 03:34:52', '0000-00-00 00:00:00'),
(5, 6, 1, 'PRK03', 20000000000, 2, '', '16050842', '2018-01-24 09:24:10', '0000-00-00 00:00:00'),
(6, 16, 7, 'KI01', 1250000000, 1, '', '17070973', '2018-01-25 06:24:02', '0000-00-00 00:00:00'),
(7, 17, 7, 'KI02', 542850000, 1, '', '17070973', '2018-01-25 06:41:19', '0000-00-00 00:00:00'),
(8, 20, 1, 'PRK04', 267000000, 5, '', '16050842', '2018-01-26 04:27:27', '0000-00-00 00:00:00'),
(9, 21, 7, 'KI01', 700000000, 5, '', '16120922', '2018-01-26 04:51:04', '0000-00-00 00:00:00'),
(10, 2, 7, 'KI30006579.0008582.01', 1921626817.99, 5, '', '16070881', '2018-01-26 05:41:38', '0000-00-00 00:00:00'),
(11, 22, 7, 'KI03', 1345000000, 1, '', '17070973', '2018-01-26 06:29:20', '0000-00-00 00:00:00'),
(12, 23, 7, 'KI001', 2000000000, 1, '', '16050842', '2018-01-26 08:09:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputjaminan`
--

CREATE TABLE `tb_inputjaminan` (
  `id_agunan` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `jaminan` int(11) NOT NULL,
  `jaminan_lain` varchar(150) NOT NULL,
  `duedate_hgb` date NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_certificate` varchar(100) NOT NULL,
  `nama_pemilik` varchar(250) NOT NULL,
  `pengikatan` int(11) NOT NULL,
  `pengikatan_lain` varchar(150) NOT NULL,
  `nilai_penjaminan` double NOT NULL,
  `no_akta` varchar(150) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_penyelesaian` date NOT NULL,
  `tgl_khasanah` date NOT NULL,
  `status` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputjaminan`
--

INSERT INTO `tb_inputjaminan` (`id_agunan`, `id_crm`, `jaminan`, `jaminan_lain`, `duedate_hgb`, `alamat`, `no_certificate`, `nama_pemilik`, `pengikatan`, `pengikatan_lain`, `nilai_penjaminan`, `no_akta`, `tgl_pengurusan`, `tgl_target`, `tgl_penyelesaian`, `tgl_khasanah`, `status`, `nik`, `create_at`, `update_at`) VALUES
(1, 1, 2, '', '1111-11-11', 'Jln Tuanku Tambusai Ujung Ruko 15 No. 15 Kota Pekanbaru', 'SHM 6596, 6590 & 661 ', 'ALAMSYAH', 1, '', 875000000, '35/2016', '2018-01-23', '2018-04-26', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-23 03:25:50', '2018-01-25 04:44:46'),
(2, 2, 2, '', '1111-11-11', '(Cibodo Pasir) Kampung Cibodo Pasir RT.3 RW.13, Desa Babakan, Kecamatan Ciparay, Kabupaten Bandung, Propinsi Jawa Barat', 'SHM No.1287/Kelurahan Babakan', 'ROSIDA REZEKI', 1, '', 2687500000, '00914/2016', '2018-01-23', '2018-01-23', '0000-00-00', '0000-00-00', 3, '16070881', '2018-01-23 06:18:39', '0000-00-00 00:00:00'),
(3, 3, 2, '', '2018-11-21', 'Dukuh Sukolilo, Sidomukti, PAti', '1210/Sidomukti', 'SUHARDI', 1, '', 1165000000, '', '2017-11-21', '2018-02-21', '0000-00-00', '0000-00-00', 3, '17091008', '2018-01-23 08:03:12', '2018-01-23 08:06:08'),
(4, 4, 2, '', '2025-09-25', 'JL Repelita I  Komplek  Pondok Mutiara Blok E No 15 Kota Pekanbaru', 'SHGB 948', 'LILIS YANTI, YULI PRANA ARIFIN, WILLY ARIFIN & SYLVIA ARIFIN ', 1, '', 250000000, '306/2016', '2018-01-23', '2018-04-27', '0000-00-00', '0000-00-00', 3, '16050842', '2018-01-23 09:32:31', '0000-00-00 00:00:00'),
(5, 5, 2, '', '1111-11-11', 'Jl. Letnan Simanjuntak No. 1788 RT. 026 RW. 010 Kel. Pahlawan Kec. Kemuning, Palembang', 'SHM No. 9965', 'Hendri Japar', 1, '', 3138000000, '5130/2017', '2017-10-05', '2017-10-05', '2018-01-25', '2017-11-24', 1, '14030570', '2018-01-24 03:25:13', '2018-01-25 04:40:42'),
(6, 6, 1, '', '1111-11-11', 'Jl Siak II  No. 168 Kota Pekanbaru ', 'SHM 1860', 'MULIANTO', 1, '', 2090585000, '137/2015', '2018-01-24', '2018-04-23', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:22:01', '2018-01-25 04:08:41'),
(7, 6, 4, '', '0000-00-00', 'JlN siak II No. 168 Kota Pekanbaru', 'SHM 1861', 'MULIANTO', 1, '', 6724675000, '2942/2015', '2018-01-24', '2018-04-25', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:26:12', '2018-01-25 04:08:16'),
(8, 6, 4, '', '0000-00-00', 'Jln siak II No. 168 Kota Pekanbaru ', '03626', 'mulianto', 1, '', 980010000, '2980/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:29:17', '2018-01-25 04:06:31'),
(9, 6, 1, '', '1111-11-11', 'jl siak II No. 168 Kota Pekanbaru', '2875', 'mulianto', 1, '', 10469000000, '2945/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:34:38', '2018-01-25 03:57:02'),
(10, 6, 1, '', '1111-11-11', 'jl siak II No. 168 Kota Pekanbaru', '3623', 'mulianto', 1, '', 92400000, '117/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:36:25', '2018-01-25 03:56:41'),
(11, 6, 1, '', '1111-11-11', 'jl siak II No. 168 Kota Pekanabaru ', '3622', 'mulianto', 1, '', 193200000, '2665/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:41:15', '2018-01-25 03:56:18'),
(12, 6, 2, '', '1111-11-11', 'Jl Melati kel padang bulan Kec senapelan kota pekanbaru', 'SHM 758', 'mulianto', 1, '', 2412000000, '2943/2015', '2018-01-24', '2018-04-25', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:45:41', '2018-01-25 03:56:04'),
(13, 6, 2, '', '1111-11-11', 'jl setia budi gang Indra puri No. 1 C Kota Pekanbaru', 'SHM 592', 'MULIANTO', 1, '', 576500000, '2790/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 08:50:08', '2018-01-25 03:54:52'),
(14, 6, 2, '', '1111-11-11', 'jl sutan syarif qasim Gang Rintis 1 No. 1 Kota Pekanbaru', 'SHM 1049', 'Mulianto', 1, '', 1426600000, '2691/2015', '2018-01-24', '2018-04-24', '2018-01-25', '0000-00-00', 1, '16050842', '2018-01-24 09:17:40', '2018-01-25 03:52:51'),
(15, 6, 2, '', '1111-11-11', 'Jl sungai rokan komplek 80 No. 80 AK Kota Pekanbaru ', 'SHM 324', 'MULIANTO', 1, '', 653620000, '2791/2015', '2018-01-24', '2018-04-24', '2018-01-24', '0000-00-00', 1, '16050842', '2018-01-24 09:20:25', '2018-01-25 03:51:37'),
(16, 8, 2, '', '2020-12-11', 'PERUM CITRA GARDEN TYPE BRENTWOOD BLOK C NO 18 KEL NEGRI OLOK GADING TELUK BETUNG BARAT BANDAR LAMPUNG ', 'SHM NO 1041/BKG ', 'JERRY ARGENTINO KOAGOUW', 1, '', 1510000000, 'SKMHT NO 19/2018', '2018-01-23', '2018-04-23', '0000-00-00', '0000-00-00', 3, '17070973', '2018-01-25 06:18:17', '0000-00-00 00:00:00'),
(17, 9, 7, '', '0000-00-00', 'PEKON MATARAM RT 01 RW 01 MATARAM REJO TANGGAMUS', 'INVOICE NO R2401101', 'MARTIN GUNAWAN ', 2, '', 775500000, '28', '2018-01-23', '2018-03-23', '0000-00-00', '0000-00-00', 3, '17070973', '2018-01-25 06:36:00', '0000-00-00 00:00:00'),
(18, 10, 2, '', '0000-00-00', 'JL. PUTRI CANDRAMIDI RT. 004. RW. 014 KEL, SUI. BANGKONG KEC. PONTIANAK KALIMANTAN BARAT', '13825', 'GOUW JONG KWANG', 1, '', 437500000, '4316', '2017-11-22', '2018-02-22', '0000-00-00', '2018-01-05', 3, '14030572', '2018-01-25 08:21:20', '0000-00-00 00:00:00'),
(19, 6, 2, '', '1111-11-11', 'JL SIAK PKU ', 'SHM 752', 'MULIANTO ', 0, '', 1000000000, '26/2018', '2018-01-26', '2018-04-26', '0000-00-00', '0000-00-00', 3, '16050842', '2018-01-26 03:33:45', '0000-00-00 00:00:00'),
(20, 17, 2, '', '1112-02-19', 'jl intisari No. 5 A rumbai Kota pekanbaru', 'shm 0416', 'Masrul Chandra (oarng tua Debitur )', 1, '', 406250000, '6493/2016', '2018-01-26', '2018-04-26', '0000-00-00', '0000-00-00', 3, '16050842', '2018-01-26 04:26:07', '0000-00-00 00:00:00'),
(21, 18, 8, '', '0000-00-00', 'DUSUN BANJARAN', 'SHM 1643', 'ANSORI', 1, '', 700000000, '2005/2017', '2018-01-25', '2018-05-25', '0000-00-00', '0000-00-00', 3, '16120922', '2018-01-26 04:48:19', '0000-00-00 00:00:00'),
(22, 11, 5, '', '0000-00-00', 'JL IKAN TONGKOL NO 1-3 PESAWAHAN TELUK BETUNG ', 'SK DEALER NO 0072/AI-ISO/LPG/XII/2017', 'PT TRIDATU UTAMA ARTHA PERSADA', 2, '', 625000000, '41', '2017-12-19', '2018-03-19', '0000-00-00', '0000-00-00', 3, '17070973', '2018-01-26 06:28:26', '0000-00-00 00:00:00'),
(23, 19, 6, '', '0000-00-00', 'JL KESEHATAN PANGkALAN KERINCI KABUPATEN PELALAWAN', 'INVOICE NO MH180-03346', 'CV PUTRA ALAM JAYA', 2, '', 1250000000, '28', '2018-01-26', '2018-03-28', '0000-00-00', '0000-00-00', 3, '16050842', '2018-01-26 08:06:02', '0000-00-00 00:00:00'),
(24, 19, 6, '', '0000-00-00', 'JL KESEHATAN PANGKALAN KERINCI KAB PELALAWAN', 'INVOICE NO MH180-03347', 'CV PUTRA ALAM JAYA ', 2, '', 1250000000, '28', '2018-01-26', '2018-02-26', '0000-00-00', '0000-00-00', 3, '16050842', '2018-01-26 08:07:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputpencairan`
--

CREATE TABLE `tb_inputpencairan` (
  `id_pencairan` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `tgl_pencairan` date NOT NULL,
  `nik` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputpencairan`
--

INSERT INTO `tb_inputpencairan` (`id_pencairan`, `id_crm`, `tgl_pencairan`, `nik`, `create_at`, `update_at`) VALUES
(1, 6, '2018-01-26', 16050842, '2018-01-26 03:35:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inputsignpk`
--

CREATE TABLE `tb_inputsignpk` (
  `id_inputsign` int(11) NOT NULL,
  `id_crm` int(11) NOT NULL,
  `no_pk` varchar(150) NOT NULL,
  `tgl_pengurusan` date NOT NULL,
  `tgl_target` date NOT NULL,
  `tgl_pemenuhan` date NOT NULL,
  `tgl_khasanah` date NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `nik` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_inputsignpk`
--

INSERT INTO `tb_inputsignpk` (`id_inputsign`, `id_crm`, `no_pk`, `tgl_pengurusan`, `tgl_target`, `tgl_pemenuhan`, `tgl_khasanah`, `status`, `keterangan`, `nik`, `create_at`, `update_at`) VALUES
(1, 5, '09', '2017-09-27', '2017-10-05', '2017-10-05', '2017-11-24', 1, 'Sign PK tepat waktu.', '14030570', '2018-01-25 07:51:47', '0000-00-00 00:00:00'),
(2, 6, '29', '2018-01-26', '2018-02-26', '2018-02-12', '2018-02-13', 1, 'perjanjian kredit oke ', '16050842', '2018-01-26 03:02:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` int(8) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `nik_input` int(8) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `password`, `id_cabang`, `hak_akses`, `aktif`, `nik_input`, `create_at`, `update_at`) VALUES
(7, 17111023, 'Yovita Wuryanto', '6f9b53748c302b5e904d4717dd689665', 1, '2', 'Y', 17111023, '2018-01-25 12:03:30', '2018-01-25 12:03:30'),
(8, 15090766, 'HANA SEFIANTI', '6f9b53748c302b5e904d4717dd689665', 2, '3', 'Y', 17111023, '2018-01-19 06:27:49', '0000-00-00 00:00:00'),
(9, 17070973, 'SUWANTO', '6f9b53748c302b5e904d4717dd689665', 9, '3', 'Y', 17111023, '2018-01-19 06:29:36', '0000-00-00 00:00:00'),
(10, 13040399, 'MONI', '6f9b53748c302b5e904d4717dd689665', 9, '3', 'Y', 17111023, '2018-01-19 06:33:00', '0000-00-00 00:00:00'),
(11, 17030948, 'YULIANA SEKARPURI', '6f9b53748c302b5e904d4717dd689665', 18, '3', 'Y', 17111023, '2018-01-19 06:33:38', '0000-00-00 00:00:00'),
(12, 16120922, 'LINDA HARTANTO', '6f9b53748c302b5e904d4717dd689665', 16, '3', 'Y', 17111023, '2018-01-19 06:34:17', '0000-00-00 00:00:00'),
(13, 14040581, 'MESTIKA A. LESTARI', '6f9b53748c302b5e904d4717dd689665', 13, '3', 'Y', 17111023, '2018-01-19 06:42:45', '0000-00-00 00:00:00'),
(14, 17091008, 'UDJI RAHARDJO', '6f9b53748c302b5e904d4717dd689665', 17, '3', 'Y', 17111023, '2018-01-19 06:43:25', '0000-00-00 00:00:00'),
(15, 14030570, 'SATRIO NUGROHO', '6f9b53748c302b5e904d4717dd689665', 12, '3', 'Y', 17111023, '2018-01-19 06:44:25', '0000-00-00 00:00:00'),
(16, 16070881, 'MARIA MAGDALENA DAUD', '6f9b53748c302b5e904d4717dd689665', 19, '3', 'Y', 17111023, '2018-01-19 06:45:00', '0000-00-00 00:00:00'),
(17, 14030572, 'PIPIH K. IRWAN', '6f9b53748c302b5e904d4717dd689665', 20, '3', 'Y', 17111023, '2018-01-19 06:46:05', '0000-00-00 00:00:00'),
(18, 16050842, 'SURYADIANTO B. SUKENO', '6f9b53748c302b5e904d4717dd689665', 15, '3', 'Y', 17111023, '2018-01-19 06:47:01', '0000-00-00 00:00:00'),
(19, 13080465, 'MIRA JANE', '6f9b53748c302b5e904d4717dd689665', 13, '3', 'Y', 17111023, '2018-01-19 07:24:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histinputasuransi`
--
ALTER TABLE `histinputasuransi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputasuransifasilitas`
--
ALTER TABLE `histinputasuransifasilitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputcarapenarikan`
--
ALTER TABLE `histinputcarapenarikan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputcovenant`
--
ALTER TABLE `histinputcovenant`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputcovernote`
--
ALTER TABLE `histinputcovernote`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputcrm`
--
ALTER TABLE `histinputcrm`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputdeviasi`
--
ALTER TABLE `histinputdeviasi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputdoc`
--
ALTER TABLE `histinputdoc`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputfasilitas`
--
ALTER TABLE `histinputfasilitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputjaminan`
--
ALTER TABLE `histinputjaminan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `histinputsignpk`
--
ALTER TABLE `histinputsignpk`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`no_login`);

--
-- Indexes for table `master_document`
--
ALTER TABLE `master_document`
  ADD PRIMARY KEY (`id_masterdoc`);

--
-- Indexes for table `master_fasilitas`
--
ALTER TABLE `master_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `master_jenispengikatanagunan`
--
ALTER TABLE `master_jenispengikatanagunan`
  ADD PRIMARY KEY (`id_jenispengikatanagunan`);

--
-- Indexes for table `master_marketing`
--
ALTER TABLE `master_marketing`
  ADD PRIMARY KEY (`id_marketing`);

--
-- Indexes for table `master_pengikatan`
--
ALTER TABLE `master_pengikatan`
  ADD PRIMARY KEY (`id_pengikatan`);

--
-- Indexes for table `master_statusaplikasi`
--
ALTER TABLE `master_statusaplikasi`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indexes for table `master_statusprogress`
--
ALTER TABLE `master_statusprogress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indexes for table `tb_inputasuransi`
--
ALTER TABLE `tb_inputasuransi`
  ADD PRIMARY KEY (`id_asuransi`);

--
-- Indexes for table `tb_inputasuransifasilitas`
--
ALTER TABLE `tb_inputasuransifasilitas`
  ADD PRIMARY KEY (`id_asuransi`);

--
-- Indexes for table `tb_inputcarapenarikan`
--
ALTER TABLE `tb_inputcarapenarikan`
  ADD PRIMARY KEY (`id_carapenarikan`);

--
-- Indexes for table `tb_inputcovenant`
--
ALTER TABLE `tb_inputcovenant`
  ADD PRIMARY KEY (`id_input_covenant`);

--
-- Indexes for table `tb_inputcovernote`
--
ALTER TABLE `tb_inputcovernote`
  ADD PRIMARY KEY (`id_inputcovertnote`);

--
-- Indexes for table `tb_inputcrm`
--
ALTER TABLE `tb_inputcrm`
  ADD PRIMARY KEY (`id_crm`);

--
-- Indexes for table `tb_inputdeviasi`
--
ALTER TABLE `tb_inputdeviasi`
  ADD PRIMARY KEY (`id_inputdeviasi`);

--
-- Indexes for table `tb_inputdoc`
--
ALTER TABLE `tb_inputdoc`
  ADD PRIMARY KEY (`id_inputdoc`);

--
-- Indexes for table `tb_inputfasilitas`
--
ALTER TABLE `tb_inputfasilitas`
  ADD PRIMARY KEY (`id_inputfasilitas`);

--
-- Indexes for table `tb_inputjaminan`
--
ALTER TABLE `tb_inputjaminan`
  ADD PRIMARY KEY (`id_agunan`);

--
-- Indexes for table `tb_inputpencairan`
--
ALTER TABLE `tb_inputpencairan`
  ADD PRIMARY KEY (`id_pencairan`);

--
-- Indexes for table `tb_inputsignpk`
--
ALTER TABLE `tb_inputsignpk`
  ADD PRIMARY KEY (`id_inputsign`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histinputasuransi`
--
ALTER TABLE `histinputasuransi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histinputasuransifasilitas`
--
ALTER TABLE `histinputasuransifasilitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histinputcarapenarikan`
--
ALTER TABLE `histinputcarapenarikan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histinputcovenant`
--
ALTER TABLE `histinputcovenant`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `histinputcovernote`
--
ALTER TABLE `histinputcovernote`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histinputcrm`
--
ALTER TABLE `histinputcrm`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `histinputdeviasi`
--
ALTER TABLE `histinputdeviasi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `histinputdoc`
--
ALTER TABLE `histinputdoc`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `histinputfasilitas`
--
ALTER TABLE `histinputfasilitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histinputjaminan`
--
ALTER TABLE `histinputjaminan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `histinputsignpk`
--
ALTER TABLE `histinputsignpk`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `no_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `master_document`
--
ALTER TABLE `master_document`
  MODIFY `id_masterdoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `master_fasilitas`
--
ALTER TABLE `master_fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `master_jenispengikatanagunan`
--
ALTER TABLE `master_jenispengikatanagunan`
  MODIFY `id_jenispengikatanagunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_marketing`
--
ALTER TABLE `master_marketing`
  MODIFY `id_marketing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `master_pengikatan`
--
ALTER TABLE `master_pengikatan`
  MODIFY `id_pengikatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_statusaplikasi`
--
ALTER TABLE `master_statusaplikasi`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_statusprogress`
--
ALTER TABLE `master_statusprogress`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_inputasuransi`
--
ALTER TABLE `tb_inputasuransi`
  MODIFY `id_asuransi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_inputasuransifasilitas`
--
ALTER TABLE `tb_inputasuransifasilitas`
  MODIFY `id_asuransi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_inputcarapenarikan`
--
ALTER TABLE `tb_inputcarapenarikan`
  MODIFY `id_carapenarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_inputcovenant`
--
ALTER TABLE `tb_inputcovenant`
  MODIFY `id_input_covenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_inputcovernote`
--
ALTER TABLE `tb_inputcovernote`
  MODIFY `id_inputcovertnote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_inputcrm`
--
ALTER TABLE `tb_inputcrm`
  MODIFY `id_crm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tb_inputdeviasi`
--
ALTER TABLE `tb_inputdeviasi`
  MODIFY `id_inputdeviasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_inputdoc`
--
ALTER TABLE `tb_inputdoc`
  MODIFY `id_inputdoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_inputfasilitas`
--
ALTER TABLE `tb_inputfasilitas`
  MODIFY `id_inputfasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_inputjaminan`
--
ALTER TABLE `tb_inputjaminan`
  MODIFY `id_agunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_inputpencairan`
--
ALTER TABLE `tb_inputpencairan`
  MODIFY `id_pencairan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_inputsignpk`
--
ALTER TABLE `tb_inputsignpk`
  MODIFY `id_inputsign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
