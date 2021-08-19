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
  function disconnectDB($conexion){

    $close = mysqli_close($conexion);
    
        if($close){
            //echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            //echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
        }   
    
    return $close;
    }
  function getArray($sql){
    //Creamos la conexión con la función anterior
    $conexion = Conecta();

    //generamos la consulta

    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array

    //guardamos en un array multidimensional todos los datos de la consulta
    $i=0;

    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}
function getObjeto($sql){
  //Creamos la conexión con la función anterior
  $conexion = connectDB();

  //generamos la consulta

  mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

  if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa

  $rawdata = null; //creamos un array

  //guardamos en un array multidimensional todos los datos de la consulta
  $i=0;

  while($row = mysqli_fetch_array($result))
  {
      $rawdata = $row;
      $i++;
  }

  disconnectDB($conexion); //desconectamos la base de datos

  return $rawdata; //devolvemos el array
}
function InsertaDatos($pnombrePaciente,$pprimerApellido,$psegundoApellido,$pcedula,$pcelular,$pcorreo,$pfechaNacimiento,$pidDoctor,$pfechaCita,$ppadecimiento)
{
  $response = "";
  $conn = Conecta();
  // prepare and bind
  mysqli_set_charset($conn, "utf8"); //formato de datos utf8

  $stmt = $conn->prepare("Call spInsertaCitaPaciente(?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param("sssissiiis", $inombrePaciente,$iprimerApellido,$isegundoApellido,$icedula,$icelular,$icorreo,$ifechaNacimiento,$iidDoctor,$ifechaCita,$ipadecimiento);

  // set parameters and execute
  $inombrePaciente=$pnombrePaciente;
  $iprimerApellido=$pprimerApellido;
  $isegundoApellido=$psegundoApellido;
  $icedula=$pcedula;
  $icelular=$pcelular;
  $icorreo=$pcorreo;
  $ifechaNacimiento=$pfechaNacimiento;
  $iidDoctor=$pidDoctor;
  $ifechaCita=$pfechaCita;
  $ipadecimiento=$ppadecimiento;

  $stmt->execute();

  $response = "Se almaceno la cita del paciente satisfactoriamente";

  $stmt->close();
  disconnectDB($conn);

  return $response;
}



?>
