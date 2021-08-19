
CREATE PROCEDURE `spInsertaCitaPaciente`(IN `pnombrePaciente` VARCHAR(20) CHARSET utf8, IN `pprimerApellido` VARCHAR(25) CHARSET utf8, IN `psegundoApellido` VARCHAR(25) CHARSET utf8, IN `pcedula` INT(10) UNSIGNED, IN `pcelular` VARCHAR(30) CHARSET utf8, IN `pcorreo` VARCHAR(30) CHARSET utf8, IN `pfechaNacimiento` DATE, IN `pidDoctor` INT(11) UNSIGNED, IN `pfechaCita` DATE, IN `ppadecimiento` VARCHAR(200) CHARSET utf8) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY INVOKER INSERT INTO citapaciente(nombre,primerApellido,segundoApellido, cedula,celular,correo,fechaNacimiento,idDoctor,fechaCita,padecimiento) VALUES
(pnombrePaciente,pprimerApellido,psegundoApellido, pcedula,pcelular,pcorreo,pfechaNacimiento,pidDoctor,pfechaCita, ppadecimiento);

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetDoctores`()
    SQL SECURITY INVOKER
SELECT idDoctor, Nombre, PrimerApellido, SegundoApellido from doctor$$
DELIMITER ;