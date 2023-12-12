-- MySQL dump 10.13  Distrib 8.1.0, for macos12.6 (x86_64)
--
-- Host: localhost    Database: laravel1
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreClique` int NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'sahvewjkj','sc gvdwdhbnd','sa hbsahbsjhs','images/diplome/XTCFoaRB3kD09IzYYvqrY9FcKV5dUS8TFFPGvWjH.png',2,1,0,'2023-12-09 11:58:27','2023-12-09 12:14:14'),(2,'testvhsuyd','shc hsyics','dev','images/diplome/vFb70Q9XIfctdyDcXykOyZqa5yJbctAOOLl3haqC.png',0,1,1,'2023-12-09 11:58:32','2023-12-09 12:16:06');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `article_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commentaires_user_id_foreign` (`user_id`),
  KEY `commentaires_article_id_foreign` (`article_id`),
  CONSTRAINT `commentaires_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES (1,'sdcvbnmw',1,1,0,'2023-12-09 12:31:59','2023-12-09 12:31:59'),(2,'bla bla',1,1,1,'2023-12-09 12:32:09','2023-12-09 12:43:39'),(3,'vghsah sjhdsbhsscbhs',1,1,0,'2023-12-09 12:32:12','2023-12-09 12:32:12'),(4,'vghsah sjhdsbhsscbhs',1,2,0,'2023-12-09 12:32:22','2023-12-09 12:32:22');
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `demandes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `statut` enum('enCours','accepter','refuser') COLLATE utf8mb4_unicode_ci NOT NULL,
  `userMentor_id` bigint unsigned NOT NULL,
  `userMentore_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demandes_usermentor_id_foreign` (`userMentor_id`),
  KEY `demandes_usermentore_id_foreign` (`userMentore_id`),
  CONSTRAINT `demandes_usermentor_id_foreign` FOREIGN KEY (`userMentor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `demandes_usermentore_id_foreign` FOREIGN KEY (`userMentore_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demandes`
--

LOCK TABLES `demandes` WRITE;
/*!40000 ALTER TABLE `demandes` DISABLE KEYS */;
INSERT INTO `demandes` VALUES (1,'refuser',3,2,0,'2023-12-08 16:09:44','2023-12-08 16:38:44'),(2,'refuser',3,2,0,'2023-12-08 16:20:28','2023-12-08 19:58:30'),(3,'accepter',3,2,0,'2023-12-08 19:47:53','2023-12-08 19:58:12');
/*!40000 ALTER TABLE `demandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diplomes`
--

DROP TABLE IF EXISTS `diplomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diplomes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateObtention` date NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diplomes_user_id_foreign` (`user_id`),
  CONSTRAINT `diplomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diplomes`
--

LOCK TABLES `diplomes` WRITE;
/*!40000 ALTER TABLE `diplomes` DISABLE KEYS */;
INSERT INTO `diplomes` VALUES (1,'asbchxcfvgbhnm','fichiers/diplome/svOtMZMBmJPF4Xid6Bd864H4YYbXG1t9Cz7Fhqc0.png','jhdsvdsavh','2003-02-02',1,1,'2023-12-08 17:13:54','2023-12-08 20:01:38'),(2,'asj bjbdwqjk sa asvfghjnkm','fichiers/diplome/z1Yq1AGO83qeMPfb3qFAoUfrl8OVMJMqU6B35WnU.png','sasdbbjdsa','2003-02-02',0,1,'2023-12-08 19:59:44','2023-12-08 19:59:44');
/*!40000 ALTER TABLE `diplomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaines`
--

DROP TABLE IF EXISTS `domaines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domaines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomDomaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domaines_nomdomaine_unique` (`nomDomaine`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaines`
--

LOCK TABLES `domaines` WRITE;
/*!40000 ALTER TABLE `domaines` DISABLE KEYS */;
INSERT INTO `domaines` VALUES (1,'Informatique','cbsacjbjklkaI',0,'2023-12-08 12:52:51','2023-12-08 12:52:51'),(2,'dev','cnmsa',1,'2023-12-08 12:53:11','2023-12-08 12:57:17'),(3,'dev3','cnmsa',1,'2023-12-08 19:25:08','2023-12-08 19:27:36');
/*!40000 ALTER TABLE `domaines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `note` int NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userMentor_id` bigint unsigned NOT NULL,
  `userMentore_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_usermentor_id_foreign` (`userMentor_id`),
  KEY `evaluations_usermentore_id_foreign` (`userMentore_id`),
  CONSTRAINT `evaluations_usermentor_id_foreign` FOREIGN KEY (`userMentor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evaluations_usermentore_id_foreign` FOREIGN KEY (`userMentore_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` VALUES (1,4,'merci mon grand bhjdbhinsc',3,2,0,'2023-12-08 15:37:32','2023-12-08 15:37:32'),(2,1,'merci mon grand bhjdbhinsc  aygsh',3,2,0,'2023-12-08 15:39:20','2023-12-08 15:39:20'),(3,1,'merci mon grand bhjdbhinsc  aygsh s',3,2,0,'2023-12-08 15:39:30','2023-12-08 15:39:30'),(4,1,'merci mon grand bhjdbhinsc  aygsh s',2,2,0,'2023-12-08 19:40:47','2023-12-08 19:40:47');
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tache` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateDebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_user_id_foreign` (`user_id`),
  CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,'stage dev web','dbfhjsn cnck dknsc bjd','Simolon',NULL,'bla bla','2003-01-01','2003-03-01',3,1,'2023-12-08 15:18:24','2023-12-08 19:34:53'),(2,'sdbnh sdcfvgbhnjm','wqjdhvd','dwqhvdhd',NULL,'wqghdbjd','2003-03-02','2004-03-02',3,0,'2023-12-08 15:19:25','2023-12-08 19:34:39'),(3,'sdbnh q','wqjdhvd','dwqhvdhd','fichiers/experience/TYB9Im1Sl3jCBI4wWsynZqVjajUdNWiqFovU5aLf.png','wqghdbjd','2003-03-02','2004-03-02',3,0,'2023-12-08 15:25:01','2023-12-08 15:30:21'),(4,'stage dev web3','dbfhjsn cnck dknsc bjdkjbdf','Simplon','fichiers/experience/gmd6GnNZwuQSZ5vKBrNOh7IbFF6kIAkWrlZBhgry.png','bla bla','2003-01-01','2003-03-01',3,0,'2023-12-08 19:32:30','2023-12-08 19:32:30');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userEnv_id` bigint unsigned NOT NULL,
  `userRec_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_userenv_id_foreign` (`userEnv_id`),
  KEY `messages_userrec_id_foreign` (`userRec_id`),
  CONSTRAINT `messages_userenv_id_foreign` FOREIGN KEY (`userEnv_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_userrec_id_foreign` FOREIGN KEY (`userRec_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'dfvgbhhwdj',NULL,1,1,0,'2023-12-09 16:08:09','2023-12-09 16:08:09'),(2,'dfvgbhhwdj',NULL,5,1,0,'2023-12-09 16:08:19','2023-12-09 16:08:19'),(3,'dfvgbhhwdj',NULL,1,5,0,'2023-12-09 16:08:25','2023-12-09 16:08:25'),(4,'fcgvhbjkdqw',NULL,5,1,0,'2023-12-09 20:39:30','2023-12-09 20:39:30'),(5,'fcgvhbjkdqw',NULL,1,4,0,'2023-12-09 20:39:35','2023-12-09 20:39:35'),(6,'fcgvhbjkdqw',NULL,1,5,0,'2023-12-09 20:39:39','2023-12-09 20:39:39'),(7,'fcgvhbjkdqw',NULL,1,5,0,'2023-12-09 20:39:42','2023-12-09 20:39:42');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_12_05_164738_create_roles_table',1),(2,'2013_12_05_164907_create_domaines_table',1),(3,'2013_12_12_000000_create_users_table',1),(4,'2013_12_13_165121_create_articles_table',1),(5,'2014_08_05_165120_create_commentaires_table',1),(6,'2014_10_12_100000_create_password_reset_tokens_table',1),(7,'2019_08_19_000000_create_failed_jobs_table',1),(8,'2019_12_14_000001_create_personal_access_tokens_table',1),(9,'2023_12_05_165200_create_evaluations_table',1),(10,'2023_12_05_165218_create_messages_table',1),(11,'2023_12_05_165237_create_diplomes_table',1),(12,'2023_12_05_165249_create_experiences_table',1),(13,'2023_12_06_105253_create_notifications_table',1),(14,'2023_12_08_074938_create_demandes_table',1),(15,'2023_12_08_105615_create_sousdomaines_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estlu` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'bonjour',1,1,1,'2023-12-08 18:10:32','2023-12-08 20:05:30'),(2,'bonjour',0,2,0,'2023-12-08 18:11:05','2023-12-08 18:11:05'),(3,'bonjour',0,1,0,'2023-12-08 18:11:08','2023-12-08 18:11:08'),(4,'bonjour',0,2,0,'2023-12-08 18:11:12','2023-12-08 18:11:12'),(5,'bonjour',0,3,0,'2023-12-08 18:11:16','2023-12-08 18:11:16'),(6,'bonjour',0,1,0,'2023-12-08 18:11:18','2023-12-08 18:11:18'),(7,'bonjour vca',0,1,0,'2023-12-08 18:11:26','2023-12-08 18:11:26'),(8,'bonjour vcaedfvgb',0,1,0,'2023-12-08 20:03:45','2023-12-08 20:03:45');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (5,'App\\Models\\User',1,'ApiToken','1304bca78fb06db1cf9640b7c148e00ae269329798c2175d38b5a5cfb2744987','[\"*\"]','2023-12-09 20:40:45',NULL,'2023-12-08 17:03:24','2023-12-09 20:40:45'),(6,'App\\Models\\User',3,'ApiToken','a891b583e55b76bd59cbb4fb2c85e9148ad809b45f11329343b443215b5ed5f9','[\"*\"]','2023-12-08 19:54:48',NULL,'2023-12-08 17:04:04','2023-12-08 19:54:48'),(9,'App\\Models\\User',2,'ApiToken','2cf7360e041431df3b7415bd27f5417ced6883151711c31054985e8f828e9ef8','[\"*\"]','2023-12-08 19:54:01',NULL,'2023-12-08 19:40:29','2023-12-08 19:54:01'),(10,'App\\Models\\User',5,'ApiToken','13c7c17cc1cb977b785c2dd7b8a822838a8d8a4fa46353e8ea4631abe38d9c73','[\"*\"]','2023-12-09 20:58:06',NULL,'2023-12-09 20:43:42','2023-12-09 20:58:06'),(11,'App\\Models\\User',5,'ApiToken','12d57039356eb668665412ef285ebf1dc4d26eb3118471a528ab4ec8fa32a9d7','[\"*\"]','2023-12-10 02:19:16',NULL,'2023-12-09 20:57:50','2023-12-10 02:19:16');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',0,'2023-12-08 12:42:47','2023-12-08 12:49:46'),(2,'mentore',0,'2023-12-08 12:45:37','2023-12-08 12:45:37'),(3,'mentor',0,'2023-12-08 12:45:44','2023-12-08 12:48:30'),(4,'admin33',1,'2023-12-08 19:21:24','2023-12-08 19:23:54');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sousdomaines`
--

DROP TABLE IF EXISTS `sousdomaines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sousdomaines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomSousDomaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sousdomaines_nomsousdomaine_unique` (`nomSousDomaine`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sousdomaines`
--

LOCK TABLES `sousdomaines` WRITE;
/*!40000 ALTER TABLE `sousdomaines` DISABLE KEYS */;
INSERT INTO `sousdomaines` VALUES (1,'cdsncjknkdss sdsbjds','fichiers/sousDomaine/r8ID1dV7RDqlUpEadpc6uNO3nMqfYddaEcGej7KA.png','sdijbm msjkjks',1,'2023-12-08 18:37:46','2023-12-08 20:09:05'),(2,'dev webdfg','fichiers/sousDomaine/WfCLal2leS400FtZ07hs3nmJfimBKpXfnkN9bDZR.png','a cjkbjb kncs nksalbb ,sc',0,'2023-12-08 20:06:17','2023-12-08 20:06:17');
/*!40000 ALTER TABLE `sousdomaines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedeNaissance` date NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `estArchive` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_domaine_id_foreign` (`domaine_id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_domaine_id_foreign` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tesggg','teste','Admin','2003-01-01','7711233658','$2y$12$QJCU/.uyDwOwkER/CI5ofOsGKgw4tx8lQRQRlfy2y6NmnZ1Y3OfAW',1,1,0,NULL,NULL,'2023-12-08 13:07:37','2023-12-08 13:07:37'),(2,'tesggg','teste','mentore@gmail.com','2003-01-01','7711233652','$2y$12$pTH18wAGMq8UAjxSBAb1XOmo5i1kESn57ryP646C/dxnKmV8iX5VO',1,2,0,NULL,NULL,'2023-12-08 13:14:24','2023-12-08 13:14:24'),(3,'tesggg','teste','mentor@gmail.com','2003-01-01','7711233652','$2y$12$ak1BwViWG2Q3D59pab6zYOrzvsxb9/GJRW.AzY9kUd.ugavOiDA9W',1,3,0,NULL,NULL,'2023-12-08 13:14:40','2023-12-08 13:14:40'),(4,'gdfuyx','xsagxcgx','faye03','2000-02-02','777766655','$2y$12$xpez5XYtA2O3LcI2QhCgb.MldzpxStKm6dUDaM9JcnF4C434tDKvG',1,2,0,NULL,NULL,'2023-12-09 16:26:30','2023-12-09 16:26:30'),(5,'gdfuyx','xsagxcgx','faye04','2000-02-02','777766655','$2y$12$sKYQ4PaawXyz11.VSgiNduNM1OsdK1uFY/XhGR0Xh2s8I7rPNhGZC',1,2,0,NULL,NULL,'2023-12-09 16:27:00','2023-12-09 16:27:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-10 12:39:01
