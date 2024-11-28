CREATE DATABASE  IF NOT EXISTS `db` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `db`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `angajat_neangajat`
--

DROP TABLE IF EXISTS `angajat_neangajat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `angajat_neangajat` (
  `ID_Persoana` int(11) NOT NULL,
  `Statut` enum('Angajat','Neangajat') DEFAULT NULL,
  `Companie` varchar(100) DEFAULT NULL,
  `Pozitie` varchar(100) DEFAULT NULL,
  `Salariu` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID_Persoana`),
  CONSTRAINT `angajat_neangajat_ibfk_1` FOREIGN KEY (`ID_Persoana`) REFERENCES `persoane` (`ID_Persoana`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `angajat_neangajat`
--

LOCK TABLES `angajat_neangajat` WRITE;
/*!40000 ALTER TABLE `angajat_neangajat` DISABLE KEYS */;
INSERT INTO `angajat_neangajat` VALUES (26,'Angajat','Google','Inginer Software',9500.00),(27,'Angajat','Microsoft','Designer UX/UI',8500.00),(28,'Angajat','Amazon','Manager Proiect',10500.00),(29,'Angajat','Apple','Director Marketing',12000.00),(30,'Neangajat',NULL,NULL,NULL),(31,'Angajat','Facebook','Analyst Financiar',9000.00),(34,'Neangajat',NULL,NULL,NULL),(36,'Angajat','Tesla','Inginer Mecanic',10000.00),(37,'Angajat','SpaceX','Astronaut',15000.00),(38,'Angajat','Netflix','Regizor Film',11000.00),(39,'Neangajat',NULL,NULL,NULL),(40,'Angajat','Twitter','Developer Web',9200.00),(41,'Neangajat',NULL,NULL,NULL),(43,'Angajat','Sony','Designer Grafic',8800.00),(44,'Angajat','Samsung','Inginer Hardware',9600.00),(45,'Angajat','IBM','Consultant IT',9300.00),(46,'Angajat','Intel','Manager HR',11000.00),(61,'Angajat','','shop ass',0.00),(63,'Angajat','AFI','shop ass',0.00),(64,'Neangajat','','',0.00);
/*!40000 ALTER TABLE `angajat_neangajat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buletin`
--

DROP TABLE IF EXISTS `buletin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buletin` (
  `ID_Buletin` int(11) NOT NULL AUTO_INCREMENT,
  `Numar_Buletin` varchar(20) DEFAULT NULL,
  `ID_Persoana` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Buletin`),
  UNIQUE KEY `ID_Persoana` (`ID_Persoana`),
  CONSTRAINT `buletin_ibfk_1` FOREIGN KEY (`ID_Persoana`) REFERENCES `persoane` (`ID_Persoana`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buletin`
--

LOCK TABLES `buletin` WRITE;
/*!40000 ALTER TABLE `buletin` DISABLE KEYS */;
INSERT INTO `buletin` VALUES (1,'123456',24),(2,'234567',25),(3,'345678',26),(4,'456789',27),(5,'567890',28),(6,'678901',29),(7,'789012',30),(8,'890123',31),(9,'901234',32),(10,'012345',33),(11,'123456',34),(12,'234567',35),(13,'345678',36),(14,'456789',37),(15,'567890',38),(16,'678901',39),(17,'789012',40),(18,'890123',41),(19,'901234',42),(20,'012345',43),(21,'123456',44),(22,'234567',45),(23,'345678',46),(24,'456789',53),(25,'567890',54),(26,'678901',55),(27,'789012',56),(28,'890123',57),(29,'901234',58);
/*!40000 ALTER TABLE `buletin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `continente`
--

DROP TABLE IF EXISTS `continente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `continente` (
  `ID_Continent` int(11) NOT NULL AUTO_INCREMENT,
  `Nume_Continent` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Continent`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `continente`
--

LOCK TABLES `continente` WRITE;
/*!40000 ALTER TABLE `continente` DISABLE KEYS */;
INSERT INTO `continente` VALUES (1,'Africa'),(2,'America de Nord'),(3,'America de Sud'),(4,'Antarctica'),(5,'Asia'),(6,'Australia'),(7,'Europa');
/*!40000 ALTER TABLE `continente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elev_student`
--

DROP TABLE IF EXISTS `elev_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elev_student` (
  `ID_Persoana` int(11) NOT NULL,
  `Universitate` varchar(100) DEFAULT NULL,
  `Program_Studii` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Persoana`),
  CONSTRAINT `elev_student_ibfk_1` FOREIGN KEY (`ID_Persoana`) REFERENCES `persoane` (`ID_Persoana`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elev_student`
--

LOCK TABLES `elev_student` WRITE;
/*!40000 ALTER TABLE `elev_student` DISABLE KEYS */;
INSERT INTO `elev_student` VALUES (24,'Universitatea Oxford','Stiinte Politice'),(25,'Harvard University','Literatura Engleza'),(32,'Universitatea Harvard','Muzica'),(33,'Stanford University','Inginerie Electrica'),(35,'Universitatea Cambridge','Economie'),(42,'Universitatea Columbia','Medicina'),(61,'UPG','Litere si stinte'),(63,'UPG','Litere si stinte'),(64,'UPG','Litere si stinte');
/*!40000 ALTER TABLE `elev_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oceane_mari_ape`
--

DROP TABLE IF EXISTS `oceane_mari_ape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oceane_mari_ape` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(255) NOT NULL,
  `Adancime_Maxima` varchar(50) NOT NULL,
  `Suprafata` varchar(50) NOT NULL,
  `Id_Tara` int(11) DEFAULT NULL,
  `Clima` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Id_Tara` (`Id_Tara`),
  CONSTRAINT `oceane_mari_ape_ibfk_1` FOREIGN KEY (`Id_Tara`) REFERENCES `tari` (`ID_Tara`),
  CONSTRAINT `oceane_mari_ape_ibfk_2` FOREIGN KEY (`Id_Tara`) REFERENCES `tari` (`ID_Tara`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oceane_mari_ape`
--

LOCK TABLES `oceane_mari_ape` WRITE;
/*!40000 ALTER TABLE `oceane_mari_ape` DISABLE KEYS */;
INSERT INTO `oceane_mari_ape` VALUES (1,'Nil','6800 m','4132 km patrati',1,'Tropical'),(2,'Niger','50 m','420 km patrati',2,'Tropical'),(3,'Orange','220 m','2200 km patrati',3,'Temperat'),(4,'Tana','25 m','1000 km patrati',4,'Tropical'),(5,'Mediterranean','5267 m','2500 km patrati',5,'Temperat'),(6,'Atlantic','8484 m','106460000 km patrati',6,'Diversificat'),(7,'Atlantic','8484 m','106460000 km patrati',9,'Diversificat'),(8,'Arctic','5527 m','14056000 km patrati',10,'Polar'),(9,'Pacific','10994 m','168723000 km patrati',43,'Diversificat'),(10,'Marea Neagra','2212 m','436000 km patrati',55,'Temperat');
/*!40000 ALTER TABLE `oceane_mari_ape` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orase`
--

DROP TABLE IF EXISTS `orase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orase` (
  `ID_Oras` int(11) NOT NULL AUTO_INCREMENT,
  `Nume_Oras` varchar(255) NOT NULL,
  `ID_Tara` int(11) DEFAULT NULL,
  `Populatie` int(11) DEFAULT NULL,
  `Suprafata` varchar(50) DEFAULT NULL,
  `Atractii_Turistice` text DEFAULT NULL,
  PRIMARY KEY (`ID_Oras`),
  KEY `ID_Tara` (`ID_Tara`),
  CONSTRAINT `orase_ibfk_1` FOREIGN KEY (`ID_Tara`) REFERENCES `tari` (`ID_Tara`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orase`
--

LOCK TABLES `orase` WRITE;
/*!40000 ALTER TABLE `orase` DISABLE KEYS */;
INSERT INTO `orase` VALUES (1,'Cairo',1,9900000,'606 km patrati','Piramida lui Giza, Muzeul Egiptean'),(2,'Abuja',2,1235880,'1765 km patrati','Complexul Monumental Nigerian'),(3,'Pretoria',3,741651,'1626 km patrati','Voortrekker Monument, National Zoological Gardens'),(4,'Nairobi',4,4397073,'696 km patrati','Parcul National Nairobi, Mamba Village'),(5,'Rabat',5,577827,'117 km patrati','Medina of Rabat, Royal Palace of Rabat'),(6,'Washington, D.C.',6,705749,'177 km patrati','Casa Alba, Capitoliul Statelor Unite'),(7,'Ottawa',7,934243,'2778 km patrati','Parliament Hill, Muzeul de Istorie a Civilizatiei'),(8,'Ciudad de Mexico',8,9209944,'1485 km patrati','Zocalo, Muzeul National de Antropologie'),(9,'Havana',9,2145482,'728 km patrati','Plaza Vieja, Catedrala Havana'),(10,'Nuuk',10,17402,'586 km patrati','Centrul Cultural Katuaq, Fjordul Nuuk'),(11,'Brasilia',31,305427,'5800 km patrati','Catedrala Metropolitana Nossa Senhora Aparecida'),(12,'Buenos Aires',32,2890151,'203 km patrati','Teatro Colon, Obelisco'),(13,'Lima',33,9827825,'2672 km patrati','Plaza de Armas, Parcul Kennedy'),(14,'Bogota',34,7179961,'1595 km patrati','Plaza Bolivar, Catedrala Primada'),(15,'Santiago',35,5206093,'641 km patrati','Plaza de Armas, Cerro San Cristobal'),(16,'Wellington',36,418500,'290 km patrati','Te Papa Tongarewa, Mt. Victoria'),(17,'Canberra',37,431263,'814 km patrati','Parliament House, National Gallery of Australia'),(18,'Beijing',41,21707000,'16410 km patrati','Cetatea Interzisa, Marele Zid Chinezesc'),(19,'New Delhi',42,30236325,'1484 km patrati','Poarta India, Taj Mahal'),(20,'Tokyo',43,13929286,'2187 km patrati','Turnul Tokyo, Senso-ji'),(21,'Moscow',44,12506468,'2511 km patrati','Piata Rosie, Catedrala Sf. Vasile'),(22,'Jakarta',45,10770487,'662 km patrati','Monas, Taman Mini Indonesia Indah'),(23,'Canberra',46,424544,'814 km patrati','Opera House, Sydney Harbour Bridge'),(24,'Wellington',47,418500,'290 km patrati','Te Papa Tongarewa, Mt. Victoria'),(25,'Jakarta',48,10770487,'662 km patrati','Monas, Taman Mini Indonesia Indah'),(26,'Port Moresby',49,387500,'240 km patrati','National Orchid Garden, Parliament House'),(27,'Suva',50,883483,'185 km patrati','Suva Municipal Market, Colo-i-Suva Forest Reserve'),(28,'Paris',51,2140526,'105 km patrati','Turnul Eiffel, Louvre'),(29,'Berlin',52,3419629,'891 km patrati','Poarta Brandenburg, Checkpoint Charlie'),(30,'Bucuresti',NULL,222222,'22222','palatul parlamentului');
/*!40000 ALTER TABLE `orase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persoane`
--

DROP TABLE IF EXISTS `persoane`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persoane` (
  `ID_Persoana` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(255) DEFAULT NULL,
  `Data_Nastere` date DEFAULT NULL,
  `OrasActual` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Persoana`),
  KEY `OrasActual` (`OrasActual`),
  CONSTRAINT `persoane_ibfk_1` FOREIGN KEY (`OrasActual`) REFERENCES `orase` (`ID_Oras`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persoane`
--

LOCK TABLES `persoane` WRITE;
/*!40000 ALTER TABLE `persoane` DISABLE KEYS */;
INSERT INTO `persoane` VALUES (24,'Mohamed Salah','1992-06-15',1),(25,'Chimamanda Ngozi Adichie','1977-09-15',2),(26,'Charlize Theron','1975-08-07',3),(27,'Lupita Nyongo','1983-03-01',4),(28,'Gad Elmaleh','1971-04-19',5),(29,'Barack Obama','1961-08-04',6),(30,'Justin Trudeau','1971-12-25',7),(31,'Salma Hayek','1966-09-02',8),(32,'Celia Cruz','1925-10-21',9),(33,'Nielsine Nive','1978-08-18',10),(34,'Pele','1940-10-23',11),(35,'Lionel Messi','1987-06-24',12),(36,'Mario Vargas Llosa','1936-03-28',13),(37,'Shakira','1977-02-02',14),(38,'Isabel Allende','1942-08-02',15),(39,'Peter Jackson','1961-10-31',16),(40,'Hugh Jackman','1968-10-12',17),(41,'Jackie Chan','1954-04-07',18),(42,'Priyanka Chopra','1982-07-18',19),(43,'Haruki Murakami','1949-01-12',20),(44,'Vladimir Putin','1952-10-07',21),(45,'Agnez Mo','1986-07-01',22),(46,'Nicole Kidman','1967-06-20',23),(53,'Peter Jackson','1961-10-31',24),(54,'Susilo Bambang Yudhoyono','1949-09-09',25),(55,'Michael Somare','1936-04-09',26),(56,'Ratu Sir Kamisese Mara','1920-05-06',27),(57,'Brigitte Macron','1953-04-13',28),(58,'Angela Merkel','1954-07-17',29),(61,'Pavel Adrian','2001-03-27',12),(63,'Pavel Adrian','2001-03-26',13),(64,'Denisa','2007-07-25',30);
/*!40000 ALTER TABLE `persoane` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tari`
--

DROP TABLE IF EXISTS `tari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tari` (
  `ID_Tara` int(11) NOT NULL AUTO_INCREMENT,
  `Nume_Tara` varchar(255) NOT NULL,
  `ID_Continent` int(11) DEFAULT NULL,
  `Dimensiune` varchar(50) DEFAULT NULL,
  `Climat` varchar(50) DEFAULT NULL,
  `Temperatura_Medie` decimal(5,2) DEFAULT NULL,
  `Populatie_Totala` int(11) DEFAULT NULL,
  `ape` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Tara`),
  KEY `ID_Continent` (`ID_Continent`),
  CONSTRAINT `tari_ibfk_1` FOREIGN KEY (`ID_Continent`) REFERENCES `continente` (`ID_Continent`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tari`
--

LOCK TABLES `tari` WRITE;
/*!40000 ALTER TABLE `tari` DISABLE KEYS */;
INSERT INTO `tari` VALUES (1,'Egipt',1,'1000000 km patrati','Desertic',25.00,100000000,'Nil'),(2,'Nigeria',1,'923768 km patrati','Tropical',27.50,200000000,'Niger'),(3,'Africa de Sud',1,'1219090 km patrati','Savanna',22.00,60000000,'Orange'),(4,'Kenya',1,'580367 km patrati','Tropical',24.00,53771300,'Tana'),(5,'Maroc',1,'446550 km patrati','Mediterranean',21.00,36000000,'Mediterranean'),(6,'Statele Unite',2,'9833517 km patrati','Diversificat',12.00,331002651,'Atlantic'),(7,'Canada',2,'9976140 km patrati','Temperat',7.00,37742154,NULL),(8,'Mexic',2,'1964375 km patrati','Desertic',24.00,128932753,NULL),(9,'Cuba',2,'109884 km patrati','Tropical',25.00,11326616,'Atlantic'),(10,'Groenlanda',2,'2166086 km patrati','Arctic',-20.00,56770,'Arctic'),(31,'Brazilia',3,'8515767 km patrati','Tropical',24.00,209288278,NULL),(32,'Argentina',3,'2780400 km patrati','Temperat',18.00,45195777,NULL),(33,'Peru',3,'1285216 km patrati','Montan',20.00,32971854,NULL),(34,'Colombia',3,'1141748 km patrati','Tropical',25.00,50882891,NULL),(35,'Chile',3,'756102 km patrati','Dezertic',11.00,19116201,NULL),(36,'McMurdo Station (SUA)',4,'0.77 milioane km patrati','Polar',-20.00,1200,NULL),(37,'Base General Bernardo O\'Higgins (Chile)',4,'0.004 km patrati','Polar',-10.00,200,NULL),(38,'Base Rothera (Marea Britanie)',4,'0.006 km patrati','Polar',-15.00,130,NULL),(39,'Dome Fuji (Japonia)',4,'0.0001 km patrati','Polar',-40.00,30,NULL),(40,'Scott Base (Noua Zeelanda)',4,'0.007 km patrati','Polar',-25.00,100,NULL),(41,'China',5,'9596961 km patrati','Diversificat',15.00,1404328611,NULL),(42,'India',5,'3287263 km patrati','Diversificat',25.00,1380004385,NULL),(43,'Japonia',5,'377975 km patrati','Temperat',17.00,126476461,'Pacific'),(44,'Rusia',5,'17098242 km patrati','Diversificat',-5.00,145912025,NULL),(45,'Indonezia',5,'1910931 km patrati','Tropical',26.00,273523615,NULL),(46,'Australia',6,'7692024 km patrati','Diversificat',22.00,25499884,NULL),(47,'Noua Zeelanda',6,'268021 km patrati','Temperat',16.00,4822233,NULL),(48,'Indonezia',6,'1910931 km patrati','Tropical',26.00,273523615,NULL),(49,'Papua Noua Guinee',6,'462840 km patrati','Tropical',25.00,8935000,NULL),(50,'Fiji',6,'18274 km patrati','Tropical',25.00,896445,NULL),(51,'Franta',7,'551695 km patrati','Temperat',12.00,67364357,NULL),(52,'Germania',7,'357022 km patrati','Temperat',10.00,83783942,NULL),(53,'Italia',7,'301340 km patrati','Temperat',15.00,60461826,NULL),(54,'Spania',7,'505990 km patrati','Temperat',18.00,47329981,NULL),(55,'Romania',7,'238397 km patrati','Temperat',11.00,19237691,'Marea Neagra');
/*!40000 ALTER TABLE `tari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tari_ape`
--

DROP TABLE IF EXISTS `tari_ape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tari_ape` (
  `ID_Tara` int(11) DEFAULT NULL,
  `ID_Apa` int(11) DEFAULT NULL,
  KEY `ID_Tara` (`ID_Tara`),
  KEY `ID_Apa` (`ID_Apa`),
  CONSTRAINT `tari_ape_ibfk_1` FOREIGN KEY (`ID_Tara`) REFERENCES `tari` (`ID_Tara`),
  CONSTRAINT `tari_ape_ibfk_2` FOREIGN KEY (`ID_Apa`) REFERENCES `oceane_mari_ape` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tari_ape`
--

LOCK TABLES `tari_ape` WRITE;
/*!40000 ALTER TABLE `tari_ape` DISABLE KEYS */;
INSERT INTO `tari_ape` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(9,7),(10,8),(43,9),(55,10);
/*!40000 ALTER TABLE `tari_ape` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-28 13:47:00
