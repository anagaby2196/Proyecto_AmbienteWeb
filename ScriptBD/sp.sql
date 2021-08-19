
DROP PROCEDURE `spInsertaCitaPaciente`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertaCitaPaciente`(IN `pidDoctor` INT(11) UNSIGNED, IN `pnombrePaciente` VARCHAR(100) CHARSET utf8, IN `pcedula` INT(10) UNSIGNED, IN `pcelular` VARCHAR(30) CHARSET utf8, IN `pcorreo` VARCHAR(30) CHARSET utf8, IN `pfechaNacimiento` DATE, IN `pfechaCita` DATE, IN `ppadecimiento` VARCHAR(200) CHARSET utf8) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY INVOKER INSERT INTO citapaciente(idDoctor, nombre, cedula, celular, correo, fechaNacimiento, fechaCita, padecimiento)
VALUES (pidDoctor, pnombrePaciente, pcedula, pcelular, pcorreo, pfechaNacimiento, pfechaCita, ppadecimiento)

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetDoctores`()
    SQL SECURITY INVOKER
SELECT idDoctor, Nombre from doctor$$
DELIMITER ;