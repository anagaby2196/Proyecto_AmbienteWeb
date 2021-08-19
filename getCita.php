<?php

$idCitaPaciente =   $_GET['idCitaPaciente'];
include 'conexion.php';
$elSQL = "call spGetCitaPaciente($idCitaPaciente)";
$myArray = getObjeto($elSQL);
echo json_encode($myArray, JSON_UNESCAPED_UNICODE);

?>