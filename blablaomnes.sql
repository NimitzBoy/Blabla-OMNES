-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: blablaomnes
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `campus`
--

DROP TABLE IF EXISTS `campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus` (
  `id_campus` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_campus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus`
--

LOCK TABLES `campus` WRITE;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` VALUES (0,'Lyon');
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passagers_trajet`
--

DROP TABLE IF EXISTS `passagers_trajet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passagers_trajet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trajet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `statut` enum('en_attente','accepté','refusé') DEFAULT 'en_attente',
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_trajet` (`id_trajet`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `passagers_trajet_ibfk_1` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`),
  CONSTRAINT `passagers_trajet_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passagers_trajet`
--

LOCK TABLES `passagers_trajet` WRITE;
/*!40000 ALTER TABLE `passagers_trajet` DISABLE KEYS */;
INSERT INTO `passagers_trajet` VALUES (26,57,52,'accepté','2024-05-26 18:41:08');
/*!40000 ALTER TABLE `passagers_trajet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permis`
--

DROP TABLE IF EXISTS `permis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permis` (
  `id_permis` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `type_permis` varchar(20) DEFAULT NULL,
  `pays_obtention` varchar(50) DEFAULT NULL,
  `date_obtention` date DEFAULT NULL,
  PRIMARY KEY (`id_permis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permis`
--

LOCK TABLES `permis` WRITE;
/*!40000 ALTER TABLE `permis` DISABLE KEYS */;
/*!40000 ALTER TABLE `permis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `id_trajet` int(11) NOT NULL,
  `id_passager` int(11) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_reservation`),
  KEY `id_trajet` (`id_trajet`),
  KEY `id_passager` (`id_passager`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_passager`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL AUTO_INCREMENT,
  `conducteur_id` int(11) DEFAULT NULL,
  `date_depart` datetime DEFAULT NULL,
  `lieu_depart` varchar(100) DEFAULT NULL,
  `lieu_arrivee` varchar(100) DEFAULT NULL,
  `places_disponibles` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `type_trajet` varchar(100) DEFAULT NULL,
  `photo_vehicule` varchar(255) DEFAULT NULL,
  `numero_conducteur` int(11) DEFAULT NULL,
  `passager_id` int(11) DEFAULT NULL,
  `preference_conducteur` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id_trajet`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trajet`
--

LOCK TABLES `trajet` WRITE;
/*!40000 ALTER TABLE `trajet` DISABLE KEYS */;
INSERT INTO `trajet` VALUES (57,51,'2024-05-27 00:00:00','Lyon ','Bron ',2,10.00,'aller','uploads/vago_test.jpg',612,52,'non fumeur ');
/*!40000 ALTER TABLE `trajet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_permis` varchar(255) DEFAULT NULL,
  `numero_permis` varchar(255) DEFAULT NULL,
  `date_obtention_permis` date DEFAULT NULL,
  `validation_permis` int(11) DEFAULT 0,
  `wallet` int(11) DEFAULT 0,
  `notifications` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (26,'Portefaix','Mathilde','mathilde.admin@gmail.com','mathilde',NULL,601020300,'uploads/mathilde.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(27,'Richard','William','william.admin@gmail.com','william',NULL,601020301,'uploads/william.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(28,'Pechier','Arnaud','arnaud.admin@gmail.com','arnaud',NULL,601020302,'uploads/arnaud.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(51,'Dupont','A','dupont.a@gmail.com','123',NULL,612,'uploads/test_permis3.jpg','uploads/test_permis.jpg','123','2024-05-02',1,10,NULL),(52,'Pechier','Yannick','yannickpechier@gmail.com','123',NULL,1,'uploads/3.jpg',NULL,NULL,NULL,1,70,NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicule` (
  `id_vehicule` int(11) NOT NULL,
  `proprietaire_id` int(11) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `couleur` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_vehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'blablaomnes'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-26 21:08:13
