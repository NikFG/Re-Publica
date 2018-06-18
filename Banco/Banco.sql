-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DBrepublica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DBrepublica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DBrepublica` DEFAULT CHARACTER SET utf8 ;
USE `DBrepublica` ;

-- -----------------------------------------------------
-- Table `DBrepublica`.`TbPessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`TbPessoa` (
  `idTbPessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `rg` CHAR(11) NOT NULL,
  PRIMARY KEY (`idTbPessoa`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `rg_UNIQUE` (`rg` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`UF`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`UF` (
  `idUF` INT NOT NULL AUTO_INCREMENT,
  `nomeUf` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUF`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`Municipio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`Municipio` (
  `idMunicipio` INT NOT NULL AUTO_INCREMENT,
  `nomeMunicipio` VARCHAR(45) NOT NULL,
  `UF_idUF` INT NOT NULL,
  PRIMARY KEY (`idMunicipio`),
  INDEX `fk_Municipio_UF1_idx` (`UF_idUF` ASC),
  CONSTRAINT `fk_Municipio_UF1`
    FOREIGN KEY (`UF_idUF`)
    REFERENCES `DBrepublica`.`UF` (`idUF`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`Bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`Bairro` (
  `idBairro` INT NOT NULL AUTO_INCREMENT,
  `nomeBairro` VARCHAR(45) NOT NULL,
  `Municipio_idMunicipio` INT NOT NULL,
  PRIMARY KEY (`idBairro`),
  INDEX `fk_Bairro_Municipio1_idx` (`Municipio_idMunicipio` ASC),
  CONSTRAINT `fk_Bairro_Municipio1`
    FOREIGN KEY (`Municipio_idMunicipio`)
    REFERENCES `DBrepublica`.`Municipio` (`idMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`Logradouro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`Logradouro` (
  `idLogradouro` INT NOT NULL AUTO_INCREMENT,
  `tipoLogradouro` VARCHAR(45) NOT NULL,
  `nomeLogradouro` VARCHAR(45) NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  PRIMARY KEY (`idLogradouro`),
  INDEX `fk_Logradouro_Bairro1_idx` (`Bairro_idBairro` ASC),
  CONSTRAINT `fk_Logradouro_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `DBrepublica`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`TbRepublica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`TbRepublica` (
  `idRepublica` INT NOT NULL AUTO_INCREMENT,
  `nomeRepublica` VARCHAR(45) NOT NULL,
  `numeroRepublica` VARCHAR(5) NOT NULL,
  `cep` INT(8) NOT NULL,
  `numQuartosRepublica` INT NOT NULL,
  `descricaoRepublica` LONGTEXT NOT NULL,
  `precoRepublica` REAL NOT NULL,
  `zipzaporungaRepublica` CHAR(11) NOT NULL,
  `idPessoa` INT NOT NULL,
  `Logradouro_idLogradouro` INT NOT NULL,
  PRIMARY KEY (`idRepublica`),
  INDEX `idPessoa_idx` (`idPessoa` ASC),
  INDEX `fk_TbRepublica_Logradouro1_idx` (`Logradouro_idLogradouro` ASC),
  CONSTRAINT `idPessoa`
    FOREIGN KEY (`idPessoa`)
    REFERENCES `DBrepublica`.`TbPessoa` (`idTbPessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TbRepublica_Logradouro1`
    FOREIGN KEY (`Logradouro_idLogradouro`)
    REFERENCES `DBrepublica`.`Logradouro` (`idLogradouro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`TbImagemRepublica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`TbImagemRepublica` (
  `idTbImagemRepublica` INT NOT NULL AUTO_INCREMENT,
  `imagemRepublica` BLOB NOT NULL,
  `TbRepublica_idRepublica` INT NOT NULL,
  `Descricao` TEXT NOT NULL,
  PRIMARY KEY (`idTbImagemRepublica`),
  INDEX `fk_TbImagemRepublica_TbRepublica1_idx` (`TbRepublica_idRepublica` ASC),
  CONSTRAINT `fk_TbImagemRepublica_TbRepublica1`
    FOREIGN KEY (`TbRepublica_idRepublica`)
    REFERENCES `DBrepublica`.`TbRepublica` (`idRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`Vizualizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`Vizualizacao` (
  `idVizualizacao` INT NOT NULL AUTO_INCREMENT,
  `dataInicio` DATE NOT NULL,
  `dataTermino` DATE NOT NULL,
  `TbRepublica_idRepublica` INT NOT NULL,
  PRIMARY KEY (`idVizualizacao`, `TbRepublica_idRepublica`),
  INDEX `fk_Vizualizacao_TbRepublica1_idx` (`TbRepublica_idRepublica` ASC),
  CONSTRAINT `fk_Vizualizacao_TbRepublica1`
    FOREIGN KEY (`TbRepublica_idRepublica`)
    REFERENCES `DBrepublica`.`TbRepublica` (`idRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`Assinatura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`Assinatura` (
  `idAssinatura` INT NOT NULL AUTO_INCREMENT,
  `descricaoAssinatura` VARCHAR(45) NOT NULL,
  `valorAssinatura` REAL NOT NULL,
  PRIMARY KEY (`idAssinatura`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBrepublica`.`AssinaturaTbRepublica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBrepublica`.`AssinaturaTbRepublica` (
  `Assinatura_idAssinatura` INT NOT NULL,
  `TbRepublica_idRepublica` INT NOT NULL,
  `dataInicio` DATE NOT NULL,
  `dataTermino` DATE NOT NULL,
  PRIMARY KEY (`Assinatura_idAssinatura`, `TbRepublica_idRepublica`),
  INDEX `fk_Assinatura_has_TbRepublica_TbRepublica1_idx` (`TbRepublica_idRepublica` ASC),
  INDEX `fk_Assinatura_has_TbRepublica_Assinatura1_idx` (`Assinatura_idAssinatura` ASC),
  CONSTRAINT `fk_Assinatura_has_TbRepublica_Assinatura1`
    FOREIGN KEY (`Assinatura_idAssinatura`)
    REFERENCES `DBrepublica`.`Assinatura` (`idAssinatura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Assinatura_has_TbRepublica_TbRepublica1`
    FOREIGN KEY (`TbRepublica_idRepublica`)
    REFERENCES `DBrepublica`.`TbRepublica` (`idRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
