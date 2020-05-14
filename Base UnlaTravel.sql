-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema unlatravel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema unlatravel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `unlatravel` DEFAULT CHARACTER SET utf8mb4 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ciudad` (
  `idCiudad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreCiudad` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCiudad`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comentarios` (
  `idComentarios` INT(11) NOT NULL AUTO_INCREMENT,
  `comentarios` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idComentarios`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`actividad` (
  `idActividad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreActividad` VARCHAR(45) NOT NULL,
  `calificacion` INT(11) NOT NULL,
  `Comentarios_idComentarios` INT(11) NOT NULL,
  `Ciudad_idCiudad` INT(11) NOT NULL,
  `precio` DECIMAL(10,0) NULL DEFAULT NULL,
  `Actividadcol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idActividad`),
  INDEX `fk_Actividad_Comentarios1_idx` (`Comentarios_idComentarios` ASC) VISIBLE,
  INDEX `fk_Actividad_Ciudad1_idx` (`Ciudad_idCiudad` ASC) VISIBLE,
  CONSTRAINT `fk_Actividad_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudad`)
    REFERENCES `mydb`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Actividad_Comentarios1`
    FOREIGN KEY (`Comentarios_idComentarios`)
    REFERENCES `mydb`.`comentarios` (`idComentarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`servicio` (
  `idServicio` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreServicio` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idServicio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`alojamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`alojamiento` (
  `idAlojamiento` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `categoria` INT(11) NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `cantidadHabInd` INT(11) NULL DEFAULT NULL,
  `cantidadHabDob` INT(11) NULL DEFAULT NULL,
  `Servicio_idServicio` INT(11) NOT NULL,
  `tipoPension` VARCHAR(45) NOT NULL,
  `Ciudad_idCiudad` INT(11) NOT NULL,
  PRIMARY KEY (`idAlojamiento`),
  INDEX `fk_Alojamiento_Servicio_idx` (`Servicio_idServicio` ASC) VISIBLE,
  INDEX `fk_Alojamiento_Ciudad1_idx` (`Ciudad_idCiudad` ASC) VISIBLE,
  CONSTRAINT `fk_Alojamiento_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudad`)
    REFERENCES `mydb`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alojamiento_Servicio`
    FOREIGN KEY (`Servicio_idServicio`)
    REFERENCES `mydb`.`servicio` (`idServicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pais` (
  `idPais` INT(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` VARCHAR(45) NOT NULL,
  `Ciudad_idCiudad` INT(11) NOT NULL,
  PRIMARY KEY (`idPais`),
  UNIQUE INDEX `nombrePais_UNIQUE` (`nombrePais` ASC) VISIBLE,
  INDEX `fk_Pais_Ciudad1_idx` (`Ciudad_idCiudad` ASC) VISIBLE,
  CONSTRAINT `fk_Pais_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudad`)
    REFERENCES `mydb`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT,
  `dni` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `perfil` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`reservaactividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reservaactividad` (
  `idReservaActividad` INT(11) NOT NULL,
  `fechaActividad` DATE NULL DEFAULT NULL,
  `Usuario_idCliente` INT(11) NOT NULL,
  `Actividad_idActividad` INT(11) NOT NULL,
  PRIMARY KEY (`idReservaActividad`),
  INDEX `fk_ReservaActividad_Usuario1_idx` (`Usuario_idCliente` ASC) VISIBLE,
  INDEX `fk_ReservaActividad_Actividad1_idx` (`Actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_ReservaActividad_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `mydb`.`actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReservaActividad_Usuario1`
    FOREIGN KEY (`Usuario_idCliente`)
    REFERENCES `mydb`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`reservaalojamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reservaalojamiento` (
  `idReservaAlojamiento` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaIngreso` DATE NOT NULL,
  `fechaSalida` DATE NOT NULL,
  `cantidadHabInd` INT(11) NULL DEFAULT NULL,
  `cantidadHabDob` INT(11) NULL DEFAULT NULL,
  `Alojamiento_idAlojamiento` INT(11) NOT NULL,
  `Usuario_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idReservaAlojamiento`),
  INDEX `fk_ReservaAlojamiento_Alojamiento1_idx` (`Alojamiento_idAlojamiento` ASC) VISIBLE,
  INDEX `fk_ReservaAlojamiento_Usuario1_idx` (`Usuario_idCliente` ASC) VISIBLE,
  CONSTRAINT `fk_ReservaAlojamiento_Alojamiento1`
    FOREIGN KEY (`Alojamiento_idAlojamiento`)
    REFERENCES `mydb`.`alojamiento` (`idAlojamiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReservaAlojamiento_Usuario1`
    FOREIGN KEY (`Usuario_idCliente`)
    REFERENCES `mydb`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`vuelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`vuelo` (
  `idVuelo` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaSalida` DATE NOT NULL,
  `fechaLlegada` DATE NOT NULL,
  `precio` DECIMAL(10,0) NOT NULL,
  `plazas` INT(11) NOT NULL,
  `Ciudad_idCiudadOrigen` INT(11) NOT NULL,
  `Ciudad_idCiudadDestino` INT(11) NOT NULL,
  PRIMARY KEY (`idVuelo`),
  INDEX `fk_Vuelo_Ciudad1_idx` (`Ciudad_idCiudadOrigen` ASC) VISIBLE,
  INDEX `fk_Vuelo_Ciudad2_idx` (`Ciudad_idCiudadDestino` ASC) VISIBLE,
  CONSTRAINT `fk_Vuelo_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudadOrigen`)
    REFERENCES `mydb`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vuelo_Ciudad2`
    FOREIGN KEY (`Ciudad_idCiudadDestino`)
    REFERENCES `mydb`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`reservavuelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reservavuelo` (
  `idReservaVuelo` INT(11) NOT NULL AUTO_INCREMENT,
  `plazas` INT(11) NOT NULL,
  `Vuelo_idVuelo` INT(11) NOT NULL,
  `Usuario_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idReservaVuelo`),
  INDEX `fk_ReservaVuelo_Vuelo1_idx` (`Vuelo_idVuelo` ASC) VISIBLE,
  INDEX `fk_ReservaVuelo_Usuario1_idx` (`Usuario_idCliente` ASC) VISIBLE,
  CONSTRAINT `fk_ReservaVuelo_Usuario1`
    FOREIGN KEY (`Usuario_idCliente`)
    REFERENCES `mydb`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReservaVuelo_Vuelo1`
    FOREIGN KEY (`Vuelo_idVuelo`)
    REFERENCES `mydb`.`vuelo` (`idVuelo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Pasajero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pasajero` (
  `idPasajero` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `dni` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  PRIMARY KEY (`idPasajero`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`perfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`perfiles` (
  `idperfiles` INT NOT NULL,
  `perfil` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idperfiles`))
ENGINE = InnoDB;

USE `unlatravel` ;

-- -----------------------------------------------------
-- Table `unlatravel`.`actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`actividad` (
  `idActividad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreActividad` VARCHAR(45) NOT NULL,
  `calificacionPromedio` INT(11) NOT NULL,
  `precio` DECIMAL(10,0) NULL DEFAULT NULL,
  `Actividadcol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idActividad`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`pais` (
  `idPais` INT(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPais`),
  UNIQUE INDEX `nombrePais_UNIQUE` (`nombrePais` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`ciudad` (
  `idCiudad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreCiudad` VARCHAR(45) NULL DEFAULT NULL,
  `pais_idPais` INT(11) NOT NULL,
  PRIMARY KEY (`idCiudad`),
  INDEX `fk_ciudad_pais1_idx` (`pais_idPais` ASC) VISIBLE,
  CONSTRAINT `fk_ciudad_pais1`
    FOREIGN KEY (`pais_idPais`)
    REFERENCES `unlatravel`.`pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`alojamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`alojamiento` (
  `idAlojamiento` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `categoria` INT(11) NOT NULL,
  `cantidadHabInd` INT(11) NULL DEFAULT NULL,
  `cantidadHabDob` INT(11) NULL DEFAULT NULL,
  `tipoPension` VARCHAR(45) NOT NULL,
  `Ciudad_idCiudad` INT(11) NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idAlojamiento`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `fk_Alojamiento_Ciudad1_idx` (`Ciudad_idCiudad` ASC) VISIBLE,
  CONSTRAINT `fk_Alojamiento_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudad`)
    REFERENCES `unlatravel`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`comentarios` (
  `idComentarios` INT(11) NOT NULL AUTO_INCREMENT,
  `comentarios` VARCHAR(45) NOT NULL,
  `calificacion` INT NOT NULL,
  `actividad_idActividad` INT(11) NOT NULL,
  PRIMARY KEY (`idComentarios`),
  INDEX `fk_comentarios_actividad1_idx` (`actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_comentarios_actividad1`
    FOREIGN KEY (`actividad_idActividad`)
    REFERENCES `unlatravel`.`actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`reservaactividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`reservaactividad` (
  `idReservaActividad` INT(11) NOT NULL,
  `fechaActividad` DATE NULL DEFAULT NULL,
  `Pasajero_idPasajero` INT NOT NULL,
  `actividad_idActividad` INT(11) NOT NULL,
  PRIMARY KEY (`idReservaActividad`),
  INDEX `fk_reservaactividad_Pasajero1_idx` (`Pasajero_idPasajero` ASC) VISIBLE,
  INDEX `fk_reservaactividad_actividad1_idx` (`actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_reservaactividad_Pasajero1`
    FOREIGN KEY (`Pasajero_idPasajero`)
    REFERENCES `mydb`.`Pasajero` (`idPasajero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservaactividad_actividad1`
    FOREIGN KEY (`actividad_idActividad`)
    REFERENCES `unlatravel`.`actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`reservaalojamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`reservaalojamiento` (
  `idReservaAlojamiento` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaIngreso` DATE NOT NULL,
  `fechaSalida` DATE NOT NULL,
  `cantidadHabInd` INT(11) NULL DEFAULT NULL,
  `cantidadHabDob` INT(11) NULL DEFAULT NULL,
  `Alojamiento_idAlojamiento` INT(11) NOT NULL,
  `Pasajero_idPasajero` INT NOT NULL,
  PRIMARY KEY (`idReservaAlojamiento`),
  INDEX `fk_ReservaAlojamiento_Alojamiento1_idx` (`Alojamiento_idAlojamiento` ASC) VISIBLE,
  INDEX `fk_reservaalojamiento_Pasajero1_idx` (`Pasajero_idPasajero` ASC) VISIBLE,
  CONSTRAINT `fk_ReservaAlojamiento_Alojamiento1`
    FOREIGN KEY (`Alojamiento_idAlojamiento`)
    REFERENCES `unlatravel`.`alojamiento` (`idAlojamiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservaalojamiento_Pasajero1`
    FOREIGN KEY (`Pasajero_idPasajero`)
    REFERENCES `mydb`.`Pasajero` (`idPasajero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`vuelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`vuelo` (
  `idVuelo` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaSalida` DATE NOT NULL,
  `fechaLlegada` DATE NOT NULL,
  `precio` DECIMAL(10,0) NOT NULL,
  `plazas` INT(11) NOT NULL,
  `Ciudad_idCiudadOrigen` INT(11) NOT NULL,
  `Ciudad_idCiudadDestino` INT(11) NOT NULL,
  PRIMARY KEY (`idVuelo`),
  INDEX `fk_Vuelo_Ciudad1_idx` (`Ciudad_idCiudadOrigen` ASC) VISIBLE,
  INDEX `fk_Vuelo_Ciudad2_idx` (`Ciudad_idCiudadDestino` ASC) VISIBLE,
  CONSTRAINT `fk_Vuelo_Ciudad1`
    FOREIGN KEY (`Ciudad_idCiudadOrigen`)
    REFERENCES `unlatravel`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vuelo_Ciudad2`
    FOREIGN KEY (`Ciudad_idCiudadDestino`)
    REFERENCES `unlatravel`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`reservavuelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`reservavuelo` (
  `idReservaVuelo` INT(11) NOT NULL AUTO_INCREMENT,
  `plazas` INT(11) NOT NULL,
  `Vuelo_idVuelo` INT(11) NOT NULL,
  `Pasajero_idPasajero` INT NOT NULL,
  PRIMARY KEY (`idReservaVuelo`),
  INDEX `fk_ReservaVuelo_Vuelo1_idx` (`Vuelo_idVuelo` ASC) VISIBLE,
  INDEX `fk_reservavuelo_Pasajero1_idx` (`Pasajero_idPasajero` ASC) VISIBLE,
  CONSTRAINT `fk_ReservaVuelo_Vuelo1`
    FOREIGN KEY (`Vuelo_idVuelo`)
    REFERENCES `unlatravel`.`vuelo` (`idVuelo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservavuelo_Pasajero1`
    FOREIGN KEY (`Pasajero_idPasajero`)
    REFERENCES `mydb`.`Pasajero` (`idPasajero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`servicio` (
  `idServicio` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreServicio` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idServicio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`usuario` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT,
  `dni` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `perfiles_idperfiles` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `fk_usuario_perfiles1_idx` (`perfiles_idperfiles` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_perfiles1`
    FOREIGN KEY (`perfiles_idperfiles`)
    REFERENCES `mydb`.`perfiles` (`idperfiles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`reservavuelo_has_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`reservavuelo_has_usuario` (
  `reservavuelo_idReservaVuelo` INT(11) NOT NULL,
  `usuario_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`reservavuelo_idReservaVuelo`, `usuario_idCliente`),
  INDEX `fk_reservavuelo_has_usuario_usuario1_idx` (`usuario_idCliente` ASC) VISIBLE,
  INDEX `fk_reservavuelo_has_usuario_reservavuelo1_idx` (`reservavuelo_idReservaVuelo` ASC) VISIBLE,
  CONSTRAINT `fk_reservavuelo_has_usuario_reservavuelo1`
    FOREIGN KEY (`reservavuelo_idReservaVuelo`)
    REFERENCES `unlatravel`.`reservavuelo` (`idReservaVuelo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservavuelo_has_usuario_usuario1`
    FOREIGN KEY (`usuario_idCliente`)
    REFERENCES `unlatravel`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`usuario_has_reservaactividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`usuario_has_reservaactividad` (
  `usuario_idCliente` INT(11) NOT NULL,
  `reservaactividad_idReservaActividad` INT(11) NOT NULL,
  PRIMARY KEY (`usuario_idCliente`, `reservaactividad_idReservaActividad`),
  INDEX `fk_usuario_has_reservaactividad_reservaactividad1_idx` (`reservaactividad_idReservaActividad` ASC) VISIBLE,
  INDEX `fk_usuario_has_reservaactividad_usuario1_idx` (`usuario_idCliente` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_has_reservaactividad_usuario1`
    FOREIGN KEY (`usuario_idCliente`)
    REFERENCES `unlatravel`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_reservaactividad_reservaactividad1`
    FOREIGN KEY (`reservaactividad_idReservaActividad`)
    REFERENCES `unlatravel`.`reservaactividad` (`idReservaActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`usuario_has_reservaalojamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`usuario_has_reservaalojamiento` (
  `usuario_idCliente` INT(11) NOT NULL,
  `reservaalojamiento_idReservaAlojamiento` INT(11) NOT NULL,
  PRIMARY KEY (`usuario_idCliente`, `reservaalojamiento_idReservaAlojamiento`),
  INDEX `fk_usuario_has_reservaalojamiento_reservaalojamiento1_idx` (`reservaalojamiento_idReservaAlojamiento` ASC) VISIBLE,
  INDEX `fk_usuario_has_reservaalojamiento_usuario1_idx` (`usuario_idCliente` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_has_reservaalojamiento_usuario1`
    FOREIGN KEY (`usuario_idCliente`)
    REFERENCES `unlatravel`.`usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_reservaalojamiento_reservaalojamiento1`
    FOREIGN KEY (`reservaalojamiento_idReservaAlojamiento`)
    REFERENCES `unlatravel`.`reservaalojamiento` (`idReservaAlojamiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`actividad_has_ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`actividad_has_ciudad` (
  `actividad_idActividad` INT(11) NOT NULL,
  `ciudad_idCiudad` INT(11) NOT NULL,
  PRIMARY KEY (`actividad_idActividad`, `ciudad_idCiudad`),
  INDEX `fk_actividad_has_ciudad_ciudad1_idx` (`ciudad_idCiudad` ASC) VISIBLE,
  INDEX `fk_actividad_has_ciudad_actividad1_idx` (`actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_actividad_has_ciudad_actividad1`
    FOREIGN KEY (`actividad_idActividad`)
    REFERENCES `unlatravel`.`actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actividad_has_ciudad_ciudad1`
    FOREIGN KEY (`ciudad_idCiudad`)
    REFERENCES `unlatravel`.`ciudad` (`idCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `unlatravel`.`alojamiento_has_servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unlatravel`.`alojamiento_has_servicio` (
  `alojamiento_idAlojamiento` INT(11) NOT NULL,
  `servicio_idServicio` INT(11) NOT NULL,
  PRIMARY KEY (`alojamiento_idAlojamiento`, `servicio_idServicio`),
  INDEX `fk_alojamiento_has_servicio_servicio1_idx` (`servicio_idServicio` ASC) VISIBLE,
  INDEX `fk_alojamiento_has_servicio_alojamiento1_idx` (`alojamiento_idAlojamiento` ASC) VISIBLE,
  CONSTRAINT `fk_alojamiento_has_servicio_alojamiento1`
    FOREIGN KEY (`alojamiento_idAlojamiento`)
    REFERENCES `unlatravel`.`alojamiento` (`idAlojamiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alojamiento_has_servicio_servicio1`
    FOREIGN KEY (`servicio_idServicio`)
    REFERENCES `unlatravel`.`servicio` (`idServicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
