create database contactos;
use contactos;
CREATE TABLE `contactos`.`contacto` (
  `idcontacto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idcontacto`));
