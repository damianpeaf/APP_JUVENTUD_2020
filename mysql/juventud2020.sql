-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema app juventud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema app juventud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `app juventud` DEFAULT CHARACTER SET utf8mb4 ;
USE `app juventud` ;

-- -----------------------------------------------------
-- Table `app juventud`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`status` (
  `idStatus` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idStatus`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`categoria` (
  `idStatus` INT UNSIGNED NOT NULL,
  `idCategoria` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `color` VARCHAR(25) NOT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idCategoria`),
  INDEX `fk_Status_Categoria_idx` (`idStatus` ASC) VISIBLE,
  CONSTRAINT `fk_Status_Categoria`
    FOREIGN KEY (`idStatus`)
    REFERENCES `app juventud`.`status` (`idStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`tipousuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`tipousuario` (
  `idTipoUsuario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`usuario` (
  `idStatus` INT UNSIGNED NOT NULL,
  `idTipoUsuario` INT(10) UNSIGNED NOT NULL,
  `idUsuario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `contraseña` CHAR(60) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_TipoUsuario_Usuario_idx` (`idTipoUsuario` ASC) VISIBLE,
  INDEX `fk_Status_Usuario_idx` (`idStatus` ASC) VISIBLE,
  CONSTRAINT `fk_TipoUsuario_Usuario`
    FOREIGN KEY (`idTipoUsuario`)
    REFERENCES `app juventud`.`tipousuario` (`idTipoUsuario`),
  CONSTRAINT `fk_Status_Usuario`
    FOREIGN KEY (`idStatus`)
    REFERENCES `app juventud`.`status` (`idStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`evento` (
  `idStatus` INT(10) UNSIGNED NOT NULL,
  `idUsuario` INT(10) UNSIGNED NOT NULL,
  `idCategoria` INT(1) UNSIGNED NOT NULL,
  `idEvento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inicia` DATETIME NOT NULL,
  `termina` DATETIME NOT NULL,
  `fechaDePublicacion` DATETIME NOT NULL default current_timestamp,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  `adjuntos` JSON NULL DEFAULT NULL,
  PRIMARY KEY (`idEvento`),
  INDEX `fk_Categoria_Evento_idx` (`idCategoria` ASC) VISIBLE,
  INDEX `fk_Usuario_Evento_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `fk_Status_idx` (`idStatus` ASC) VISIBLE,
  CONSTRAINT `fk_Categoria_Evento`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `app juventud`.`categoria` (`idCategoria`),
  CONSTRAINT `fk_Status_Evento`
    FOREIGN KEY (`idStatus`)
    REFERENCES `app juventud`.`status` (`idStatus`),
  CONSTRAINT `fk_Usuario_Evento`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `app juventud`.`usuario` (`idUsuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`post` (
  `idStatus` INT(10) UNSIGNED NOT NULL,
  `idUsuario` INT(10) UNSIGNED NOT NULL,
  `idCategoria` INT(10) UNSIGNED NOT NULL,
  `idEvento` INT UNSIGNED NULL,
  `idPost` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `fechaDePublicacion` DATETIME NOT NULL default current_timestamp,
  `contenido` TEXT NOT NULL,
  `adjuntos` JSON NULL DEFAULT NULL,
  PRIMARY KEY (`idPost`),
  INDEX `fk_Categoria_Post_idx` (`idCategoria` ASC) VISIBLE,
  INDEX `fk_Usuario_Post_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `fk_Status_Post_idx` (`idStatus` ASC) VISIBLE,
  INDEX `fk_Evento_Post_idx` (`idEvento` ASC) VISIBLE,
  CONSTRAINT `fk_Categoria_Post`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `app juventud`.`categoria` (`idCategoria`),
  CONSTRAINT `fk_Status_Post`
    FOREIGN KEY (`idStatus`)
    REFERENCES `app juventud`.`status` (`idStatus`),
  CONSTRAINT `fk_Usuario_Post`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `app juventud`.`usuario` (`idUsuario`),
  CONSTRAINT `fk_Evento_Post`
    FOREIGN KEY (`idEvento`)
    REFERENCES `app juventud`.`evento` (`idEvento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app juventud`.`notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app juventud`.`notificacion` (

  `idNotificacion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `leido` bool default false NOT NULL,
  `idAdmin` INT UNSIGNED NOT NULL,
  `idCreador` INT UNSIGNED NOT NULL,
  `idEvento` INT UNSIGNED NULL,
  `idPost` INT UNSIGNED NULL,
  `mensaje` TEXT NOT NULL,
  PRIMARY KEY (`idNotificacion`),
    FOREIGN KEY (`idAdmin`)
    REFERENCES `app juventud`.`usuario` (`idUsuario`),
	FOREIGN KEY (`idCreador`)
    REFERENCES `app juventud`.`usuario` (`idUsuario`),
    FOREIGN KEY (`idPost`)
    REFERENCES `app juventud`.`post` (`idPost`),
    FOREIGN KEY (`idEvento`)
    REFERENCES `app juventud`.`evento` (`idEvento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
