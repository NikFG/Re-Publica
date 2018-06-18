-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 18-Jun-2018 às 16:56
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrepublica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assinatura`
--

DROP TABLE IF EXISTS `assinatura`;
CREATE TABLE IF NOT EXISTS `assinatura` (
  `idAssinatura` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoAssinatura` varchar(45) NOT NULL,
  `valorAssinatura` double NOT NULL,
  PRIMARY KEY (`idAssinatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assinaturatbrepublica`
--

DROP TABLE IF EXISTS `assinaturatbrepublica`;
CREATE TABLE IF NOT EXISTS `assinaturatbrepublica` (
  `Assinatura_idAssinatura` int(11) NOT NULL,
  `TbRepublica_idRepublica` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataTermino` date NOT NULL,
  PRIMARY KEY (`Assinatura_idAssinatura`,`TbRepublica_idRepublica`),
  KEY `fk_Assinatura_has_TbRepublica_TbRepublica1_idx` (`TbRepublica_idRepublica`),
  KEY `fk_Assinatura_has_TbRepublica_Assinatura1_idx` (`Assinatura_idAssinatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

DROP TABLE IF EXISTS `bairro`;
CREATE TABLE IF NOT EXISTS `bairro` (
  `idBairro` int(11) NOT NULL AUTO_INCREMENT,
  `nomeBairro` varchar(45) NOT NULL,
  `Municipio_idMunicipio` int(11) NOT NULL,
  PRIMARY KEY (`idBairro`),
  KEY `fk_Bairro_Municipio1_idx` (`Municipio_idMunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logradouro`
--

DROP TABLE IF EXISTS `logradouro`;
CREATE TABLE IF NOT EXISTS `logradouro` (
  `idLogradouro` int(11) NOT NULL AUTO_INCREMENT,
  `tipoLogradouro` varchar(45) NOT NULL,
  `nomeLogradouro` varchar(45) NOT NULL,
  `Bairro_idBairro` int(11) NOT NULL,
  PRIMARY KEY (`idLogradouro`),
  KEY `fk_Logradouro_Bairro1_idx` (`Bairro_idBairro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `idMunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMunicipio` varchar(45) NOT NULL,
  `UF_idUF` int(11) NOT NULL,
  PRIMARY KEY (`idMunicipio`),
  KEY `fk_Municipio_UF1_idx` (`UF_idUF`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbimagemrepublica`
--

DROP TABLE IF EXISTS `tbimagemrepublica`;
CREATE TABLE IF NOT EXISTS `tbimagemrepublica` (
  `idTbImagemRepublica` int(11) NOT NULL AUTO_INCREMENT,
  `imagemRepublica` blob NOT NULL,
  `TbRepublica_idRepublica` int(11) NOT NULL,
  `Descricao` text NOT NULL,
  PRIMARY KEY (`idTbImagemRepublica`),
  KEY `fk_TbImagemRepublica_TbRepublica1_idx` (`TbRepublica_idRepublica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpessoa`
--

DROP TABLE IF EXISTS `tbpessoa`;
CREATE TABLE IF NOT EXISTS `tbpessoa` (
  `idTbPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `cpf` char(11) NOT NULL,
  `rg` char(11) NOT NULL,
  PRIMARY KEY (`idTbPessoa`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrepublica`
--

DROP TABLE IF EXISTS `tbrepublica`;
CREATE TABLE IF NOT EXISTS `tbrepublica` (
  `idRepublica` int(11) NOT NULL AUTO_INCREMENT,
  `nomeRepublica` varchar(45) NOT NULL,
  `numeroRepublica` varchar(5) NOT NULL,
  `cep` int(8) NOT NULL,
  `numQuartosRepublica` int(11) NOT NULL,
  `descricaoRepublica` longtext NOT NULL,
  `precoRepublica` double NOT NULL,
  `zipzaporungaRepublica` char(11) NOT NULL,
  `idPessoa` int(11) NOT NULL,
  `Logradouro_idLogradouro` int(11) NOT NULL,
  `sexo` tinyint(4) NOT NULL,
  PRIMARY KEY (`idRepublica`),
  KEY `idPessoa_idx` (`idPessoa`),
  KEY `fk_TbRepublica_Logradouro1_idx` (`Logradouro_idLogradouro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

DROP TABLE IF EXISTS `uf`;
CREATE TABLE IF NOT EXISTS `uf` (
  `idUF` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUf` varchar(45) NOT NULL,
  PRIMARY KEY (`idUF`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vizualizacao`
--

DROP TABLE IF EXISTS `vizualizacao`;
CREATE TABLE IF NOT EXISTS `vizualizacao` (
  `idVizualizacao` int(11) NOT NULL AUTO_INCREMENT,
  `dataInicio` date NOT NULL,
  `dataTermino` date NOT NULL,
  `TbRepublica_idRepublica` int(11) NOT NULL,
  PRIMARY KEY (`idVizualizacao`,`TbRepublica_idRepublica`),
  KEY `fk_Vizualizacao_TbRepublica1_idx` (`TbRepublica_idRepublica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `assinaturatbrepublica`
--
ALTER TABLE `assinaturatbrepublica`
  ADD CONSTRAINT `fk_Assinatura_has_TbRepublica_Assinatura1` FOREIGN KEY (`Assinatura_idAssinatura`) REFERENCES `assinatura` (`idAssinatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assinatura_has_TbRepublica_TbRepublica1` FOREIGN KEY (`TbRepublica_idRepublica`) REFERENCES `tbrepublica` (`idRepublica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `fk_Bairro_Municipio1` FOREIGN KEY (`Municipio_idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `logradouro`
--
ALTER TABLE `logradouro`
  ADD CONSTRAINT `fk_Logradouro_Bairro1` FOREIGN KEY (`Bairro_idBairro`) REFERENCES `bairro` (`idBairro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_Municipio_UF1` FOREIGN KEY (`UF_idUF`) REFERENCES `uf` (`idUF`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbimagemrepublica`
--
ALTER TABLE `tbimagemrepublica`
  ADD CONSTRAINT `fk_TbImagemRepublica_TbRepublica1` FOREIGN KEY (`TbRepublica_idRepublica`) REFERENCES `tbrepublica` (`idRepublica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbrepublica`
--
ALTER TABLE `tbrepublica`
  ADD CONSTRAINT `fk_TbRepublica_Logradouro1` FOREIGN KEY (`Logradouro_idLogradouro`) REFERENCES `logradouro` (`idLogradouro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPessoa` FOREIGN KEY (`idPessoa`) REFERENCES `tbpessoa` (`idTbPessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vizualizacao`
--
ALTER TABLE `vizualizacao`
  ADD CONSTRAINT `fk_Vizualizacao_TbRepublica1` FOREIGN KEY (`TbRepublica_idRepublica`) REFERENCES `tbrepublica` (`idRepublica`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
