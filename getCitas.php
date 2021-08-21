<?php

include 'conexion.php';
$elSQL = "Call spGetCitasPacientes()";
$myArray = getArray($elSQL);
echo json_encode($myArray, JSON_UNESCAPED_UNICODE);

//Fin Call spGetCitasPacientes

?>