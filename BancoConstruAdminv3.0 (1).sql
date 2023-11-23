CREATE DATABASE  IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tcc`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tcc
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `arquivo`
--

DROP TABLE IF EXISTS `arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arquivo` (
  `idArquivo` bigint unsigned NOT NULL AUTO_INCREMENT,
  `caminho` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extensao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Obras_IdObras` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idArquivo`),
  KEY `arquivo_obras_idobras_foreign` (`Obras_IdObras`),
  CONSTRAINT `arquivo_obras_idobras_foreign` FOREIGN KEY (`Obras_IdObras`) REFERENCES `obras` (`idObras`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivo`
--

LOCK TABLES `arquivo` WRITE;
/*!40000 ALTER TABLE `arquivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividade`
--

DROP TABLE IF EXISTS `atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atividade` (
  `idAtividade` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etiqueta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anexo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descrição` longtext COLLATE utf8mb4_unicode_ci,
  `dtFinal` date NOT NULL,
  `dtInicial` date NOT NULL,
  `status` enum('COMEÇANDO','ANDAMENTO','FINALIZADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COMEÇANDO',
  `responsavel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Obras_idObras` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idAtividade`),
  KEY `atividade_obras_idobras_foreign` (`Obras_idObras`),
  CONSTRAINT `atividade_obras_idobras_foreign` FOREIGN KEY (`Obras_idObras`) REFERENCES `obras` (`idObras`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividade`
--

LOCK TABLES `atividade` WRITE;
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atribuicao_usuario`
--

DROP TABLE IF EXISTS `atribuicao_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atribuicao_usuario` (
  `id_atribuicao` bigint unsigned NOT NULL AUTO_INCREMENT,
  `atribuição` enum('COMUM','EMPRESA','SUPEVISOR','APONTADOR','ENGENHEIRO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_atribuicao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atribuicao_usuario`
--

LOCK TABLES `atribuicao_usuario` WRITE;
/*!40000 ALTER TABLE `atribuicao_usuario` DISABLE KEYS */;
INSERT INTO `atribuicao_usuario` VALUES (1,'EMPRESA','2023-11-22 23:39:24','2023-11-22 23:39:25'),(2,'SUPEVISOR','2023-11-22 23:39:30','2023-11-22 23:39:30'),(3,'APONTADOR','2023-11-22 23:39:35','2023-11-22 23:39:36'),(4,'ENGENHEIRO','2023-11-22 23:39:40','2023-11-22 23:39:41'),(5,'COMUM','2023-11-22 23:39:45','2023-11-22 23:39:45');
/*!40000 ALTER TABLE `atribuicao_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque` (
  `idEstoque` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomeEstoque` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idEstoque`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` VALUES (1,'EstoqueEmpresa','2023-11-22 23:39:14','2023-11-22 23:39:15');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_atividade`
--

DROP TABLE IF EXISTS `lista_atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_atividade` (
  `Atividade_idAtividade` bigint unsigned NOT NULL,
  `Usuarios_idUsuario` bigint unsigned NOT NULL,
  PRIMARY KEY (`Atividade_idAtividade`,`Usuarios_idUsuario`),
  KEY `lista_atividade_usuarios_idusuario_foreign` (`Usuarios_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_atividade`
--

LOCK TABLES `lista_atividade` WRITE;
/*!40000 ALTER TABLE `lista_atividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_materiais_necessarios`
--

DROP TABLE IF EXISTS `lista_materiais_necessarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_materiais_necessarios` (
  `Obras_idObras` bigint unsigned NOT NULL,
  `Materiais_idMateriais` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `lista_materiais_necessarios_materiais_idmateriais_foreign` (`Materiais_idMateriais`),
  KEY `lista_materiais_necessarios_obras_idobras_foreign` (`Obras_idObras`),
  CONSTRAINT `lista_materiais_necessarios_materiais_idmateriais_foreign` FOREIGN KEY (`Materiais_idMateriais`) REFERENCES `materiais_estoque` (`idMateriais`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lista_materiais_necessarios_obras_idobras_foreign` FOREIGN KEY (`Obras_idObras`) REFERENCES `obras` (`idObras`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_materiais_necessarios`
--

LOCK TABLES `lista_materiais_necessarios` WRITE;
/*!40000 ALTER TABLE `lista_materiais_necessarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_materiais_necessarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_obras`
--

DROP TABLE IF EXISTS `lista_obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_obras` (
  `Obras_idObras` bigint unsigned NOT NULL,
  `Usuario_idUsuario` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `lista_obras_obras_idobras_foreign` (`Obras_idObras`),
  KEY `lista_obras_usuario_idusuario_foreign` (`Usuario_idUsuario`),
  CONSTRAINT `lista_obras_obras_idobras_foreign` FOREIGN KEY (`Obras_idObras`) REFERENCES `obras` (`idObras`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lista_obras_usuario_idusuario_foreign` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_obras`
--

LOCK TABLES `lista_obras` WRITE;
/*!40000 ALTER TABLE `lista_obras` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais_estoque`
--

DROP TABLE IF EXISTS `materiais_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiais_estoque` (
  `idMateriais` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Estoque_idEstoque` bigint unsigned NOT NULL,
  `kg` decimal(5,2) NOT NULL,
  `nomeM` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metros` decimal(38,4) DEFAULT NULL,
  `quantidade` int NOT NULL,
  `dtVencimento` date DEFAULT NULL,
  `dtEntrada` date NOT NULL,
  `dtSaida` date DEFAULT NULL,
  `Status_2` enum('usado','novo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMateriais`),
  KEY `materiais_estoque_estoque_idestoque_foreign` (`Estoque_idEstoque`),
  CONSTRAINT `materiais_estoque_estoque_idestoque_foreign` FOREIGN KEY (`Estoque_idEstoque`) REFERENCES `estoque` (`idEstoque`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais_estoque`
--

LOCK TABLES `materiais_estoque` WRITE;
/*!40000 ALTER TABLE `materiais_estoque` DISABLE KEYS */;
INSERT INTO `materiais_estoque` VALUES (1,1,10.00,'Materia Teste',5.0000,10,'2023-11-22','2023-11-22',NULL,'novo','2023-11-22 23:40:29','2023-11-22 23:40:40');
/*!40000 ALTER TABLE `materiais_estoque` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2023_11_07_00001_obras',1),(3,'2023_11_07_00003_create_estoque_table',1),(4,'2023_11_07_00004_create_atribuicao_usuario_table',1),(5,'2023_11_07_00005_create_usuarios_table',1),(6,'2023_11_07_00006_create_telefone_usuarios_table',1),(7,'2023_11_07_00007_create_lista_obras_table',1),(8,'2023_11_07_00008_create_atividades_table',1),(9,'2023_11_07_00009_lista_atividade_table',1),(10,'2023_11_07_00010_create_materiais_estoque_table',1),(11,'2023_11_07_00011_lista_materiais_necessarios_table',1),(12,'2023_11_07_00015_arquivo',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obras` (
  `idObras` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Andamento','Finalizado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanho` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('Residencial','Comercial','Industrial','Infraestrutura','Saneamento','Restauro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numResidencial` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrutura` enum('Metálica','Concreto','Madeira') COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposito` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtFinal` date DEFAULT NULL,
  `dtInicial` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idObras`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'Obra1','Andamento','Teste','10','Residencial','Rua Teste','02','Bairro Teste','Cidade Teste','Estado Teste','41130120','Metálica','Teste',NULL,'2023-11-22','2023-11-22 23:38:53','2023-11-22 23:38:54');
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_usuarios`
--

DROP TABLE IF EXISTS `telefone_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telefone_usuarios` (
  `telefone` bigint NOT NULL,
  `Usuarios_idUsuario` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `telefone_usuarios_usuarios_idusuario_foreign` (`Usuarios_idUsuario`),
  CONSTRAINT `telefone_usuarios_usuarios_idusuario_foreign` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_usuarios`
--

LOCK TABLES `telefone_usuarios` WRITE;
/*!40000 ALTER TABLE `telefone_usuarios` DISABLE KEYS */;
INSERT INTO `telefone_usuarios` VALUES (7187091387,1,'2023-11-22 23:42:38','2023-11-22 23:42:39'),(7109435687,1,'2023-11-22 23:42:53','2023-11-22 23:42:53');
/*!40000 ALTER TABLE `telefone_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuario` bigint unsigned NOT NULL AUTO_INCREMENT,
  `atribuicao_Usuario_id_Atribuicao` bigint unsigned NOT NULL,
  `Estoque_idEstoque` bigint unsigned NOT NULL,
  `Superior_idUsuario` bigint unsigned DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` enum('FEMININO','MASCULINO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuarios_cpf_unique` (`cpf`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_atribuicao_usuario_id_atribuicao_foreign` (`atribuicao_Usuario_id_Atribuicao`),
  KEY `usuarios_estoque_idestoque_foreign` (`Estoque_idEstoque`),
  KEY `usuarios_superior_idusuario_foreign` (`Superior_idUsuario`),
  CONSTRAINT `usuarios_atribuicao_usuario_id_atribuicao_foreign` FOREIGN KEY (`atribuicao_Usuario_id_Atribuicao`) REFERENCES `atribuicao_usuario` (`id_atribuicao`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usuarios_estoque_idestoque_foreign` FOREIGN KEY (`Estoque_idEstoque`) REFERENCES `estoque` (`idEstoque`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usuarios_superior_idusuario_foreign` FOREIGN KEY (`Superior_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,1,NULL,'12345','ADM','Peixoto','MASCULINO','41130120','000000','Brasil','Salvador','Bahia','teste@gmail.com','2023-11-22 23:42:13','2023-11-22 23:42:15');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-22 20:59:51
