<?php

  function Conecta() {	
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

  function disconnectDB($conexion) {

    $close = mysqli_close($conexion);
    
        if($close) {
            //echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
        } else {
            //echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }   
    
    return $close;
    }

  function getArray($sql) {
   
    $conexion = Conecta();

  

    mysqli_set_charset($conexion, "utf8");

    if(!$result = mysqli_query($conexion, $sql)) die(); 

    $rawdata = array(); 

    
    $i=0;

    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }

    disconnectDB($conexion); 
    return $rawdata; 
}

function getObjeto($sql) {
  
  $conexion = connectDB();



  mysqli_set_charset($conexion, "utf8");

  if(!$result = mysqli_query($conexion, $sql)) die(); 

  $rawdata = null;

 
  $i=0;

  while($row = mysqli_fetch_array($result))
  {
      $rawdata = $row;
      $i++;
  }

  disconnectDB($conexion);

  return $rawdata; 
}

function InsertaDatos($pidDoctor, $pnombrePaciente, $pcedula, $pcelular, $pcorreo,
                      $pfechaNacimiento, $pfechaCita, $ppadecimiento) {
  $response = "";
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

  $stmt->execute();

  $response = "Se almaceno la cita del paciente satisfactoriamente";

  $stmt->close();
  disconnectDB($conn);

  return $response;
}

?>
