-- -- BD Proyecto Ambiente Web Cliente - Servidor

CREATE DATABASE CLINICA;

CREATE TABLE `DOCTOR` (           
              `idDoctor` int(11) not null AUTO_INCREMENT,              
              `Nombre` varchar(100) NOT NULL,
              PRIMARY KEY (`idDoctor`)                  
            );

CREATE TABLE `CITAPACIENTE` (
             `idCitaPaciente` int(11) unsigned not null AUTO_INCREMENT,
             `idDoctor` int(11) not null,
             `nombre` varchar(100) not null,             
             `cedula` int(10) DEFAULT NULL,                                                               
             `celular` varchar(30) not null,   
             `correo` varchar(30) not null, 
             `fechaNacimiento` date not null,
             `fechaCita` date not null,
             `padecimiento` varchar(200) not null,                                                    
             PRIMARY KEY (`idCitaPaciente`),                                                          
             KEY `FK_id_doctor` (`idDoctor`),         
               CONSTRAINT `FK_id_doctor` FOREIGN KEY (`idDoctor`) REFERENCES `DOCTOR` (`idDoctor`)  
         );

-------------------------------------------------------------------------------
 
