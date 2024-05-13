-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: aplikasi
-- ------------------------------------------------------
-- Server version	5.7.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `isi` tinytext NOT NULL,
  `tgl_isi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guru`
--

LOCK TABLES `guru` WRITE;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` VALUES (1,'EKA','123456','JADKSAKJHASD','2021-04-02 22:20:53');
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (1,'X MIPA 1','IPA'),(2,'XI IPS 1','IPS'),(3,'XII BAHASA','BAHASA/SASTRA');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(8) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  KEY `petugas` (`id_petugas`),
  CONSTRAINT `petugas id` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (2,2,'2020112233','2021-03-30','maret','2019',300000),(3,1,'2020112233','2021-03-30','juni','2019',200000),(4,1,'2020112233','2022-03-30','maret','2022',400000),(5,1,'2020112233','2024-05-09','mei','2019',500000),(6,1,'2020112233','2024-05-13','januari','2019',500000);
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','siswa') NOT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES (1,'admin1','admin','April','admin'),(2,'petugas1','petugas','lia','petugas'),(3,'oalahbro','404notfound','oalahbro','petugas'),(7,'2020112233','ramdan','ramdan','siswa');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `nisn` varchar(11) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_tgl_lahir` varchar(45) NOT NULL,
  `tahun` varchar(45) NOT NULL,
  `nama_wali` varchar(35) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `pendidikan_terakhir` varchar(10) NOT NULL,
  `pekerjaan` varchar(15) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `pendapatan` int(9) NOT NULL,
  `asal_sekolah` varchar(15) NOT NULL,
  `tahun_lulus` int(4) NOT NULL,
  `kelas_sebelumnya` varchar(15) NOT NULL,
  `no_ijazah` varchar(25) NOT NULL,
  `dokumen` varchar(15) NOT NULL,
  PRIMARY KEY (`nisn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES ('0987123','12345','okeeeeeeeeeeeee',1,'sasfasdsdfa','L','madiun, 19.01.20','2022','oke','oke','oke','oke','1239172',10000000,'oke',2020,'xipa','791823hkjh1','sasdadasad'),('12345','12345','test',1,'sasfasdsdfa','L','madiun, 19.01.20','','oke','oke','oke','oke','1239172',10000000,'oke',2020,'xipa','791823hkjh1','sasdadasad'),('2020112233','18191010','Muhammad Ramdan',1,'Perumahan Padasuka blok c no.32','L','','0','','','','','089665412345',0,'',0,'','',''),('2020112234','18191011','Ahmad Setiawan',2,'Perumahan Giriharja blok g no.135','L','','0','','','','','087653998764',0,'',0,'','',''),('2020112235','18191012','Mira Helmalia',3,'Komplek Sumur bandung no.76','P','','0','','','','','081432567890',0,'',0,'','',''),('2020112236','181910123','Aisha Amira Devina',2,'Perumahan Alam Indah blok f no.211','P','','0','','','','','085677908443',0,'',0,'','',''),('2020112237','18191013','Muhamad Hendra',3,'Perumahan Padasuka blok a no.4','L','','0','','','','','082456334987',0,'',0,'','',''),('2020112238','18191014','tanti Dwi Putri',1,'Perumahan Mekar Mukti blok b no.43','P','','0','','','','','085222674908',0,'',0,'','','');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-14  0:16:22
