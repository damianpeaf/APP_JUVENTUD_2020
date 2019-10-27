-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema App Juventud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema App Juventud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `App Juventud` DEFAULT CHARACTER SET utf8 ;
USE `App Juventud` ;

-- -----------------------------------------------------
-- Table `App Juventud`.`TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`TipoUsuario` (
  `idTipoUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`idTipoUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `App Juventud`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`Usuario` (
  `idTipoUsuario` INT UNSIGNED NOT NULL,
  `idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `contraseña` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_TipoUsuario_Usuario_idx` (`idTipoUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_TipoUsuario_Usuario`
    FOREIGN KEY (`idTipoUsuario`)
    REFERENCES `App Juventud`.`TipoUsuario` (`idTipoUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `App Juventud`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`Categoria` (
  `idCategoria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `App Juventud`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`Status` (
  `idStatus` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`idStatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `App Juventud`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`Evento` (
  `idStatus` INT UNSIGNED NOT NULL,
  `idUsuario` INT UNSIGNED NOT NULL,
  `idCategoria` INT UNSIGNED NOT NULL,
  `idEvento` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `inicia` DATETIME NOT NULL,
  `termina` DATETIME NOT NULL,
  `fechaDePublicacion` DATE NOT NULL DEFAULT current_time,
  `descripcion` TEXT NULL,
  `adjuntos` JSON NULL,
  PRIMARY KEY (`idEvento`),
  INDEX `fk_Categoria_Evento_idx` (`idCategoria` ASC) VISIBLE,
  INDEX `fk_Usuario_Evento_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `fk_Status_idx` (`idStatus` ASC) VISIBLE,
  CONSTRAINT `fk_Categoria_Evento`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `App Juventud`.`Categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Evento`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `App Juventud`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Status_Evento`
    FOREIGN KEY (`idStatus`)
    REFERENCES `App Juventud`.`Status` (`idStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `App Juventud`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `App Juventud`.`Post` (
  `idStatus` INT UNSIGNED NOT NULL,
  `idCategoria` INT UNSIGNED NOT NULL,
  `idUsuario` INT UNSIGNED NOT NULL,
  `idPost` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `fechaDePublicacion` DATETIME NOT NULL DEFAULT current_time,
  `contenido` TEXT NOT NULL,
  `adjuntos` JSON NULL,
  PRIMARY KEY (`idPost`),
  INDEX `fk_Categoria_Post_idx` (`idCategoria` ASC) VISIBLE,
  INDEX `fk_Usuario_Post_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `fk_Status_Post_idx` (`idStatus` ASC) VISIBLE,
  CONSTRAINT `fk_Categoria_Post`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `App Juventud`.`Categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Post`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `App Juventud`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Status_Post`
    FOREIGN KEY (`idStatus`)
    REFERENCES `App Juventud`.`Status` (`idStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
