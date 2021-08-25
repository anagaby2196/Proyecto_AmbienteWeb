<?php

function Conecta()
{

  $servidor = "localhost";
  $usuario = "root";
  $password = "";
  $BD = "clinica";

  $laconexion = mysqli_connect($servidor, $usuario, $password, $BD);

  if ($laconexion) {
    //echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
  } else {
    //echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
  }
  return $laconexion;
} //Fin Funcion Conexion

function disconnectDB($laconexion)
{

  $close = mysqli_close($laconexion);

  if ($close) {
    //echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
  } else {
    //echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
  }

  return $close;
} //Fin Funcion Desconexion

function getArray($sql)
{

  $laconexion = Conecta();
  mysqli_set_charset($laconexion, "utf8");

  if (!$result = mysqli_query($laconexion, $sql)) die();
  $rawdata = array();
  $i = 0;

  while ($row = mysqli_fetch_array($result)) {
    $rawdata[$i] = $row;
    $i++;
  }

  disconnectDB($laconexion);
  return $rawdata;
} // Fin Funcion GetArray

function getObjeto($sql)
{

  $laconexion = Conecta();
  mysqli_set_charset($laconexion, "utf8");

  if (!$result = mysqli_query($laconexion, $sql)) die();
  $rawdata = null;
  $i = 0;

  while ($row = mysqli_fetch_array($result)) {
    $rawdata = $row;
    $i++;
  }

  disconnectDB($laconexion);
  return $rawdata;
} // Fin Funcion GetObjeto

function InsertaDatos(
  $pidDoctor,
  $pnombrePaciente,
  $pcedula,
  $pcelular,
  $pcorreo,
  $pfechaNacimiento,
  $pfechaCita,
  $ppadecimiento
) {

  $conn = Conecta();

  mysqli_set_charset($conn, "utf8");

  $stmt = $conn->prepare("Call spInsertaCitaPaciente(?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("isisssss",  $iidDoctor, $inombrePaciente, $icedula, $icelular, $icorreo, $ifechaNacimiento, $ifechaCita, $ipadecimiento);

  $iidDoctor = $pidDoctor;
  $inombrePaciente = $pnombrePaciente;
  $icedula = $pcedula;
  $icelular = $pcelular;
  $icorreo = $pcorreo;
  $ifechaNacimiento = $pfechaNacimiento;
  $ifechaCita = $pfechaCita;
  $ipadecimiento = $ppadecimiento;

  if ($stmt->execute()) {

    $response = array("mensaje" => "La cita se almacenó correctamente.");
  } else {

    $response = array("mensaje" => "Error para almacenar la cita.");
  }
  $stmt->close();
  disconnectDB($conn);
  return $response;
} //Fin Funcion InsertaDatos

function EliminaDatos($pidCitaPaciente)
{

  $conn = Conecta();
  $stmt = $conn->prepare("Call spEliminaCita(?)");
  $stmt->bind_param("i", $idCitaPaciente);

  $idCitaPaciente = $pidCitaPaciente;

  if ($stmt->execute()) {

    $response = array("mensaje" => "La cita se eliminó correctamente.");
  } else {

    $response = array("mensaje" => "Error para eliminar la cita.");
  }


  $stmt->close();
  disconnectDB($conn);

  return $response;
} //Fin Funcion EliminaDatos

function actualizaDatos(

  $pidCitaPaciente,
  $pnombrePaciente,
  $pcedula,
  $pcelular,
  $pcorreo,
  $pfechaNacimiento,
  $pidDoctor,
  $pfechaCita,
  $ppadecimiento,
) {

  $conn = Conecta();
  mysqli_set_charset($conn, "utf8");

  $stmt = $conn->prepare("Call spActualizaCitaPaciente(?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("siisissss",  $ipadecimiento, $iidCitaPaciente, $iidDoctor, $inombrePaciente, $icedula, $icelular, $icorreo, $ifechaNacimiento, $ifechaCita,);

  $iidCitaPaciente = $pidCitaPaciente;
  $iidDoctor = $pidDoctor;
  $inombrePaciente = $pnombrePaciente;
  $icedula = $pcedula;
  $icelular = $pcelular;
  $icorreo = $pcorreo;
  $ifechaNacimiento = $pfechaNacimiento;
  $ifechaCita = $pfechaCita;
  $ipadecimiento = $ppadecimiento;

  if ($stmt->execute()) {

    $response = array("mensaje" => "La cita se actualizó correctamente.");
  } else {

    $response = array("mensaje" => "Error para actualizar la cita.");
  }


  $stmt->close();
  disconnectDB($conn);

  return $response;
}//Fin Funcion ActualizaDatos
