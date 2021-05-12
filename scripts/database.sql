-- MariaDB dump 10.19  Distrib 10.5.9-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: info
-- ------------------------------------------------------
-- Server version	10.5.9-MariaDB-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Author`
--

DROP TABLE IF EXISTS `Author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Author` (
  `idAutor` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `categoryAuthor` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idAutor`),
  KEY `fk_Autor_1_idx` (`categoryAuthor`),
  CONSTRAINT `fk_Author_1` FOREIGN KEY (`categoryAuthor`) REFERENCES `CategoryAuthor` (`idCategoryAuthor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (0,'Non saisie',0),(1,'Heu?reka',2),(2,'Cyrille Borne',1),(3,'Le Réveilleur',0),(4,'Frédéric Delavier',0),(5,'Le doc',3),(6,'Le Précepteur',0),(7,'Bolchegeek',2),(8,'Victor Ferry',4),(9,'Christophe Brusset',0),(10,'Julien Venesson',0);
/*!40000 ALTER TABLE `Author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CategoryAuthor`
--

DROP TABLE IF EXISTS `CategoryAuthor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CategoryAuthor` (
  `idCategoryAuthor` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoryAuthor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoryAuthor`
--

LOCK TABLES `CategoryAuthor` WRITE;
/*!40000 ALTER TABLE `CategoryAuthor` DISABLE KEYS */;
INSERT INTO `CategoryAuthor` VALUES (0,'Non saisie'),(1,'Bloggeur'),(2,'Vidéaste'),(3,'Docteur en médecine'),(4,'Docteur en rhétorique');
/*!40000 ALTER TABLE `CategoryAuthor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CategoryMedia`
--

DROP TABLE IF EXISTS `CategoryMedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CategoryMedia` (
  `idCategoryMedia` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategoryMedia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoryMedia`
--

LOCK TABLES `CategoryMedia` WRITE;
/*!40000 ALTER TABLE `CategoryMedia` DISABLE KEYS */;
INSERT INTO `CategoryMedia` VALUES (0,'Non saisie'),(1,'Blog'),(2,'Chaîne vidéo'),(3,'Vidéo'),(4,'Ouvrage');
/*!40000 ALTER TABLE `CategoryMedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Field`
--

DROP TABLE IF EXISTS `Field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Field` (
  `idField` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`idField`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Field`
--

LOCK TABLES `Field` WRITE;
/*!40000 ALTER TABLE `Field` DISABLE KEYS */;
INSERT INTO `Field` VALUES (1,'Economie'),(2,'Alimentation'),(3,'Education'),(4,'Energie'),(5,'Musculation'),(6,'Rhétorique'),(7,'Sociologie');
/*!40000 ALTER TABLE `Field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Information`
--

DROP TABLE IF EXISTS `Information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Information` (
  `idInformation` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(90) NOT NULL,
  `link` varchar(90) NOT NULL,
  `field` int(11) NOT NULL,
  `categoryMedia` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT 0,
  `date_ajout` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idInformation`),
  KEY `fk_Information_1` (`field`),
  KEY `fk_Information_2` (`categoryMedia`),
  KEY `fk_Information_4_idx` (`author`),
  CONSTRAINT `` FOREIGN KEY (`author`) REFERENCES `Author` (`idAutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Information_1` FOREIGN KEY (`field`) REFERENCES `Field` (`idField`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Information_2` FOREIGN KEY (`categoryMedia`) REFERENCES `CategoryMedia` (`idCategoryMedia`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Information_4` FOREIGN KEY (`author`) REFERENCES `Author` (`idAutor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information`
--

LOCK TABLES `Information` WRITE;
/*!40000 ALTER TABLE `Information` DISABLE KEYS */;
INSERT INTO `Information` VALUES (3,'L’agroalimentaire vu de l’intérieur – intoxication ?','https://www.youtube.com/watch?v=lXXp-PVQ0HQ',2,3,9,'0000-00-00'),(4,'Heu?reka','https://www.youtube.com/c/HeurekaFinanceEco/featured',1,2,1,'0000-00-00'),(5,'Le blog de Cyrille Borne','https://cyrille-borne.com/',3,1,2,'0000-00-00'),(6,'Le Réveilleur','https://www.youtube.com/channel/UC1EacOJoqsKaYxaDomTCTEQ',4,2,3,'0000-00-00'),(7,'La méthode Delavier – volume 1 et 2','http://www.methode-delavier.com/',5,4,4,'0000-00-00'),(8,'Nutrition de la force','https://www.julienvenesson.fr/nutrition-de-la-force/',5,4,10,'0000-00-00'),(9,'La chaine du Doc\'','https://www.youtube.com/channel/UCPZv08N85_20nB1VFstRqhg',5,2,5,'0000-00-00'),(11,'Victor Ferry','https://www.youtube.com/channel/UCcueC-4NWGuPFQKzQWn5heA',6,2,8,'0000-00-00'),(12,'Le Précepteur','https://www.youtube.com/c/LePr%C3%A9cepteurOfficiel/featured',7,2,6,'0000-00-00'),(13,'Bolchegeek','https://www.youtube.com/user/bolchegeek',7,2,7,'0000-00-00'),(14,'Bernays – Comment manipuler l’opinion','https://www.youtube.com/watch?v=UvkhFpb7M7Y',7,3,0,'0000-00-00'),(15,'Le contrat social – John Wick','https://www.youtube.com/watch?v=XXKnLJGq6sw',7,3,0,'0000-00-00');
/*!40000 ALTER TABLE `Information` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-12 12:14:58
