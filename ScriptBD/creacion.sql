-- BD Proyecto Ambiente Web Cliente - Servidor

CREATE DATABASE CLINICA;

create table paciente (
  idPACIENTE int unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(20) not null,
  primerApellido varchar(15) not null,
  segundoApellido varchar(15) not null,
  cedula int,
  celular varchar(30) not null,
  fechaNacimiento date not null,  
  correo varchar(30) not null,
  padecimiento varchar(50) not null,
  PRIMARY KEY (idPACIENTE)  
);

create table productos(
   id int unsigned NOT NULL AUTO_INCREMENT,
   Producto varchar(10) not null,
   DESCRIPCION varchar(70) not null,
   PRIMARY KEY (id)
);

CREATE TABLE CITACLIENTE (
IDCITACLIENTE INT Unsigned NOT NULL AUTO_INCREMENT,
IDCLIENTE INT NOT NULL,
IDDOCTOR INT NOT NULL,
FECHA DATE NOT NULL,
PRIMARY KEY (IDCITACLIENTE)
);

CREATE TABLE DOCTORES(
IDDOCTORES INT Unsigned NOT NULL AUTO_INCREMENT,
NOMBRE VARCHAR(50) NOT NULL,
PRIMERAPELLIDO VARCHAR(50) NOT NULL,
SEGUNDOAPELLIDO VARCHAR(50)NOT NULL,
PRIMARY KEY (IDDOCTORES)
);