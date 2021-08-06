<?php
  function Conecta(){	
    $elServidor = "localhost";
    $elUsuario ="root";
    $elPassword = "";
    $laBD = "clinica";
    $laconexion = new mysqli($elServidor, $elUsuario, $elPassword, $laBD);
    
    if ($laconexion->connect_error) {
      die("Error al Conectar con la BD: " . $laconexion->connect_error);
    } 
    //echo "Conexion exitosa <br>";
    
    return $laconexion;			
  }
?>
