
--SP INSERTACITAPACIENTE
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertaCitaPaciente`(IN `pidDoctor` INT(11) UNSIGNED, IN `pnombrePaciente` VARCHAR(100) CHARSET utf8, IN `pcedula` INT(10) UNSIGNED, IN `pcelular` VARCHAR(30) CHARSET utf8, IN `pcorreo` VARCHAR(30) CHARSET utf8, IN `pfechaNacimiento` DATE, IN `pfechaCita` DATE, IN `ppadecimiento` VARCHAR(200) CHARSET utf8)
    SQL SECURITY INVOKER
INSERT INTO citapaciente(idDoctor, nombre, cedula, celular, correo, fechaNacimiento, fechaCita, padecimiento) VALUES
(pidDoctor, pnombrePaciente, pcedula, pcelular, pcorreo, pfechaNacimiento, pfechaCita, ppadecimiento)$$
DELIMITER ;

--SP GETDOCTORES
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetDoctores`()
    SQL SECURITY INVOKER
SELECT idDoctor, Nombre from doctor$$
DELIMITER ;

--SP ELIMINACITA
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminaCita`(IN `pidCitaPaciente` INT)
DELETE FROM citapaciente WHERE idcitaPaciente = pidCitaPaciente$$
DELIMITER ;

--SP SPGETCITASPACIENTES
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetCitasPacientes`()
SELECT c.idCitaPaciente, d.Nombre as Nombre_Doctor, c.nombre, c.cedula, c.celular, c.correo, c.fechaNacimiento, c.fechaCita, c.padecimiento
  		FROM citapaciente c, doctor d where c.idDoctor = d.idDoctor$$
DELIMITER ;

--SP SPGETCITAPACIENTE
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetCitaPaciente`(IN `pidCitaPaciente ` INT)
SELECT idCitaPaciente,idDoctor,nombre,cedula,celular,correo,
fechaNacimiento,fechaCita, padecimiento WHERE idcitaPaciente = pidCitaPaciente$$
DELIMITER ;

--SP SPACTUALIZACITAPACIENTE
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizaCitaPaciente`(IN `pidDoctor` INT(11) UNSIGNED, IN `pnombrePaciente` VARCHAR(100), IN `pcedula` INT(10) UNSIGNED, IN `pcelular` VARCHAR(30), IN `pcorreo` VARCHAR(30), IN `pfechaNacimiento` DATE, IN `pfechaCita` DATE, IN `ppadecimiento` VARCHAR(200), IN `pidCitaPaciente` INT)
UPDATE citapaciente
        SET
        idDoctor=pidDoctor,
        nombre=pnombrePaciente, 
        cedula=pcedula, 
        celular=pcelular, 
        correo=pcorreo, 
        fechaNacimiento=pfechaNacimiento, 
        fechaCita=pfechaCita, 
        padecimiento=ppadecimiento
          where idCitaPaciente = pidCitaPaciente$$
DELIMITER ;

--










