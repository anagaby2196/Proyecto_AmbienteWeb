<?php

 include 'conexion.php';
 $elSQL = "Call spGetDoctores()";
 $myArray = getArray($elSQL);
 echo json_encode($myArray, JSON_UNESCAPED_UNICODE);

 //Fin Call spGetDoctores

?>