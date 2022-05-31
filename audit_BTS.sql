-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 mai 2022 à 21:07
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `audit`
--

-- --------------------------------------------------------

--
-- Structure de la table `audit`
--

DROP TABLE IF EXISTS `audit`;
CREATE TABLE IF NOT EXISTS `audit` (
  `AUDIT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDER_FORM_ID` int(11) DEFAULT NULL,
  `COMPANY_NAME` char(64) DEFAULT NULL,
  `CLIENT_NB` char(32) DEFAULT NULL,
  `HEAD_OFFICE` char(64) DEFAULT NULL,
  `AUDITED_SITE` char(128) DEFAULT NULL,
  `CONTROLLED_ACTIVITY` char(255) DEFAULT NULL,
  `STRUCTURE_ID` int(11) DEFAULT NULL,
  `SUBCONTRACTING_ID` int(11) DEFAULT NULL,
  `CONTROL_TYPE_ID` int(11) DEFAULT NULL,
  `CO_AUDITOR` varchar(255) DEFAULT NULL,
  `AUDITOR_CONCLUSION` text,
  `RISKNOTATION_ID` int(11) DEFAULT NULL,
  `VIGILANCE` text,
  `RECOMMENDATION` text,
  `COMPLEMENTARY_AUDIT` tinyint(1) DEFAULT NULL,
  `UNANNOUNCED_CONTROL` tinyint(1) DEFAULT NULL,
  `ATTACHMENT` tinyint(1) DEFAULT NULL,
  `ATTACHMENT_DETAILS` char(255) DEFAULT NULL,
  `STATUS_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` date DEFAULT NULL,
  `FINALIZATION_DATE` date DEFAULT NULL,
  PRIMARY KEY (`AUDIT_ID`),
  KEY `FK_AUDIT_RISK_NOTATION` (`RISKNOTATION_ID`),
  KEY `FK_AUDIT_CONTROL_TYPE` (`CONTROL_TYPE_ID`),
  KEY `FK_AUDIT_SUBCONTRACTING` (`SUBCONTRACTING_ID`),
  KEY `FK_AUDIT_STRUCTURE` (`STRUCTURE_ID`),
  KEY `FK_AUDIT_STATUS` (`STATUS_ID`),
  KEY `FK_AUDIT_ORDER_FORM` (`ORDER_FORM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `audit_date`
--

DROP TABLE IF EXISTS `audit_date`;
CREATE TABLE IF NOT EXISTS `audit_date` (
  `AUDIT_ID` int(11) NOT NULL,
  `DATE` char(32) NOT NULL,
  `START_HOUR` time DEFAULT NULL,
  `END_HOUR` time DEFAULT NULL,
  PRIMARY KEY (`AUDIT_ID`,`DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `OPINION_ID` int(11) DEFAULT NULL,
  `AUDIT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  PRIMARY KEY (`AUDIT_ID`,`USER_ID`),
  KEY `FK_COMMENT_OPINION` (`OPINION_ID`),
  KEY `FK_COMMENT_USER` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `control_type`
--

DROP TABLE IF EXISTS `control_type`;
CREATE TABLE IF NOT EXISTS `control_type` (
  `CONTROL_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(64) NOT NULL,
  `LABEL_EN` char(64) NOT NULL,
  PRIMARY KEY (`CONTROL_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `control_type`
--

INSERT INTO `control_type` (`CONTROL_TYPE_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Contrôle initial', 'Initial check'),
(2, 'Audit de renouvellement', 'Renewal check'),
(3, 'Contrôle inopiné', 'Unannounced check');

-- --------------------------------------------------------

--
-- Structure de la table `criterion`
--

DROP TABLE IF EXISTS `criterion`;
CREATE TABLE IF NOT EXISTS `criterion` (
  `REQUIREMENTTYPE_ID` int(11) NOT NULL,
  `REQUIREMENT_ID` int(11) NOT NULL,
  `ID_CRITERIA` int(11) NOT NULL,
  `DESCRIPTION_FR` text,
  `DESCRIPTION_EN` text,
  `CORRECTION_FR` text,
  `CORRECTION_EN` text,
  PRIMARY KEY (`REQUIREMENTTYPE_ID`,`REQUIREMENT_ID`,`ID_CRITERIA`),
  KEY `ID_CRITERIA` (`ID_CRITERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `criterion`
--

INSERT INTO `criterion` (`REQUIREMENTTYPE_ID`, `REQUIREMENT_ID`, `ID_CRITERIA`, `DESCRIPTION_FR`, `DESCRIPTION_EN`, `CORRECTION_FR`, `CORRECTION_EN`) VALUES
(1, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(1, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(1, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(1, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(1, 1, 5, NULL, NULL, NULL, NULL),
(1, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(1, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(1, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(1, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(1, 2, 5, NULL, NULL, NULL, NULL),
(1, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(1, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(1, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(1, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(1, 3, 5, NULL, NULL, NULL, NULL),
(1, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(1, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(1, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(1, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(1, 4, 5, NULL, NULL, NULL, NULL),
(1, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(1, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(1, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(1, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(1, 5, 5, NULL, NULL, NULL, NULL),
(2, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 1, 5, NULL, NULL, NULL, NULL),
(2, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 2, 5, NULL, NULL, NULL, NULL),
(2, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 3, 5, NULL, NULL, NULL, NULL),
(2, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 4, 5, NULL, NULL, NULL, NULL),
(2, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 5, 5, NULL, NULL, NULL, NULL),
(2, 6, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 6, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 6, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 6, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 6, 5, NULL, NULL, NULL, NULL),
(2, 7, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 7, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 7, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 7, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 7, 5, NULL, NULL, NULL, NULL),
(2, 8, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(2, 8, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(2, 8, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(2, 8, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(2, 8, 5, NULL, NULL, NULL, NULL),
(3, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(3, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(3, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(3, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(3, 1, 5, NULL, NULL, NULL, NULL),
(3, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(3, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(3, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(3, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(3, 2, 5, NULL, NULL, NULL, NULL),
(3, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(3, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(3, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(3, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(3, 3, 5, NULL, NULL, NULL, NULL),
(3, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(3, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(3, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(3, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(3, 4, 5, NULL, NULL, NULL, NULL),
(3, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(3, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(3, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(3, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(3, 5, 5, NULL, NULL, NULL, NULL),
(4, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 1, 5, NULL, NULL, NULL, NULL),
(4, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 2, 5, NULL, NULL, NULL, NULL),
(4, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 3, 5, NULL, NULL, NULL, NULL),
(4, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 4, 5, NULL, NULL, NULL, NULL),
(4, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 5, 5, NULL, NULL, NULL, NULL),
(4, 6, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 6, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 6, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 6, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 6, 5, NULL, NULL, NULL, NULL),
(4, 7, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(4, 7, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(4, 7, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(4, 7, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(4, 7, 5, NULL, NULL, NULL, NULL),
(5, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 1, 5, NULL, NULL, NULL, NULL),
(5, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 2, 5, NULL, NULL, NULL, NULL),
(5, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 3, 5, NULL, NULL, NULL, NULL),
(5, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 4, 5, NULL, NULL, NULL, NULL),
(5, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 5, 5, NULL, NULL, NULL, NULL),
(5, 6, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 6, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 6, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 6, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 6, 5, NULL, NULL, NULL, NULL),
(5, 7, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 7, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 7, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 7, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 7, 5, NULL, NULL, NULL, NULL),
(5, 8, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 8, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 8, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 8, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 8, 5, NULL, NULL, NULL, NULL),
(5, 9, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 9, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 9, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 9, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 9, 5, NULL, NULL, NULL, NULL),
(5, 10, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(5, 10, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(5, 10, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(5, 10, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(5, 10, 5, NULL, NULL, NULL, NULL),
(6, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(6, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(6, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(6, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(6, 1, 5, NULL, NULL, NULL, NULL),
(6, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(6, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(6, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(6, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(6, 2, 5, NULL, NULL, NULL, NULL),
(6, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(6, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(6, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(6, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(6, 3, 5, NULL, NULL, NULL, NULL),
(6, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(6, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(6, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(6, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(6, 4, 5, NULL, NULL, NULL, NULL),
(7, 1, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(7, 1, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(7, 1, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(7, 1, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(7, 1, 5, NULL, NULL, NULL, NULL),
(7, 2, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(7, 2, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(7, 2, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(7, 2, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(7, 2, 5, NULL, NULL, NULL, NULL),
(7, 3, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(7, 3, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(7, 3, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(7, 3, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(7, 3, 5, NULL, NULL, NULL, NULL),
(7, 4, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(7, 4, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(7, 4, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(7, 4, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(7, 4, 5, NULL, NULL, NULL, NULL),
(7, 5, 1, 'Description critère 1', 'Criteria 1 description', 'Correction critère 1', 'Criteria 1 correction'),
(7, 5, 2, 'Description critère 2', 'Criteria 2 description', 'Correction critère 2', 'Criteria 2 correction'),
(7, 5, 3, 'Description critère 3', 'Criteria 3 description', 'Correction critère 3', 'Criteria 3 correction'),
(7, 5, 4, 'Description critère 4', 'Criteria 4 description', 'Correction critère 4', 'Criteria 3 correction'),
(7, 5, 5, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `editor`
--

DROP TABLE IF EXISTS `editor`;
CREATE TABLE IF NOT EXISTS `editor` (
  `USER_ID` int(11) NOT NULL,
  `ORDER_FORM_ID` int(11) NOT NULL,
  PRIMARY KEY (`USER_ID`,`ORDER_FORM_ID`),
  KEY `I_FK_EDITOR_USER` (`USER_ID`),
  KEY `I_FK_EDITOR_ORDER_FORM` (`ORDER_FORM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evaluate`
--

DROP TABLE IF EXISTS `evaluate`;
CREATE TABLE IF NOT EXISTS `evaluate` (
  `RISK_ID` int(11) NOT NULL,
  `AUDIT_ID` int(11) NOT NULL,
  `RESULT` varchar(7) DEFAULT NULL,
  `CONTAMINATION` char(255) DEFAULT NULL,
  `AUDITOR_COMMENT` text,
  PRIMARY KEY (`RISK_ID`,`AUDIT_ID`),
  KEY `FK_EVALUATE_AUDIT` (`AUDIT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eve_exam`
--

DROP TABLE IF EXISTS `eve_exam`;
CREATE TABLE IF NOT EXISTS `eve_exam` (
  `EXAM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(32) NOT NULL,
  `LABEL_EN` varchar(32) NOT NULL,
  PRIMARY KEY (`EXAM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eve_exam`
--

INSERT INTO `eve_exam` (`EXAM_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Approuvé', 'Approuved'),
(2, 'Refusé', 'Rejected');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `HISTORY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(128) NOT NULL,
  `LABEL_EN` varchar(128) NOT NULL,
  PRIMARY KEY (`HISTORY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`HISTORY_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Première génération', 'First generation'),
(2, 'Problème qui a déjà fait l\'objet d\'une demande', 'Problem that has already been requested\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `letter`
--

DROP TABLE IF EXISTS `letter`;
CREATE TABLE IF NOT EXISTS `letter` (
  `ID_LETTER` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL` char(2) NOT NULL,
  `POINT` int(11) NOT NULL,
  PRIMARY KEY (`ID_LETTER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `letter`
--

INSERT INTO `letter` (`ID_LETTER`, `LABEL`, `POINT`) VALUES
(1, 'A', 20),
(2, 'B', 15),
(3, 'C', 5),
(4, 'D', -10),
(5, 'NA', 0);

-- --------------------------------------------------------

--
-- Structure de la table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
CREATE TABLE IF NOT EXISTS `opinion` (
  `OPINION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(255) NOT NULL,
  `LABEL_EN` varchar(255) NOT NULL,
  PRIMARY KEY (`OPINION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `opinion`
--

INSERT INTO `opinion` (`OPINION_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Avis favorable. Attention, seuls les produits présents sur le certificat peuvent être vendus avec le label.', 'Positive opinion. Attention, only the products present on the certificate can be sold with the label'),
(2, 'Avis favorable sous réserve d\'actions correctives listées dans la fiche de non-conformité CAPA.', 'Favourable opinion subject to corrective actions listed in the CAPA Report (major nonconformity)'),
(3, 'Avis défavorable.', 'Unfavourable opinion.');

-- --------------------------------------------------------

--
-- Structure de la table `order_form`
--

DROP TABLE IF EXISTS `order_form`;
CREATE TABLE IF NOT EXISTS `order_form` (
  `ORDER_FORM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AUDIT_ID` int(11) DEFAULT NULL,
  `CREATION_DATE` date DEFAULT NULL,
  `COMPANY_NAME` char(64) DEFAULT NULL,
  `CLIENT_NB` char(32) DEFAULT NULL,
  `PRESTATION_TYPE` char(64) DEFAULT NULL,
  `TYPE_CERTIF` char(32) DEFAULT NULL,
  `TYPE_AUDIT` char(32) DEFAULT NULL,
  `NBR_MONTH` int(11) DEFAULT NULL,
  `IS_DISTANCE` tinyint(1) DEFAULT NULL,
  `NB_REPORT` int(11) DEFAULT NULL,
  `PERIOD` char(64) DEFAULT NULL,
  `OFFICE_NAME` char(128) DEFAULT NULL,
  `OFFICE_ADDRESS` char(128) DEFAULT NULL,
  `OFFICE_POSTAL` int(11) DEFAULT NULL,
  `OFFICE_CITY` char(32) DEFAULT NULL,
  `OFFICE_COUNTRY` char(32) DEFAULT NULL,
  `OFFICE_CONTACT_NAME` char(64) DEFAULT NULL,
  `OFFICE_CONTACT_FIRSTNAME` char(32) DEFAULT NULL,
  `OFFICE_CONTACT_FUNCTION` char(32) DEFAULT NULL,
  `OFFICE_CONTACT_MAIL` char(32) DEFAULT NULL,
  `OFFICE_CONTACT_PHONE` char(32) DEFAULT NULL,
  `FABRICATION_NAME` char(128) DEFAULT NULL,
  `FABRICATION_ADDRESS` char(128) DEFAULT NULL,
  `FABRICATION_POSTAL` int(11) DEFAULT NULL,
  `FABRICATION_CITY` char(32) DEFAULT NULL,
  `FABRICATION_COUNTRY` char(32) DEFAULT NULL,
  `FABRICATION_CONTACT_NAME` char(32) DEFAULT NULL,
  `FABRICATION_CONTACT_FIRSTNAME` char(32) DEFAULT NULL,
  `FABRICATION_CONTACT_FUNCTION` char(32) DEFAULT NULL,
  `FABRICATION_CONTACT_MAIL` char(32) DEFAULT NULL,
  `FABRICATION_CONTACT_PHONE` char(32) DEFAULT NULL,
  `STATUS` smallint(6) DEFAULT NULL,
  `APPLI_FIELD` varchar(32) DEFAULT NULL,
  `TIME_AUDIT` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ORDER_FORM_ID`),
  UNIQUE KEY `I_FK_ORDER_FORM_AUDIT` (`AUDIT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `PARTICIPANT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AUDIT_ID` int(11) NOT NULL,
  `NAME` char(32) NOT NULL,
  `FIRSTNAME` char(32) NOT NULL,
  `FUNCTION` char(32) NOT NULL,
  `PRESENCE_STEP1` tinyint(1) NOT NULL,
  `PRESENCE_STEP2` tinyint(1) NOT NULL,
  `PRESENCE_STEP3` tinyint(1) NOT NULL,
  `PRESENCE_STEP4` tinyint(1) NOT NULL,
  PRIMARY KEY (`AUDIT_ID`,`NAME`,`FIRSTNAME`,`FUNCTION`),
  UNIQUE KEY `PARTICIPANT_ID` (`PARTICIPANT_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `requirement`
--

DROP TABLE IF EXISTS `requirement`;
CREATE TABLE IF NOT EXISTS `requirement` (
  `REQUIREMENTTYPE_ID` int(11) NOT NULL,
  `REQUIREMENT_ID` int(11) NOT NULL,
  `REQUIREMENT_FR` text NOT NULL,
  `REQUIREMENT_EN` text NOT NULL,
  `EVALUATION_METHOD_FR` text NOT NULL,
  `EVALUATION_METHOD_EN` text NOT NULL,
  PRIMARY KEY (`REQUIREMENTTYPE_ID`,`REQUIREMENT_ID`),
  KEY `REQUIREMENT_ID` (`REQUIREMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `requirement`
--

INSERT INTO `requirement` (`REQUIREMENTTYPE_ID`, `REQUIREMENT_ID`, `REQUIREMENT_FR`, `REQUIREMENT_EN`, `EVALUATION_METHOD_FR`, `EVALUATION_METHOD_EN`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(1, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(4, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(6, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(6, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(6, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(6, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

-- --------------------------------------------------------

--
-- Structure de la table `requirement_type`
--

DROP TABLE IF EXISTS `requirement_type`;
CREATE TABLE IF NOT EXISTS `requirement_type` (
  `REQUIREMENTTYPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(255) NOT NULL,
  `LABEL_EN` char(255) NOT NULL,
  PRIMARY KEY (`REQUIREMENTTYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `requirement_type`
--

INSERT INTO `requirement_type` (`REQUIREMENTTYPE_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'RESPONSABILITES ET DIRECTION', 'RESPONSABILITIES AND MANAGEMENT'),
(2, 'EXIGENCES DE LA DECLARATIONS EVE VEGAN®', 'REQUIREMENTS STATEMENTS'),
(3, 'TESTS EN LABORATOIRE', 'LAB TESTS & ANIMALS'),
(4, 'PROCEDURES DE MAITRISE DES DANGERS', 'CONTROL OF HAZARDS'),
(5, 'MANAGEMENT DE LA QUALITE', 'QUALITY MANAGEMENT'),
(6, 'ZONE DE STOCKAGE', 'STORAGE'),
(7, 'ZONE DE PRODUCTION', 'MANUFACTURING SITE');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `REVIEW_ID` int(11) NOT NULL,
  `AUDIT_ID` int(11) NOT NULL,
  `ID_CRITERION` int(11) DEFAULT NULL,
  `EXAM_ID` int(11) DEFAULT NULL,
  `HISTORY_ID` int(11) DEFAULT NULL,
  `REQUIREMENTTYPE_ID` int(11) DEFAULT NULL,
  `REQUIREMENT_ID` int(11) DEFAULT NULL,
  `AUDITOR_COMMENT` varchar(255) DEFAULT NULL,
  `CORRECTION_COMMENT` varchar(255) DEFAULT NULL,
  `LIMIT_DATE` date DEFAULT NULL,
  `RETURN_DATE` char(32) DEFAULT NULL,
  `OPERATOR_IN_CHARGE` char(32) DEFAULT NULL,
  `OPERATOR_COMMENT` varchar(255) DEFAULT NULL,
  `ATTACHMENT` varchar(255) DEFAULT NULL,
  `LIBERATION_DATE` char(32) DEFAULT NULL,
  `LIBERATION_COMMENT` varchar(255) DEFAULT NULL,
  `SIGNATURE` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`REVIEW_ID`,`AUDIT_ID`),
  KEY `FK_REVIEW_AUDIT` (`AUDIT_ID`),
  KEY `FK_REVIEW_EVE_EXAM` (`EXAM_ID`),
  KEY `FK_REVIEW_HISTORY` (`HISTORY_ID`),
  KEY `FK_REVIEW_CRITERION` (`REQUIREMENTTYPE_ID`,`REQUIREMENT_ID`,`ID_CRITERION`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `risk`
--

DROP TABLE IF EXISTS `risk`;
CREATE TABLE IF NOT EXISTS `risk` (
  `RISK_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTION_CONDITION_FR` char(255) NOT NULL,
  `PRODUCTION_CONDITION_EN` char(255) NOT NULL,
  `VALUE` int(11) NOT NULL,
  PRIMARY KEY (`RISK_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `risk`
--

INSERT INTO `risk` (`RISK_ID`, `PRODUCTION_CONDITION_FR`, `PRODUCTION_CONDITION_EN`, `VALUE`) VALUES
(1, 'LIGNE DE PRODUCTION : Critère 1', 'PRODUCTION LINE: Criteria 1', 70),
(2, 'ATELIER DE PRODUCTION : Critère 2', 'PRODUCTION WORKSHOP: Criteria 2', 30),
(3, 'SITE DE PRODUCTION: Critère 3', 'PRODUCTION SITE: Criteria 3', 20),
(4, 'ESPACE DE STOCKAGE : Critère 4', 'STORAGE AREA: Criteria 4', 30),
(5, 'ESPACE DE STOCKAGE : Critère 5', 'STORAGE AREA: Criteria 5', 20),
(6, 'ZONE DE CONDITIONNEMENT : Critère 6', 'PACKAGING AREA: Criteria 6', 10),
(7, 'ZONE DE CONTRÔLE QUALITÉ : Critère 7', 'QUALITY CONTROL AREA : Criteria 7', 10),
(8, 'ZONE D\'EXPEDITION : Critère 8', 'SHIPPING AREA: Criteria 8', 10),
(9, 'ZONE DE RETOUR : Critère 9', 'RETURN AREA: Criteria 9', 10);

-- --------------------------------------------------------

--
-- Structure de la table `risk_notation`
--

DROP TABLE IF EXISTS `risk_notation`;
CREATE TABLE IF NOT EXISTS `risk_notation` (
  `RISKNOTATION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME_FR` char(32) NOT NULL,
  `NAME_EN` char(32) NOT NULL,
  `VALUE_START` int(11) NOT NULL,
  `VALUE_END` int(11) NOT NULL,
  PRIMARY KEY (`RISKNOTATION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `risk_notation`
--

INSERT INTO `risk_notation` (`RISKNOTATION_ID`, `NAME_FR`, `NAME_EN`, `VALUE_START`, `VALUE_END`) VALUES
(1, 'Risque faible', 'Low risk', -1, 61),
(2, 'Danger mineur', 'Minor danger', 60, 131),
(3, 'Danger modéré', 'Moderate danger', 130, 200),
(4, 'Danger prioritaire', 'Priority risk', 199, 211);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL` char(32) NOT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ROLE_ID`, `LABEL`) VALUES
(1, 'admin'),
(2, 'auditor');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(32) DEFAULT NULL,
  `LABEL_EN` char(32) NOT NULL,
  PRIMARY KEY (`STATUS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`STATUS_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(0, 'Créé', 'Created'),
(1, 'En cours de rédaction', 'In progress'),
(2, 'Délivré par l\'auditeur', 'Delivered by the auditor'),
(3, 'En cours de revue', 'Under review'),
(4, 'Non conformité(s)', 'Non conformity'),
(5, 'Clôturé', 'Closed'),
(6, 'Archivé', 'Archived');

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE IF NOT EXISTS `structure` (
  `STRUCTURE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(32) NOT NULL,
  `LABEL_EN` char(32) NOT NULL,
  PRIMARY KEY (`STRUCTURE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`STRUCTURE_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Activité 100% VEGAN', '100% VEGAN activity'),
(2, 'Activité mixte', 'Mixed activity');

-- --------------------------------------------------------

--
-- Structure de la table `subcontracting`
--

DROP TABLE IF EXISTS `subcontracting`;
CREATE TABLE IF NOT EXISTS `subcontracting` (
  `SUBCONTRACTING_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_FR` char(32) NOT NULL,
  `LABEL_EN` char(32) NOT NULL,
  PRIMARY KEY (`SUBCONTRACTING_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subcontracting`
--

INSERT INTO `subcontracting` (`SUBCONTRACTING_ID`, `LABEL_FR`, `LABEL_EN`) VALUES
(1, 'Fait appel a des façonniers', 'Uses sub-contractors'),
(2, 'Travaille en tant que façonnier', 'Work as a sub-contractor'),
(3, 'Non concerncé', 'Not concerned');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE_ID` int(11) NOT NULL,
  `NAME` char(32) NOT NULL,
  `MAIL` varchar(32) DEFAULT NULL,
  `PHONE` varchar(12) DEFAULT NULL,
  `FIRSTNAME` char(32) NOT NULL,
  `USERNAME` char(32) NOT NULL,
  `PASSWORD` char(128) NOT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`USER_ID`),
  KEY `FK_USER_ROLE` (`ROLE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`USER_ID`, `ROLE_ID`, `NAME`, `MAIL`, `PHONE`, `FIRSTNAME`, `USERNAME`, `PASSWORD`, `STATUS`) VALUES
(1, 1, 'Admin', '', '', '', 'admin', '$2y$10$AWnlVzDkeQ/cH1iM/TCpiOdea9K9EJzGnXvxbSuX/fdhYt8RLg9kO', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`USER_ID`) REFERENCES `fulbank`.`person` (`P_ID`),
  ADD CONSTRAINT `FK_USER_ROLE` FOREIGN KEY (`ROLE_ID`) REFERENCES `role` (`ROLE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
