-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: info
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB-0ubuntu0.21.04.1

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
  `idAuthor` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idAuthor`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (0,'Non saisie'),(1,'Heu?reka'),(2,'Cyrille Borne'),(3,'Le Réveilleur'),(4,'Frédéric Delavier'),(5,'La chaine du Doc\''),(6,'Le Précepteur'),(7,'Bolchegeek'),(8,'Victor Ferry'),(9,'Thinkerview'),(10,'Julien Venesson'),(11,'Harry JMG'),(12,'Mos Majorum'),(13,'Fouloscopie'),(14,'La séance de Marty'),(21,'Yoonns avec deux N'),(22,'Juste Milieu.'),(23,'La Cartouche'),(24,'Major Mouvement'),(25,'Jean-Marc Jancovici');
/*!40000 ALTER TABLE `Author` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoryMedia`
--

LOCK TABLES `CategoryMedia` WRITE;
/*!40000 ALTER TABLE `CategoryMedia` DISABLE KEYS */;
INSERT INTO `CategoryMedia` VALUES (0,'Non saisie'),(1,'Blog'),(2,'Chaîne vidéo'),(3,'Vidéo'),(4,'Ouvrage'),(8,'Cours');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Field`
--

LOCK TABLES `Field` WRITE;
/*!40000 ALTER TABLE `Field` DISABLE KEYS */;
INSERT INTO `Field` VALUES (1,'Economie'),(2,'Alimentation'),(3,'Education'),(4,'Energie'),(5,'Musculation'),(6,'Rhétorique et language'),(7,'Sociologie'),(8,'Développement personnel'),(9,'Relation Homme/Femme'),(10,'Cinéma'),(14,'Psychologie'),(15,'Média'),(16,'Ecologie');
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
  `description` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `field` int(11) NOT NULL,
  `categoryMedia` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT 0,
  `insert_date` date NOT NULL DEFAULT '0000-00-00',
  `release_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idInformation`),
  KEY `fk_Information_1` (`field`),
  KEY `fk_Information_2` (`categoryMedia`),
  KEY `fk_Information_3_idx` (`author`),
  CONSTRAINT `fk_Information_1` FOREIGN KEY (`field`) REFERENCES `Field` (`idField`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Information_2` FOREIGN KEY (`categoryMedia`) REFERENCES `CategoryMedia` (`idCategoryMedia`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Information_3` FOREIGN KEY (`author`) REFERENCES `Author` (`idAuthor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information`
--

LOCK TABLES `Information` WRITE;
/*!40000 ALTER TABLE `Information` DISABLE KEYS */;
INSERT INTO `Information` VALUES (3,'L’agroalimentaire vu de l’intérieur – intoxication ?','https://www.youtube.com/watch?v=lXXp-PVQ0HQ',2,3,9,'2021-02-12','0000-00-00'),(4,'Si vous ne comprenez rien à la finance et à l\'économie','https://www.youtube.com/c/HeurekaFinanceEco/featured',1,2,1,'2021-02-12','0000-00-00'),(5,'Le blog de Cyrille Borne','https://cyrille-borne.com/',3,1,2,'2021-02-12','0000-00-00'),(6,'Environnement, d\'économie et du lien entre les deux','https://www.youtube.com/channel/UC1EacOJoqsKaYxaDomTCTEQ',4,2,3,'2021-02-12','0000-00-00'),(7,'La méthode Delavier – volume 1 et 2','http://www.methode-delavier.com/',5,4,4,'2021-02-12','0000-00-00'),(8,'Nutrition de la force','https://www.julienvenesson.fr/nutrition-de-la-force/',5,4,10,'2021-02-12','0000-00-00'),(9,'Un mélange dynamique de sport, de fitness et de conseils pour rester en bonne santé','https://www.youtube.com/channel/UCPZv08N85_20nB1VFstRqhg',5,2,5,'2021-02-12','0000-00-00'),(11,'Victor Ferry','https://www.youtube.com/channel/UCcueC-4NWGuPFQKzQWn5heA',6,2,8,'2021-02-12','0000-00-00'),(12,'Donner matière à pensée','https://www.youtube.com/c/LePr%C3%A9cepteurOfficiel/featured',7,2,6,'2021-02-12','0000-00-00'),(13,'Culture populaire (ciné, séries, jeux, littératures ou macramé) avec le couteau entre les dents','https://www.youtube.com/user/bolchegeek',7,2,7,'2021-02-12','0000-00-00'),(14,'Bernays – Comment manipuler l’opinion','https://www.youtube.com/watch?v=UvkhFpb7M7Y',7,3,6,'2021-02-12','0000-00-00'),(15,'Le contrat social – John Wick','https://www.youtube.com/watch?v=XXKnLJGq6sw',7,3,7,'2021-02-12','0000-00-00'),(17,'Ne pas maigrir malgré un déficité calorique ? (les pièges du total calorique et du régime)','https://www.youtube.com/watch?v=iHCnuGQcUmo&list=LL&index=2&t=14s',2,3,5,'2021-05-12','0000-00-00'),(18,'Ecart salarial : réponse à Heu?reka...','https://www.youtube.com/watch?v=Kd00wyflCFY&list=LL&index=4',9,3,12,'2021-05-12','0000-00-00'),(19,'Une expérience sociale avec 1200 abonnés','https://www.youtube.com/watch?v=ppSrAHoGwrI&list=LL&index=20&t=11s',7,3,13,'2021-05-12','0000-00-00'),(20,'Comprendre et se sortir du surendettement','https://www.youtube.com/watch?v=x9z65AZ9JuM&list=LL&index=22',1,3,1,'2021-05-12','0000-00-00'),(21,'Les leçons rhétoriques de Nietzsche','https://www.youtube.com/watch?v=WV34-7hpKLE&list=LL&index=23',6,3,8,'2021-05-12','0000-00-00'),(22,'L\'amputation de la miss Olympia Melissa Coates','https://www.youtube.com/watch?v=t7ignKx9UM8&list=LL&index=45',5,3,5,'2021-05-12','0000-00-00'),(23,'La Séance de Marty - Rétine et Pupille (Avec François Theurel)','https://www.youtube.com/watch?v=qPpHf9mMq6k&list=LL&index=55&t=419s',10,3,14,'2021-05-12','0000-00-00'),(24,'Zootopia est-il à côté de la plaque ? ','https://www.youtube.com/watch?v=NcShYK-MneM&list=LL&index=59',7,3,7,'2021-05-12','0000-00-00'),(25,'Sardoche passe par les 5 étapes du deuil après un permaban','https://www.youtube.com/watch?v=jOtz219T-BM',14,3,21,'2021-05-14','0000-00-00'),(26,'Nudge et coronavirus : la manipulation préférée de Macron ?','https://www.youtube.com/watch?v=8wC2njqNwn0',7,3,22,'2021-05-17','0000-00-00'),(27,'Ecriture abusive','https://www.youtube.com/watch?v=FViXADQb_k0',6,3,23,'2021-05-17','0000-00-00'),(28,'Propagande des médias pour Emmanuel Macron','https://www.youtube.com/watch?v=S72b_XF-Y88',15,3,22,'2021-05-24','0000-00-00'),(29,'Etirement et mobilité','https://www.youtube.com/watch?app=desktop&v=0Z9bT-gfw8Y',5,3,24,'2021-06-13','0000-00-00'),(30,'Peut-on encore sauver le climat ? avec Pascal Boniface','https://www.youtube.com/watch?v=3Pr577eUfTc',16,3,25,'2021-06-13','0000-00-00'),(31,'Présentation des prévisions de tempêrature pour les 100 prochaines années','https://www.youtube.com/watch?v=6Zg1mSPbVBg',16,3,25,'2021-06-13','0000-00-00'),(32,'Energie et changement climatique','https://jancovici.com/publications-et-co/cours-mines-paristech-2019/cours-mines-paris-tech-juin-2019',16,8,25,'2021-06-13','0000-00-00');
/*!40000 ALTER TABLE `Information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Information_tag`
--

DROP TABLE IF EXISTS `Information_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Information_tag` (
  `idInformation` int(11) NOT NULL,
  `idTag` int(11) NOT NULL,
  PRIMARY KEY (`idInformation`),
  KEY `fk_Information_tag_2_idx` (`idTag`),
  CONSTRAINT `fk_Information_tag_1` FOREIGN KEY (`idInformation`) REFERENCES `Information` (`idInformation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Information_tag_2` FOREIGN KEY (`idTag`) REFERENCES `Tag` (`idTag`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information_tag`
--

LOCK TABLES `Information_tag` WRITE;
/*!40000 ALTER TABLE `Information_tag` DISABLE KEYS */;
INSERT INTO `Information_tag` VALUES (9,1),(29,1);
/*!40000 ALTER TABLE `Information_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tag` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES (1,'Fitness');
/*!40000 ALTER TABLE `Tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-04 12:00:42
