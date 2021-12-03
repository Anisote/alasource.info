-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: info
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-1build1

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
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (0,'Non saisie'),(1,'Heu?reka'),(2,'Cyrille Borne'),(3,'Le Réveilleur'),(4,'Frédéric Delavier'),(5,'La chaine du Doc\''),(6,'Le Précepteur'),(7,'Bolchegeek'),(8,'Victor Ferry'),(9,'Thinkerview'),(10,'Julien Venesson'),(11,'Harry JMG'),(12,'Mos Majorum'),(13,'Fouloscopie'),(14,'La séance de Marty'),(21,'Yoonns avec deux N'),(22,'Juste Milieu.'),(23,'La Cartouche'),(24,'Major Mouvement'),(25,'Jean-Marc Jancovici'),(26,'Wonderfall'),(27,'CNIL - Commission nationale de l\'informatique et des libertés'),(28,'Mark Manson'),(33,'Calmos'),(34,'Horizon-gull'),(36,'Anthony Robbins'),(37,'Stephen R. Covey'),(38,'Leo Babauta'),(39,'Robert C. Martin'),(40,'Cal Newport'),(41,'Mihaly Csikszentmihaly'),(42,'Dale Carnegie'),(43,'Jean-Claude Abric'),(44,'Sun Tzu'),(45,'Marketing Mania'),(46,'Nicolas Caron'),(47,'Timothy Ferriss'),(48,'Platon'),(49,'Sénèque'),(50,'Friedrich W. Nietzsche'),(51,'Rollo Tomassi'),(52,'GIEC - Groupe d\'experts intergouvernemental sur l\'évolution du climat'),(53,'Hacking Social'),(56,'Andrew Tanenbaum'),(57,'David Wetherall'),(58,'Laurence Eunfalt'),(59,'Stéphanie Bujon'),(60,'Jim Loehr'),(61,'Tony Schwartz'),(62,'Laurent Bloch'),(63,'Christophe Wolfhugel'),(67,'Arnaud Souillé'),(68,'Ary Kokos'),(69,'Gérôme Billois'),(70,'Alexandre Anzala-Yamajako'),(71,'Thomas Debize'),(72,'Ginette Matinot'),(73,'Christophe Brusset'),(74,'Valérie Masson-Delmotte'),(75,'Pierre Larrouturou'),(76,'Pascal Boniface'),(77,'Le fossoyeur de film'),(78,'Alain Juillet'),(79,'Frédéric Pierucci'),(80,'Blitzstream'),(81,'Sur le champ'),(82,'Zaboutine'),(83,'Praxis - François Boulo'),(84,'ANSSI - Agence nationale de la sécurité des systèmes d\'information'),(85,'Cloudflare'),(86,'Hygiène mentale'),(87,'Eric Zemmour'),(88,'Michel Onfray'),(89,'La Théorie de Graham'),(90,'Stéphane Bortzmeyer'),(91,'Wordpress'),(93,'France Inter'),(94,'James Clear'),(95,'Babor Lefan'),(96,'JeanBaptisteShow'),(97,'PsEuDoLeSs1'),(98,'Daniel Rose'),(99,'Vatsyayana Mallanaga'),(100,'Volvo Trucks'),(101,'Jean Claude Van Damme'),(102,'Duke Esports'),(103,'Max Roser'),(104,'Robert T. Kiyosaki'),(105,'Napoléon Hill'),(106,'Les Chroniques de la Douleur');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoryMedia`
--

LOCK TABLES `CategoryMedia` WRITE;
/*!40000 ALTER TABLE `CategoryMedia` DISABLE KEYS */;
INSERT INTO `CategoryMedia` VALUES (0,'Non saisie'),(1,'🗒️ Blog'),(2,'📹 Chaîne vidéo'),(3,'📀 Vidéo'),(4,'🕮 Ouvrage'),(8,'📖 Cours'),(9,'📁 Dossier'),(10,'🎙️ Interview'),(11,'🗣️ Débat'),(14,'📄 Article'),(15,'🌐 Site internet'),(17,'🔀 Playlist vidéos'),(18,'⏩ Playlist audio');
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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Information`
--

LOCK TABLES `Information` WRITE;
/*!40000 ALTER TABLE `Information` DISABLE KEYS */;
INSERT INTO `Information` VALUES (3,'L’agroalimentaire vu de l’intérieur – intoxication ?','https://www.youtube.com/watch?v=lXXp-PVQ0HQ',44,10,'2021-02-12','2019-11-07',1,3),(4,'Si vous ne comprenez rien à la finance et à l\'économie','https://www.youtube.com/c/HeurekaFinanceEco/featured',43,2,'2021-02-12','2015-10-18',2,4),(5,'Blog d\'un enseignant technophile en lycée agricole','https://cyrille-borne.com/',45,1,'2021-02-12','2021-05-06',3,2),(6,'Environnement, économie et du lien entre les deux','https://www.youtube.com/channel/UC1EacOJoqsKaYxaDomTCTEQ',46,2,'2021-02-12','2015-03-31',4,3),(7,'La méthode Delavier de musculation - volume 1','http://www.methode-delavier.com/',47,4,'2021-02-12','2009-09-15',5,3),(8,'Nutrition de la force','https://www.julienvenesson.fr/nutrition-de-la-force/',47,4,'2021-02-12','2011-07-07',6,2),(9,'Un mélange dynamique de sport, de fitness et de conseils pour rester en bonne santé','https://www.youtube.com/channel/UCPZv08N85_20nB1VFstRqhg',47,2,'2021-02-12','2020-01-26',7,3),(11,'Outils rhétoriques, analyses de discours et lectures d\'ouvrages','https://www.youtube.com/channel/UCcueC-4NWGuPFQKzQWn5heA',48,2,'2021-02-12','2013-07-19',8,2),(12,'Donner matière à pensée','https://www.youtube.com/c/LePr%C3%A9cepteurOfficiel/featured',49,2,'2021-02-12','2017-11-13',9,3),(13,'Culture populaire (ciné, séries, jeux, littératures ou macramé) avec le couteau entre les dents','https://www.youtube.com/user/bolchegeek',49,2,'2021-02-12','2013-09-14',10,4),(14,'Bernays – Comment manipuler l’opinion','https://www.youtube.com/watch?v=UvkhFpb7M7Y',49,3,'2021-02-12','2020-09-23',11,3),(15,'Le contrat social – John Wick','https://www.youtube.com/watch?v=XXKnLJGq6sw',49,3,'2021-02-12','2020-07-15',12,3),(17,'Ne pas maigrir malgré un déficité calorique ? (les pièges du total calorique et du régime)','https://www.youtube.com/watch?v=iHCnuGQcUmo&list=LL&index=2&t=14s',44,3,'2021-05-12','2021-05-09',13,2),(18,'Ecart salarial : réponse à Heu?reka...','https://www.youtube.com/watch?v=Kd00wyflCFY&list=LL&index=4',51,3,'2021-05-12','2021-04-29',14,3),(19,'Une expérience sociale avec 1200 abonnés','https://www.youtube.com/watch?v=ppSrAHoGwrI&list=LL&index=20&t=11s',49,3,'2021-05-12','2021-02-10',15,3),(20,'Comprendre et se sortir du surendettement','https://www.youtube.com/watch?v=x9z65AZ9JuM&list=LL&index=22',43,3,'2021-05-12','2020-07-10',16,3),(21,'Les leçons rhétoriques de Nietzsche','https://www.youtube.com/watch?v=WV34-7hpKLE&list=LL&index=23',48,3,'2021-05-12','2021-02-07',17,3),(22,'L\'amputation de la miss Olympia Melissa Coates','https://www.youtube.com/watch?v=t7ignKx9UM8&list=LL&index=45',47,3,'2021-05-12','2020-11-22',18,1),(23,'La Séance de Marty - Rétine et Pupille','https://www.youtube.com/watch?v=qPpHf9mMq6k&list=LL&index=55&t=419s',52,3,'2021-05-12','2020-09-26',19,4),(24,'Zootopia est-il à côté de la plaque ? ','https://www.youtube.com/watch?v=NcShYK-MneM&list=LL&index=59',49,3,'2021-05-12','2017-01-13',20,3),(25,'Sardoche passe par les 5 étapes du deuil après un permaban','https://www.youtube.com/watch?v=jOtz219T-BM',53,3,'2021-05-14','2019-09-05',21,1),(26,'Nudge et coronavirus : la manipulation préférée de Macron ?','https://www.youtube.com/watch?v=8wC2njqNwn0',49,3,'2021-05-17','2021-05-16',22,2),(27,'Critique de l\'écriture inclusive','https://www.youtube.com/watch?v=FViXADQb_k0',48,3,'2021-05-17','2021-05-13',23,2),(28,'Propagande des médias pour Emmanuel Macron','https://www.youtube.com/watch?v=S72b_XF-Y88',54,3,'2021-05-24','2021-03-30',24,2),(29,'Etirement et mobilité','https://www.youtube.com/watch?app=desktop&v=0Z9bT-gfw8Y',47,3,'2021-06-13','2021-06-13',25,2),(30,'Peut-on encore sauver le climat ?','https://www.youtube.com/watch?v=3Pr577eUfTc',55,11,'2021-06-13','2021-03-24',26,2),(31,'Présentation des prévisions de tempêrature pour les 100 prochaines années','https://www.youtube.com/watch?v=6Zg1mSPbVBg',55,3,'2021-06-13','2020-11-23',27,3),(32,'Energie et changement climatique','https://jancovici.com/publications-et-co/cours-mines-paristech-2019/cours-mines-paris-tech-juin-2019',55,8,'2021-06-13','2019-06-01',28,3),(33,'Graphene OS - système d\'exploitation pour téléphone','https://wonderfall.space/grapheneos-2021/',56,14,'2021-07-17','2021-05-27',29,2),(34,'Prospective sur la vie privée en 2030','https://linc.cnil.fr/sites/default/files/atoms/files/linc_proteger_la_vie_privee_en_2030_-_une_exploration_prospective_et_speculative.pdf',57,9,'2021-07-17','2021-01-01',30,2),(35,'Conseil en relation de couple par plus de 1500 couples heureux','https://markmanson.net/relationship-advice',4,14,'2021-07-17','2019-10-08',31,4),(37,'La mobilité est elle meilleure que les étirements ?','https://www.youtube.com/watch?v=0Z9bT-gfw8Y',47,3,'2021-08-11','2021-06-13',32,2),(38,'Analyse et decryptage de films et passages comiques','https://www.youtube.com/channel/UCYBr8enT5x4-JIxcPY6y-_A',52,2,'2021-08-11','2017-01-06',33,3),(39,'Comment pouvons-nous tous être totalitaire ? - 1','https://www.youtube.com/watch?v=2__Dd_KXuuU',49,3,'2021-08-11','2021-01-03',34,3),(40,'Comment pouvons-nous tous être totalitaire ? - 2','https://www.youtube.com/watch?v=o2DEESuEOJk',49,3,'2021-08-11','2021-07-04',35,3),(41,'Pouvoir illimité','',50,4,'2021-08-16','1986-01-01',36,4),(42,'Priorité aux priorités','',50,4,'2021-08-16','1985-08-29',37,2),(43,'L\'art d\'aller à l\'essentiel','',50,4,'2021-08-16','2012-03-16',38,3),(45,'Coder proprement','',58,4,'2021-08-16','2008-08-01',39,4),(46,'So good they can\'t ignore you',NULL,50,4,'2021-08-16','2016-12-01',40,3),(47,'Deep Work','',50,4,'2021-08-16','2016-01-05',41,2),(48,'Vivre - La psychologie du bonheur','',50,4,'2021-08-16','2006-09-01',42,4),(49,'Comment se faire des amis',NULL,53,4,'2021-08-16','1975-01-01',43,3),(50,'Psychologie de la communication',NULL,53,4,'2021-08-16','2016-08-10',44,3),(51,'L\'art de la guerre',NULL,59,4,'2021-08-16','0000-00-00',45,3),(52,'Marketing Mania','https://www.youtube.com/channel/UCSmUdD2Dd_v5uqBuRwtEZug',60,2,'2021-08-22','2015-12-18',46,3),(53,'Marketing Mania Daily','https://www.youtube.com/c/MarketingManiaDaily/featured',60,2,'2021-08-22','2016-08-09',47,1),(54,'Les Sept Habitudes des gens efficaces','https://en.wikipedia.org/wiki/The_7_Habits_of_Highly_Effective_People#Abundance_mentality',50,4,'2021-08-28','1989-01-01',48,1),(55,'Vendre au client difficile - 5ème edition',NULL,75,4,'2021-08-28','2016-10-12',49,3),(56,'La semaine de 4 heures','',50,4,'2021-08-28','2010-04-30',50,2),(57,'Apologie de Socrate',NULL,78,4,'2021-08-28','0000-00-00',51,3),(58,'Lettres à Lucilius','',78,4,'2021-08-28','0000-00-00',52,4),(59,'La vie heureuse','',78,4,'2021-08-28','0000-00-00',53,4),(60,'De la brièveté de la vie','',78,4,'2021-08-28','0000-00-00',54,4),(61,'De la constance du sage','',78,4,'2021-08-28','0000-00-00',55,4),(62,'Par-delà bien et mal','',78,4,'2021-08-28','1886-01-01',56,4),(63,'The rational male','',51,4,'2021-08-28','2013-10-01',57,2),(64,'Compréhension de l\'état du climat à l\'attention des décideurs','https://www.ipcc.ch/report/ar6/wg1/downloads/report/IPCC_AR6_WGI_SPM.pdf',55,9,'2021-08-28','2021-08-11',58,4),(65,'Rapport complet','https://www.ipcc.ch/report/ar6/wg1/downloads/report/IPCC_AR6_WGI_Full_Report.pdf',55,9,'2021-08-28','2021-08-11',59,2),(66,'Rapport complet en français','https://resumegiec.wordpress.com/2021/08/11/rapport-du-giec-resume-pour-les-decideurs/',55,9,'2021-08-28','2021-08-11',60,2),(68,'Réflexions autour des activités visant à identifier, comprendre, et détourner des structures nuisibles aux individus et aux groupes','https://www.hacking-social.com/',53,15,'2021-09-03','0000-00-00',61,3),(74,'Réseaux - La référence sur les réseaux informatiques',NULL,58,4,'2021-09-04','2011-01-01',62,4),(75,'S\'organiser','',50,4,'2021-09-04','2009-02-05',63,3),(76,'Le pouvoir de l\'engagement total',NULL,50,4,'2021-09-04','2005-08-05',64,2),(77,'Sécurité informatique: Pour les DSI, RSSI et administrateurs',NULL,58,4,'2021-09-04','2016-10-06',65,4),(78,'Je sais cuisiner',NULL,44,4,'2021-09-04','1932-01-01',66,3),(79,'Le sel est-il dangereux pour la santé ?','https://www.youtube.com/watch?v=SB01gz09JVg',44,3,'2021-09-05','2021-09-01',67,2),(80,'Le rapport du GIEC de 2021 annonce l\'apocalypse ?','https://www.youtube.com/watch?v=9X4bV9fYkfs&t=1044s',55,10,'2021-09-09','2021-09-08',68,1),(81,'Comment rompre avec quelqu\'un ?','https://markmanson.net/how-to-break-up-with-someone',4,14,'2021-09-09','2020-02-03',69,2),(82,'Analyse de discours féministes','https://www.youtube.com/c/MosMajorum',51,2,'2021-09-17','2018-09-11',70,3),(83,'La fin de la guerre classique ?','https://www.youtube.com/watch?v=yq_ok3RHU9Q&t=3358s',59,10,'2021-09-17','2021-09-09',71,3),(84,'DGSE, espions, secrets des Affaires et crises mondiales','https://www.youtube.com/watch?v=AjM8TpMs01Y',83,10,'2021-09-17','2018-04-07',72,3),(85,'Vulgarisation de l\'histoire militaire, guerres et batailles','https://www.youtube.com/c/Surlechamp/featured',11,2,'2021-09-17','2016-06-18',73,3),(86,'Alstom : la France vendue à la découpe ?','https://www.youtube.com/watch?v=dejeVuL9-7c&t=12s',83,10,'2021-09-17','2019-07-08',74,3),(87,'Parties d\'échecs commentées de haut niveaux','https://www.youtube.com/c/VideosEchecs',82,2,'2021-09-17','2015-02-08',75,4),(88,'Cours d\'échecs pour joueurs débutants et occasionnels.','https://www.youtube.com/channel/UCho9uPByw7z1mOhTqEnfWUA',82,2,'2021-09-18','2021-07-12',76,2),(89,'Analyses et tutoriels sur League of Legends','https://www.youtube.com/c/Zaboutine/',89,2,'2021-10-13','2021-05-05',77,3),(90,'Politique, économie et social','https://www.youtube.com/channel/UCHXyS9njDTc-HbnfRr1k6uA/about',84,2,'2021-10-13','2021-04-11',78,2),(91,'Guides pratiques en cybersécurité','https://www.ssi.gouv.fr/administration/bonnes-pratiques/',85,9,'2021-10-13','0000-00-00',79,4),(92,'Publications scientifiques en informatique','https://research.cloudflare.com/publications/',58,9,'2021-10-13','0000-00-00',80,3),(93,'Vulgarisations des mécanismes psychologiques','https://www.youtube.com/c/Hygi%C3%A8neMentale',53,2,'2021-10-13','2014-07-22',81,4),(94,'Ce que l\'on ne vous dit jamais sur l\'Etat','https://www.youtube.com/watch?v=oqn5K89L7d8',84,3,'2021-10-13','2021-10-10',82,2),(95,'Election 2021 - Débat entre Eric Zemmour et Michel Onfray','https://i.ytimg.com/an_webp/paPKnx4j-dk/mqdefault_6s.webp?du=3000&sqp=CICFnIsG&rs=AOn4CLBI9N5jIXVpXAPmm-mmyMvEOdQ5uw',84,11,'2021-10-13','2021-10-06',83,2),(96,'Explications de scenari de films','https://www.youtube.com/channel/UCddWTaSc35LGegHlf5TC11Q/featured',52,2,'2021-10-15','2020-09-16',84,2),(97,'La théorie des 3 Cooper - Interstellar','https://www.youtube.com/watch?v=0Pv_RTZ9ZHQ',52,3,'2021-10-15','2021-10-05',85,2),(98,'Blog d\'un spécialiste en réseau informatique','https://www.bortzmeyer.org/',58,1,'2021-10-15','1995-01-01',86,3),(99,'Analyses de films, réalisation et partage d\'avis','https://www.youtube.com/c/LaS%C3%A9anceDeMarty',52,2,'2021-10-15','2015-02-16',87,3),(100,'Durcir la configuration d\'un Wordpress','https://wordpress.org/support/article/hardening-wordpress/',58,14,'2021-10-16','2003-05-27',88,2),(101,'Science du comportement des foules','https://www.youtube.com/c/Fouloscopie/about',49,2,'2021-10-30','2018-11-07',89,3),(102,'Mise en perspective du nombre de décès du Covid 19','https://www.franceinter.fr/monde/cinq-millions-de-morts-du-covid-dans-le-monde-cinq-infographies-pour-mettre-ce-chifre-en-perspective',80,14,'2021-11-01','2021-11-01',90,2),(103,'Les meilleures articles de Mark Manson','https://markmanson.net/best-articles',50,14,'2021-11-10','2008-01-01',91,3),(104,'Les meilleures articles de James Clear','https://jamesclear.com/articles',50,14,'2021-11-10','2012-01-01',92,2),(105,'Caricatures humoristiques et denonciations des dérives du marketing et des réseaux sociaux','https://www.youtube.com/c/BABORLELEFANOFFICIEL',87,2,'2021-11-11','2013-07-29',93,1),(106,'Enquêtes sur les dérives du marketing numériques','https://www.youtube.com/playlist?list=PL8EHj-d7H_GWeyle6TuWjzwsal_V1qnAD',60,17,'2021-11-12','2017-05-08',94,2),(107,'J\'avais un rêve','https://www.youtube.com/results?search_query=jean+baptiste+show+j%27avais+un+reve',88,3,'2021-11-12','2015-07-27',95,3),(108,'Partage de sa passion du jeux vidéos','https://www.youtube.com/c/JeanBaptisteShow/videos',89,2,'2021-11-12','2013-03-05',96,2),(109,'Analyses de jeux vidéos majoritairement indépendants','https://www.youtube.com/user/PsEuDoLeSs1',89,2,'2021-11-12','2013-04-12',97,3),(124,'Sex God Method 2nd Edition','https://archive.org/details/sex-god-method-2nd-edition.com/mode/2up',90,4,'2021-12-03','2008-01-01',98,3),(125,'Kama Sutra','https://en.wikipedia.org/wiki/Kama_Sutra',90,4,'2021-12-03','0000-00-00',99,2),(126,'The Epic Split','https://www.youtube.com/watch?v=M7FIvfx5J10',91,3,'2021-12-03','2013-11-14',100,3),(127,'Conseils et analyses sur le jeu League of legends','https://www.youtube.com/c/DukeEsports/videos',89,2,'2021-12-03','2015-11-25',101,3),(128,'Recueil de publication scientifiques et de statistiques','https://ourworldindata.org/',92,15,'2021-12-03','2011-01-01',102,3),(129,'Père riche, père pauvre',NULL,43,4,'2021-12-03','1997-01-01',103,2),(130,'Réfléchissez et devenez riche',NULL,43,4,'2021-12-03','1937-01-01',104,2),(131,'Explication et solution à certaines douleurs','https://www.youtube.com/channel/UCcjMzqhV5CLJ5dAKFMoXE4Q/videos',80,2,'2021-12-03','2015-11-15',105,2);
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
INSERT INTO `Information_author` VALUES (3,9),(3,73),(4,1),(5,2),(6,3),(7,4),(8,10),(9,5),(11,8),(12,6),(13,7),(14,6),(15,7),(17,5),(18,12),(19,13),(20,1),(21,8),(22,5),(23,14),(23,77),(24,7),(25,21),(26,22),(27,23),(28,22),(29,24),(30,25),(30,76),(31,25),(32,25),(33,26),(34,27),(35,28),(37,24),(38,33),(39,34),(40,34),(41,36),(42,37),(43,38),(45,39),(46,40),(47,40),(48,41),(49,42),(50,43),(51,44),(52,45),(53,45),(54,37),(55,46),(56,47),(57,48),(58,49),(59,49),(60,49),(61,49),(62,50),(63,51),(64,52),(65,52),(66,52),(68,53),(74,56),(74,57),(75,58),(75,59),(76,60),(76,61),(77,62),(77,63),(77,67),(77,68),(77,69),(77,70),(77,71),(78,72),(79,5),(80,9),(80,74),(80,75),(81,28),(82,12),(83,9),(84,9),(84,78),(85,81),(86,9),(86,79),(87,80),(88,80),(89,82),(90,83),(91,84),(92,85),(93,86),(94,83),(95,87),(95,88),(96,89),(97,89),(98,90),(99,14),(100,91),(101,13),(102,93),(103,28),(104,94),(105,95),(106,95),(107,96),(108,96),(109,97),(124,98),(125,99),(126,100),(127,102),(128,103),(129,104),(130,105),(131,106);
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
INSERT INTO `Information_tag` VALUES (3,44),(3,81),(4,9),(4,43),(5,45),(6,46),(6,55),(7,47),(8,47),(9,1),(9,47),(9,80),(11,48),(12,49),(13,49),(13,52),(14,49),(15,49),(17,44),(18,51),(19,49),(20,9),(20,43),(21,48),(22,47),(22,80),(23,52),(24,49),(25,53),(26,49),(27,48),(28,54),(29,1),(29,47),(30,55),(31,55),(32,55),(33,2),(33,56),(34,3),(34,57),(35,4),(35,5),(37,1),(37,47),(38,8),(38,52),(39,7),(39,49),(40,7),(40,49),(41,50),(42,50),(42,79),(43,50),(43,79),(45,10),(45,58),(46,50),(47,50),(47,79),(48,50),(49,53),(50,53),(51,11),(51,59),(52,60),(53,60),(54,50),(55,75),(55,76),(55,77),(56,50),(56,75),(57,78),(58,78),(59,78),(60,78),(61,78),(62,78),(63,4),(63,5),(63,51),(64,55),(65,55),(66,55),(68,49),(68,53),(74,58),(74,85),(75,50),(75,79),(76,50),(77,58),(77,85),(78,44),(79,44),(79,80),(80,46),(80,55),(80,81),(81,4),(81,5),(82,49),(82,51),(83,11),(83,59),(83,83),(83,86),(84,11),(84,59),(84,83),(85,11),(85,59),(85,83),(86,81),(86,83),(87,82),(88,82),(89,89),(90,43),(90,45),(90,54),(90,84),(91,58),(91,85),(92,58),(93,49),(93,53),(94,43),(94,84),(95,43),(95,84),(95,86),(96,52),(97,52),(98,58),(99,52),(100,58),(101,49),(101,53),(102,80),(103,50),(103,51),(103,53),(104,50),(105,60),(105,87),(106,60),(106,87),(107,88),(108,89),(109,89),(124,90),(125,90),(126,88),(126,91),(127,89),(128,92),(129,43),(129,50),(130,43),(130,50),(131,47),(131,80);
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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES (1,'🧎 Fitness'),(2,'📞 Téléphone portable'),(3,'🧍 Données personnelles'),(4,'💑 Couple'),(5,'❤️ Amour'),(7,'👁️ Totalitarisme'),(8,'🤣 Humour'),(9,'📈 Finance'),(10,'#️⃣ Développement logiciel'),(11,'📍 Stratégie militaire'),(43,'💶 Economie'),(44,'🍲 Alimentation'),(45,'🏫 Education'),(46,'🔋 Energie'),(47,'💪 Musculation'),(48,'🗪 Rhétorique et language'),(49,'🧑‍🤝‍🧑 Sociologie'),(50,'🙋‍♂️ Développement personnel'),(51,'♂♀ Relation Homme/Femme'),(52,'🎥 Cinéma'),(53,'💭 Psychologie'),(54,'📰 Média'),(55,'🌳 Ecologie'),(56,'📡 Technologie'),(57,'🔒 Vie privée'),(58,'💻 Informatique'),(59,'⚔️ Guerre'),(60,'🤩 Marketing'),(75,'🤝 Commerce'),(76,'💸 Vente'),(77,'🗣️ Négociation'),(78,'📜 Philosophie'),(79,'🗃️ Organisation'),(80,'🩺 Santé'),(81,'🏭 Industrie'),(82,'♟️ Jeux'),(83,'🗺️ Géopolitique'),(84,'🗳️ Politique'),(85,'🔐 Cybersécurité'),(86,'🏺 Histoire'),(87,'🤳 Réseaux sociaux'),(88,'✊ Motivation'),(89,'🎮 Jeux vidéos'),(90,'🍆 Sexualité'),(91,'💍 Publicité'),(92,'🔧 Outils');
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

-- Dump completed on 2021-12-03 20:22:16
