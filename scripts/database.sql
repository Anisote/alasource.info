-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: info
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0ubuntu0.21.04.1

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
  `name` varchar(90) NOT NULL,
  PRIMARY KEY (`idAuthor`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (0,'Non saisie'),(1,'Heu?reka'),(2,'Cyrille Borne'),(3,'Le Réveilleur'),(4,'Frédéric Delavier'),(5,'La chaine du Doc\''),(6,'Le Précepteur'),(7,'Bolchegeek'),(8,'Victor Ferry'),(9,'Thinkerview'),(10,'Julien Venesson'),(11,'Harry JMG'),(12,'Mos Majorum'),(13,'Fouloscopie'),(14,'La séance de Marty'),(21,'Yoonns avec deux N'),(22,'Juste Milieu.'),(23,'La Cartouche'),(24,'Major Mouvement'),(25,'Jean-Marc Jancovici'),(26,'Wonderfall'),(27,'Commission nationale de l\'informatique et des libertés - CNIL'),(28,'Mark Manson'),(33,'Calmos'),(34,'Horizon-gull'),(36,'Anthony Robbins'),(37,'Stephen R. Covey'),(38,'Leo Babauta'),(39,'Robert C. Martin'),(40,'Cal Newport'),(41,'Mihaly Csikszentmihaly'),(42,'Dale Carnegie'),(43,'Jean-Claude Abric'),(44,'Sun Tzu'),(45,'Marketing Mania'),(46,'Nicolas Caron'),(47,'Timothy Ferriss'),(48,'Platon'),(49,'Sénèque'),(50,'Friedrich W. Nietzsche'),(51,'Rollo Tomassi'),(52,'Groupe d\'experts intergouvernemental sur l\'évolution du climat - GIEC'),(53,'Hacking Social'),(56,'Andrew Tanenbaum'),(57,'David Wetherall'),(58,'Laurence Eunfalt'),(59,'Stéphanie Bujon'),(60,'Jim Loehr'),(61,'Tony Schwartz'),(62,'Laurent Bloch'),(63,'Christophe Wolfhugel'),(67,'Arnaud Souillé'),(68,'Ary Kokos'),(69,'Gérôme Billois'),(70,'Alexandre Anzala-Yamajako'),(71,'Thomas Debize'),(72,'Ginette Matinot');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoryMedia`
--

LOCK TABLES `CategoryMedia` WRITE;
/*!40000 ALTER TABLE `CategoryMedia` DISABLE KEYS */;
INSERT INTO `CategoryMedia` VALUES (0,'Non saisie'),(1,'🌐 Blog'),(2,'📹 Chaîne vidéo'),(3,'📀 Vidéo'),(4,'🕮 Ouvrage'),(8,'📖 Cours'),(9,'📁 Dossier');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Field`
--

LOCK TABLES `Field` WRITE;
/*!40000 ALTER TABLE `Field` DISABLE KEYS */;
INSERT INTO `Field` VALUES (1,'💶 Economie'),(2,'🍲 Alimentation'),(3,'🏫 Education'),(4,'⚡ Energie'),(5,'💪 Musculation'),(6,'🗪 Rhétorique et language'),(7,'🧑‍🤝‍🧑 Sociologie'),(8,'🙋‍♂️ Développement personnel'),(9,'♂♀ Relation Homme/Femme'),(10,'🎥 Cinéma'),(14,'💭 Psychologie'),(15,'📰 Média'),(16,'🌳 Ecologie'),(17,'📡 Technologie'),(18,'🔒 Vie privée'),(19,'💻 Informatique'),(20,'⚔️ Guerre'),(21,'🤩 Marketing');
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
  `link` varchar(150) DEFAULT NULL,
  `field` int(11) NOT NULL,
  `categoryMedia` int(11) NOT NULL,
  `insert_date` date NOT NULL DEFAULT '0000-00-00',
  `release_date` date NOT NULL DEFAULT '0000-00-00',
  `indexDisplayed` int(11) NOT NULL,
  `mark` int(1) NOT NULL,
  PRIMARY KEY (`idInformation`),
  KEY `fk_Information_2` (`categoryMedia`),
  KEY `fk_Information_4` (`field`),
  CONSTRAINT `fk_Information_2` FOREIGN KEY (`categoryMedia`) REFERENCES `CategoryMedia` (`idCategoryMedia`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Information_4` FOREIGN KEY (`field`) REFERENCES `Tag` (`idTag`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information`
--

LOCK TABLES `Information` WRITE;
/*!40000 ALTER TABLE `Information` DISABLE KEYS */;
INSERT INTO `Information` VALUES (3,'L’agroalimentaire vu de l’intérieur – intoxication ?','https://www.youtube.com/watch?v=lXXp-PVQ0HQ',44,3,'2021-02-12','2019-11-07',1,3),(4,'Si vous ne comprenez rien à la finance et à l\'économie','https://www.youtube.com/c/HeurekaFinanceEco/featured',43,2,'2021-02-12','2015-10-18',2,4),(5,'Le blog de Cyrille Borne','https://cyrille-borne.com/',45,1,'2021-02-12','2021-05-06',3,2),(6,'Environnement, économie et du lien entre les deux','https://www.youtube.com/channel/UC1EacOJoqsKaYxaDomTCTEQ',46,2,'2021-02-12','2015-03-31',4,3),(7,'La méthode Delavier de musculation - volume 1','http://www.methode-delavier.com/',47,4,'2021-02-12','2009-09-15',5,3),(8,'Nutrition de la force','https://www.julienvenesson.fr/nutrition-de-la-force/',47,4,'2021-02-12','2011-07-07',6,2),(9,'Un mélange dynamique de sport, de fitness et de conseils pour rester en bonne santé','https://www.youtube.com/channel/UCPZv08N85_20nB1VFstRqhg',47,2,'2021-02-12','2020-01-26',7,3),(11,'Outils rhétoriques, analyses de discours et lectures d\'ouvrages','https://www.youtube.com/channel/UCcueC-4NWGuPFQKzQWn5heA',48,2,'2021-02-12','2013-07-19',8,2),(12,'Donner matière à pensée','https://www.youtube.com/c/LePr%C3%A9cepteurOfficiel/featured',49,2,'2021-02-12','2017-11-13',9,3),(13,'Culture populaire (ciné, séries, jeux, littératures ou macramé) avec le couteau entre les dents','https://www.youtube.com/user/bolchegeek',49,2,'2021-02-12','2013-09-14',10,4),(14,'Bernays – Comment manipuler l’opinion','https://www.youtube.com/watch?v=UvkhFpb7M7Y',49,3,'2021-02-12','2020-09-23',11,3),(15,'Le contrat social – John Wick','https://www.youtube.com/watch?v=XXKnLJGq6sw',49,3,'2021-02-12','2020-07-15',12,3),(17,'Ne pas maigrir malgré un déficité calorique ? (les pièges du total calorique et du régime)','https://www.youtube.com/watch?v=iHCnuGQcUmo&list=LL&index=2&t=14s',44,3,'2021-05-12','2021-05-09',13,2),(18,'Ecart salarial : réponse à Heu?reka...','https://www.youtube.com/watch?v=Kd00wyflCFY&list=LL&index=4',51,3,'2021-05-12','2021-04-29',14,3),(19,'Une expérience sociale avec 1200 abonnés','https://www.youtube.com/watch?v=ppSrAHoGwrI&list=LL&index=20&t=11s',49,3,'2021-05-12','2021-02-10',15,3),(20,'Comprendre et se sortir du surendettement','https://www.youtube.com/watch?v=x9z65AZ9JuM&list=LL&index=22',43,3,'2021-05-12','2020-07-10',16,3),(21,'Les leçons rhétoriques de Nietzsche','https://www.youtube.com/watch?v=WV34-7hpKLE&list=LL&index=23',48,3,'2021-05-12','2021-02-07',17,3),(22,'L\'amputation de la miss Olympia Melissa Coates','https://www.youtube.com/watch?v=t7ignKx9UM8&list=LL&index=45',47,3,'2021-05-12','2020-11-22',18,1),(23,'La Séance de Marty - Rétine et Pupille (Avec François Theurel)','https://www.youtube.com/watch?v=qPpHf9mMq6k&list=LL&index=55&t=419s',52,3,'2021-05-12','2020-09-26',19,4),(24,'Zootopia est-il à côté de la plaque ? ','https://www.youtube.com/watch?v=NcShYK-MneM&list=LL&index=59',49,3,'2021-05-12','2017-01-13',20,3),(25,'Sardoche passe par les 5 étapes du deuil après un permaban','https://www.youtube.com/watch?v=jOtz219T-BM',53,3,'2021-05-14','2019-09-05',21,1),(26,'Nudge et coronavirus : la manipulation préférée de Macron ?','https://www.youtube.com/watch?v=8wC2njqNwn0',49,3,'2021-05-17','2021-05-16',22,2),(27,'Ecriture abusive','https://www.youtube.com/watch?v=FViXADQb_k0',48,3,'2021-05-17','2021-05-13',23,2),(28,'Propagande des médias pour Emmanuel Macron','https://www.youtube.com/watch?v=S72b_XF-Y88',54,3,'2021-05-24','2021-03-30',24,2),(29,'Etirement et mobilité','https://www.youtube.com/watch?app=desktop&v=0Z9bT-gfw8Y',47,3,'2021-06-13','2021-06-13',25,2),(30,'Peut-on encore sauver le climat ? avec Pascal Boniface','https://www.youtube.com/watch?v=3Pr577eUfTc',55,3,'2021-06-13','2021-03-24',26,2),(31,'Présentation des prévisions de tempêrature pour les 100 prochaines années','https://www.youtube.com/watch?v=6Zg1mSPbVBg',55,3,'2021-06-13','2020-11-23',27,3),(32,'Energie et changement climatique','https://jancovici.com/publications-et-co/cours-mines-paristech-2019/cours-mines-paris-tech-juin-2019',55,8,'2021-06-13','2019-06-01',28,3),(33,'Graphene OS - système d\'exploitation pour téléphone','https://wonderfall.space/grapheneos-2021/',56,1,'2021-07-17','2021-05-27',29,2),(34,'Prospective sur la vie privée en 2030','https://linc.cnil.fr/sites/default/files/atoms/files/linc_proteger_la_vie_privee_en_2030_-_une_exploration_prospective_et_speculative.pdf',57,9,'2021-07-17','2021-01-01',30,2),(35,'Conseil en relation de couple par plus de 1500 couples heureux','https://markmanson.net/relationship-advice',51,1,'2021-07-17','2019-10-08',31,4),(37,'La mobilité est elle meilleure que les étirements ?','https://www.youtube.com/watch?v=0Z9bT-gfw8Y',47,3,'2021-08-11','2021-06-13',32,2),(38,'Analyse et decryptage de vidéos et films comiques','https://www.youtube.com/channel/UCYBr8enT5x4-JIxcPY6y-_A',52,2,'2021-08-11','2017-01-06',33,3),(39,'Comment pouvons-nous tous être totalitaire ? - 1','https://www.youtube.com/watch?v=2__Dd_KXuuU',49,3,'2021-08-11','2021-01-03',34,3),(40,'Comment pouvons-nous tous être totalitaire ? - 2','https://www.youtube.com/watch?v=o2DEESuEOJk',49,3,'2021-08-11','2021-07-04',35,3),(41,'Pouvoir illimité','',50,4,'2021-08-16','1986-01-01',36,4),(42,'Priorité aux priorités','',50,4,'2021-08-16','1985-08-29',37,2),(43,'L\'art d\'aller à l\'essentiel','',50,4,'2021-08-16','2012-03-16',38,3),(45,'Coder proprement','',58,4,'2021-08-16','2008-08-01',39,4),(46,'So good they can\'t ignore you',NULL,50,4,'2021-08-16','2016-12-01',40,3),(47,'Deep Work','',50,4,'2021-08-16','2016-01-05',41,2),(48,'Vivre - La psychologie du bonheur','',50,4,'2021-08-16','2006-09-01',42,4),(49,'Comment se faire des amis',NULL,53,4,'2021-08-16','1975-01-01',43,3),(50,'Psychologie de la communication',NULL,53,4,'2021-08-16','2016-08-10',44,3),(51,'L\'art de la guerre',NULL,59,4,'2021-08-16','0000-00-00',45,3),(52,'Marketing Mania','https://www.youtube.com/channel/UCSmUdD2Dd_v5uqBuRwtEZug',60,2,'2021-08-22','2015-12-18',46,3),(53,'Marketing Mania Daily','https://www.youtube.com/c/MarketingManiaDaily/featured',60,2,'2021-08-22','2016-08-09',47,1),(54,'Les Sept Habitudes des gens efficaces','https://en.wikipedia.org/wiki/The_7_Habits_of_Highly_Effective_People#Abundance_mentality',50,4,'2021-08-28','1989-01-01',48,1),(55,'Vendre au client difficile - 5ème edition',NULL,75,4,'2021-08-28','2016-10-12',49,3),(56,'La semaine de 4 heures','',50,4,'2021-08-28','2010-04-30',50,2),(57,'Apologie de Socrate',NULL,78,4,'2021-08-28','0000-00-00',51,3),(58,'Lettres à Lucilius','',78,4,'2021-08-28','0000-00-00',52,4),(59,'La vie heureuse','',78,4,'2021-08-28','0000-00-00',53,4),(60,'De la brièveté de la vie','',78,4,'2021-08-28','0000-00-00',54,4),(61,'De la constance du sage','',78,4,'2021-08-28','0000-00-00',55,4),(62,'Par-delà bien et mal','',78,4,'2021-08-28','1886-01-01',56,4),(63,'The rational male','',51,4,'2021-08-28','2013-10-01',57,2),(64,'Compréhension de l\'état du climat à l\'attention des décideurs','https://www.ipcc.ch/report/ar6/wg1/downloads/report/IPCC_AR6_WGI_SPM.pdf',55,9,'2021-08-28','2021-08-11',58,4),(65,'Rapport complet','https://www.ipcc.ch/report/ar6/wg1/downloads/report/IPCC_AR6_WGI_Full_Report.pdf',55,9,'2021-08-28','2021-08-11',59,2),(66,'Rapport complet en français','https://resumegiec.wordpress.com/2021/08/11/rapport-du-giec-resume-pour-les-decideurs/',55,9,'2021-08-28','2021-08-11',60,2),(68,'Réflexions autour des activités visant à identifier, comprendre, et détourner des structures nuisibles aux individus et aux groupes','https://www.hacking-social.com/',53,1,'2021-09-03','0000-00-00',61,4),(74,'Réseaux - La référence sur les réseaux informatiques','',58,4,'2021-09-04','2011-01-01',62,4),(75,'S\'organiser','',50,4,'2021-09-04','2009-02-05',63,3),(76,'Le pouvoir de l\'engagement total',NULL,50,4,'2021-09-04','2005-08-05',64,2),(77,'Sécurité informatique: Pour les DSI, RSSI et administrateurs',NULL,58,4,'2021-09-04','2016-10-06',65,4),(78,'Je sais cuisiner',NULL,44,4,'2021-09-04','1932-01-01',66,3),(79,'Le sel est-il dangereux pour la santé ?','https://www.youtube.com/watch?v=SB01gz09JVg',44,3,'2021-09-05','2021-09-01',67,2);
/*!40000 ALTER TABLE `Information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Information_author`
--

DROP TABLE IF EXISTS `Information_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Information_author` (
  `idInformation` int(11) NOT NULL,
  `idAuthor` int(11) NOT NULL,
  PRIMARY KEY (`idInformation`,`idAuthor`),
  KEY `fk_Information_author_2_idx` (`idAuthor`),
  CONSTRAINT `fk_Information_author_1` FOREIGN KEY (`idInformation`) REFERENCES `Information` (`idInformation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Information_author_2` FOREIGN KEY (`idAuthor`) REFERENCES `Author` (`idAuthor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information_author`
--

LOCK TABLES `Information_author` WRITE;
/*!40000 ALTER TABLE `Information_author` DISABLE KEYS */;
INSERT INTO `Information_author` VALUES (3,9),(4,1),(5,2),(6,3),(7,4),(8,10),(9,5),(11,8),(12,6),(13,7),(14,6),(15,7),(17,5),(18,12),(19,13),(20,1),(21,8),(22,5),(23,14),(24,7),(25,21),(26,22),(27,23),(28,22),(29,24),(30,25),(31,25),(32,25),(33,26),(34,27),(35,28),(37,24),(38,33),(39,34),(40,34),(41,36),(42,37),(43,38),(45,39),(46,40),(47,40),(48,41),(49,42),(50,43),(51,44),(52,45),(53,45),(54,37),(55,46),(56,47),(57,48),(58,49),(59,49),(60,49),(61,49),(62,50),(63,51),(64,52),(65,52),(66,52),(68,53),(74,56),(74,57),(75,58),(75,59),(76,60),(76,61),(77,62),(77,63),(77,67),(77,68),(77,69),(77,70),(77,71),(78,72),(79,5);
/*!40000 ALTER TABLE `Information_author` ENABLE KEYS */;
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
  PRIMARY KEY (`idInformation`,`idTag`),
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
INSERT INTO `Information_tag` VALUES (4,9),(6,55),(9,1),(13,52),(20,9),(22,80),(29,1),(33,2),(34,3),(35,4),(35,5),(37,1),(38,8),(39,7),(40,7),(42,79),(43,79),(45,10),(47,79),(51,11),(55,76),(55,77),(56,75),(68,49),(75,79),(79,80);
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES (1,'🧎 Fitness'),(2,'📞 Téléphone portable'),(3,'🧍 Données personnelles'),(4,'🧑‍🤝‍🧑 Couple'),(5,'❤️ Amour'),(7,'👁️ Totalitarisme'),(8,'🤣 Humour'),(9,'📈 Finance'),(10,'#️⃣ Développement logiciel'),(11,'🗺️ Stratégie militaire'),(43,'💶 Economie'),(44,'🍲 Alimentation'),(45,'🏫 Education'),(46,'⚡ Energie'),(47,'💪 Musculation'),(48,'🗪 Rhétorique et language'),(49,'🧑‍🤝‍🧑 Sociologie'),(50,'🙋‍♂️ Développement personnel'),(51,'♂♀ Relation Homme/Femme'),(52,'🎥 Cinéma'),(53,'💭 Psychologie'),(54,'📰 Média'),(55,'🌳 Ecologie'),(56,'📡 Technologie'),(57,'🔒 Vie privée'),(58,'💻 Informatique'),(59,'⚔️ Guerre'),(60,'🤩 Marketing'),(75,'🤝 Commerce'),(76,'💸 Vente'),(77,'🗣️ Négociation'),(78,'📜 Philosophie'),(79,'🗃️ Organisation'),(80,'🩺 Santé');
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

-- Dump completed on 2021-09-05 10:22:31
