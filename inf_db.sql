-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for inf_db
CREATE DATABASE IF NOT EXISTS `inf_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inf_db`;

-- Dumping structure for table inf_db.anggaran
CREATE TABLE IF NOT EXISTS `anggaran` (
  `id_anggaran` varchar(50) NOT NULL,
  `nama_anggaran` varchar(255) DEFAULT NULL,
  `tahun_anggaran` varchar(50) DEFAULT NULL,
  `nilai_anggaran` int(13) DEFAULT NULL,
  PRIMARY KEY (`id_anggaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.anggaran: ~5 rows (approximately)
/*!40000 ALTER TABLE `anggaran` DISABLE KEYS */;
INSERT INTO `anggaran` (`id_anggaran`, `nama_anggaran`, `tahun_anggaran`, `nilai_anggaran`) VALUES
	('20180208201814155', 'jjj', '2018', 900000),
	('20180208201819555', 'a', '2018', 900),
	('20180208201871634', 'jaja', '2018', 900000),
	('20180208201877851', 'ppp', '2018', 800000),
	('20180301201812581', 'lallalala', '2018', 79898);
/*!40000 ALTER TABLE `anggaran` ENABLE KEYS */;

-- Dumping structure for table inf_db.hak_akses
CREATE TABLE IF NOT EXISTS `hak_akses` (
  `akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `akses_nama` varchar(35) NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`akses_id`),
  UNIQUE KEY `akses_nama` (`akses_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.hak_akses: ~5 rows (approximately)
/*!40000 ALTER TABLE `hak_akses` DISABLE KEYS */;
INSERT INTO `hak_akses` (`akses_id`, `akses_nama`, `hapus`, `inputdate`, `updatedate`) VALUES
	(1, 'superadmin', 0, '2017-02-08 17:26:16', '2017-02-08 17:26:16'),
	(2, 'maker', 0, '2017-02-08 17:26:16', '2017-02-08 17:26:16'),
	(3, 'checker', 0, '2017-02-10 11:29:00', '2017-02-16 14:08:59'),
	(4, 'signer', 0, '2017-02-16 14:09:16', '2017-02-16 14:09:16'),
	(5, 'hh', 1, '2017-07-17 07:18:45', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hak_akses` ENABLE KEYS */;

-- Dumping structure for table inf_db.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.jabatan: ~9 rows (approximately)
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `nama`, `hapus`, `inputdate`, `updatedate`) VALUES
	(1, 'Kepala Bagian', 0, '2017-04-11 05:14:45', '2017-04-06 11:18:43'),
	(2, 'Wakil Kepala Bagian', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(3, 'Enggineer', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(4, 'Supervisor', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(5, 'Teknisi', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(6, 'Operator', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(7, 'Librarian', 0, '2017-04-06 11:18:43', '2017-04-06 11:18:43'),
	(8, 'admin', 0, '2017-04-06 14:35:52', '2017-04-06 14:35:52'),
	(12, 'Kepala Divisi', 0, '2017-08-21 10:42:55', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;

-- Dumping structure for table inf_db.log_login
CREATE TABLE IF NOT EXISTS `log_login` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_user_pn` varchar(50) NOT NULL,
  `log_ip` varchar(200) NOT NULL,
  `log_os` varchar(255) NOT NULL,
  `log_browser` varchar(255) NOT NULL,
  `log_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.log_login: ~15 rows (approximately)
/*!40000 ALTER TABLE `log_login` DISABLE KEYS */;
INSERT INTO `log_login` (`log_id`, `log_user_pn`, `log_ip`, `log_os`, `log_browser`, `log_tanggal`) VALUES
	(1, 'admin', '::1', 'Windows 10', 'Chrome 63.0.3239.84', '2018-01-04 13:51:43'),
	(2, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.84', '2018-01-05 09:00:25'),
	(3, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.84', '2018-01-05 14:14:11'),
	(4, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.84', '2018-01-08 08:50:55'),
	(5, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.84', '2018-01-09 09:02:37'),
	(6, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.132', '2018-01-10 15:35:53'),
	(7, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.132', '2018-01-15 13:54:52'),
	(8, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.132', '2018-02-05 14:21:04'),
	(9, 'administrator', '::1', 'Windows 10', 'Chrome 63.0.3239.132', '2018-02-08 08:08:16'),
	(10, 'administrator', '::1', 'Windows 10', 'Chrome 64.0.3282.140', '2018-02-12 15:18:54'),
	(11, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-13 14:39:44'),
	(12, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-15 08:33:07'),
	(13, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-20 07:55:59'),
	(14, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-21 08:05:47'),
	(15, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-21 12:47:10'),
	(16, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-22 14:03:45'),
	(17, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-22 14:09:43'),
	(18, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-26 08:38:22'),
	(19, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-02-28 14:47:34'),
	(20, 'administrator', '::1', 'Windows 10', 'Opera 51.0.2830.26', '2018-03-01 08:14:52');
/*!40000 ALTER TABLE `log_login` ENABLE KEYS */;

-- Dumping structure for table inf_db.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `is_order` int(5) NOT NULL,
  `hapus` int(1) NOT NULL,
  `hak_akses` text NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.menu: ~11 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `link`, `is_active`, `is_parent`, `is_order`, `hapus`, `hak_akses`, `inputdate`, `updatedate`) VALUES
	(1, 'dashboard', 'dashboard', 1, 0, 1, 0, 'superadmin|maker|checker|signer', '2017-04-10 04:55:17', '2017-04-04 12:36:04'),
	(15, 'Management Menu', 'master_menu', 1, 59, 0, 0, 'superadmin', '2017-02-09 12:54:13', '2017-03-21 10:00:35'),
	(41, 'Hak Akses', 'master_hak_akses', 1, 59, 0, 0, 'superadmin', '2017-02-09 12:54:13', '2017-03-21 10:00:40'),
	(48, 'Data User', 'data_user', 1, 59, 0, 0, 'superadmin|signer', '2017-02-16 12:51:44', '2017-03-07 16:07:21'),
	(59, 'Config', '#', 1, 0, 4, 0, 'superadmin', '2018-01-12 16:37:09', '2017-04-04 12:37:47'),
	(60, 'PMS LAN', '#', 1, 0, 3, 0, 'superadmin|maker|checker|signer', '2018-01-12 16:37:09', '0000-00-00 00:00:00'),
	(61, 'tambah data', 'pms_lan/add', 1, 60, 0, 0, 'superadmin|maker|checker|signer', '2018-01-05 09:03:52', '0000-00-00 00:00:00'),
	(62, 'report data', 'pms_lan/index', 1, 60, 0, 0, 'superadmin|maker|checker|signer', '2018-01-05 09:53:48', '0000-00-00 00:00:00'),
	(63, 'Anggaran', '#', 1, 0, 2, 0, 'superadmin|maker|checker|signer', '2018-02-08 13:27:29', '0000-00-00 00:00:00'),
	(64, 'Data anggaran', 'anggaran', 1, 63, 0, 0, 'superadmin|maker|checker|signer', '2018-02-08 13:42:11', '0000-00-00 00:00:00'),
	(65, 'Data pemakaian anggaran', 'pakai_anggaran', 1, 63, 0, 0, 'superadmin|maker|checker|signer', '2018-02-08 13:42:19', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table inf_db.pakai_anggaran
CREATE TABLE IF NOT EXISTS `pakai_anggaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggaran` varchar(50) DEFAULT NULL,
  `kanwil_divisi` varchar(50) DEFAULT NULL,
  `kanca_bagian` varchar(50) DEFAULT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `judul_ip` varchar(50) DEFAULT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `link_surat` varchar(500) DEFAULT NULL,
  `keperluan` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.pakai_anggaran: ~2 rows (approximately)
/*!40000 ALTER TABLE `pakai_anggaran` DISABLE KEYS */;
INSERT INTO `pakai_anggaran` (`id`, `id_anggaran`, `kanwil_divisi`, `kanca_bagian`, `pengirim`, `judul_ip`, `nomor_surat`, `link_surat`, `keperluan`, `tanggal`, `nilai`) VALUES
	(7, '20180208201814155', 'l', 'l', 'l', 'll', 'l', 'http://localhost/portalinf/uploads/surat/2018-02-28-ijin_prinsip-11-06-33am-58277.pdf', 'l', '2018-02-28', 900),
	(8, '20180208201814155', 'j', 'j', 'j', 'jj', 'j', 'http://localhost/portalinf/uploads/surat/2018-02-28-ijin_prinsip-11-09-04am-23938.pdf', 'jj', '2018-02-28', 900),
	(9, '20180208201814155', '9', '9', '9', '9', '9', 'http://localhost/portalinf/uploads/surat/2018-03-01-ijin_prinsip-11-23-20am-61897.pdf', '9', '0000-00-00', 999);
/*!40000 ALTER TABLE `pakai_anggaran` ENABLE KEYS */;

-- Dumping structure for table inf_db.pms_lan
CREATE TABLE IF NOT EXISTS `pms_lan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kanwil_divisi` varchar(50) NOT NULL,
  `kanca_bagian` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `smu_no` varchar(50) NOT NULL,
  `smu_tgl` date NOT NULL,
  `smu_file` varchar(500) NOT NULL,
  `smu_status` varchar(50) NOT NULL,
  `sku_no` varchar(50) NOT NULL,
  `sku_tgl` date NOT NULL,
  `sku_file` varchar(500) NOT NULL,
  `sku_status` varchar(50) NOT NULL,
  `suk_no` varchar(50) NOT NULL,
  `suk_tgl` date NOT NULL,
  `suk_file` varchar(500) NOT NULL,
  `suk_status` varchar(50) NOT NULL,
  `ip_no` varchar(50) NOT NULL,
  `ip_tgl` date NOT NULL,
  `ip_file` varchar(500) NOT NULL,
  `ip_nilai` varchar(50) NOT NULL,
  `ip_status` varchar(50) NOT NULL,
  `sph_no` varchar(50) NOT NULL,
  `sph_tgl` date NOT NULL,
  `sph_file` varchar(500) NOT NULL,
  `sph_status` varchar(50) NOT NULL,
  `spk_no` varchar(50) NOT NULL,
  `spk_tgl` date NOT NULL,
  `spk_file` varchar(500) NOT NULL,
  `spk_nilai` varchar(50) NOT NULL,
  `spk_provider` varchar(50) NOT NULL,
  `spk_status` varchar(50) NOT NULL,
  `sik_no` varchar(50) NOT NULL,
  `sik_tgl` date NOT NULL,
  `sik_file` varchar(500) NOT NULL,
  `sik_status` varchar(50) NOT NULL,
  `bai_bri` varchar(50) NOT NULL,
  `bai_vendor` varchar(50) NOT NULL,
  `bai_tgl` date NOT NULL,
  `bai_ke_inf` varchar(50) NOT NULL,
  `bai_ke_provider` varchar(50) NOT NULL,
  `bai_status` varchar(50) NOT NULL,
  `bast_tgl` date NOT NULL,
  `bast_ttd` varchar(50) NOT NULL,
  `bast_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.pms_lan: ~1 rows (approximately)
/*!40000 ALTER TABLE `pms_lan` DISABLE KEYS */;
INSERT INTO `pms_lan` (`id`, `kanwil_divisi`, `kanca_bagian`, `jenis`, `smu_no`, `smu_tgl`, `smu_file`, `smu_status`, `sku_no`, `sku_tgl`, `sku_file`, `sku_status`, `suk_no`, `suk_tgl`, `suk_file`, `suk_status`, `ip_no`, `ip_tgl`, `ip_file`, `ip_nilai`, `ip_status`, `sph_no`, `sph_tgl`, `sph_file`, `sph_status`, `spk_no`, `spk_tgl`, `spk_file`, `spk_nilai`, `spk_provider`, `spk_status`, `sik_no`, `sik_tgl`, `sik_file`, `sik_status`, `bai_bri`, `bai_vendor`, `bai_tgl`, `bai_ke_inf`, `bai_ke_provider`, `bai_status`, `bast_tgl`, `bast_ttd`, `bast_status`) VALUES
	(11, 'OPT', 'INF', 'Relokasi Gedung Baru', '', '0000-00-00', '', '0', '', '0000-00-00', '', '0', '', '0000-00-00', '', '0', '', '0000-00-00', '', '', '0', '', '0000-00-00', '', '0', '', '0000-00-00', '', '', '', '0', '', '0000-00-00', '', '0', '', '', '0000-00-00', '', '', '0', '0000-00-00', '', '0');
/*!40000 ALTER TABLE `pms_lan` ENABLE KEYS */;

-- Dumping structure for table inf_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_pn` varchar(35) NOT NULL,
  `user_email` text NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_nohp` varchar(35) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_akses` varchar(35) NOT NULL,
  `user_aktif` varchar(35) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_pn` (`user_pn`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table inf_db.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `user_pn`, `user_email`, `user_nama`, `user_nohp`, `user_type`, `password`, `user_akses`, `user_aktif`, `inputdate`, `updatedate`) VALUES
	(1, 'administrator', 'adminosd@bri.co.id', 'admin', '12345', '1', 'aO9jJa9mOiyuFrPHirXSbjZMtFyGkSe4wc5ShfoLv_4', 'superadmin', '1', '2018-01-10 15:30:59', '2017-03-10 15:38:26'),
	(16, '00219372', 'fendygustap@gmail.com', 'Fendy Gusta Pradana', '085736330909', '1', 'QeR5RYzpMoiLNL9xiAPzm4xncH5e2-2v745XaGEh5Qk', 'checker', '1', '2018-01-10 15:31:05', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
special_reqrequestspecial_reqspecial_reqrequest