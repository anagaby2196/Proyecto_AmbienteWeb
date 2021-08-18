<?php
 include 'conexion.php';
 $elSQL = "call spGetDoctores()";
 $myArray = getArray($elSQL);
 echo json_encode($myArray, JSON_UNESCAPED_UNICODE);
?>