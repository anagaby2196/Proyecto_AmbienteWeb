<?php

$idCitaPaciente =   $_GET['idCitaPaciente'];
include 'conexion.php';
$elSQL = "Call spGetCitaPaciente($idCitaPaciente)";
$myArray = getObjeto($elSQL);
echo json_encode($myArray, JSON_UNESCAPED_UNICODE);

//Fin Call spGetCitaPaciente

?> 