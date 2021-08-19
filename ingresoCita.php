  <?php
  function recoge($var, $m = "")
  {
    //isset: devuelve FALSE en caso de una variable que se haya asignado null
    if (!isset($_REQUEST[$var])) {  
      //is_array: encuentra si la variable está en la matriz    
      $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {   
      //trim: recorta caracteres desde el principio y el final de una cadena
      //htmlspecialchars: Convierta caracteres especiales en entidades HTML
      // ENT_COMPAT: predeterminado. Codifica solo comillas dobles
      // ENT_QUOTES: Codifica comillas dobles y simples
      // ENT_NOQUOTES: no codifica ninguna cita   
      $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
      $tmp = $_REQUEST[$var];  
       // La función array_walk_recursive () ejecuta cada elemento de la matriz en una función 
      //definida por el usuario. Las claves y los valores de la matriz son parámetros en la función. 
      //La diferencia entre esta función y la función array_walk () es que con esta función puede trabajar 
      //con matrices más profundas (una matriz dentro de una matriz).  
        array_walk_recursive($tmp, function (&$valor) {
        $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
      });
    }
    return $tmp;
  }

  $nombrePaciente = recoge("nombre");
  $primerApellido = recoge("primerApellido");
  $segundoApellido = recoge("segundoApellido");
  $cedula = recoge("cedula");
  $celular = recoge("celular");
  $correo = recoge("correo");
  $fechaNacimiento = recoge("fechaNacimiento");
  $idDoctor = recoge("idDoctor");
  $fechaCita = recoge("fechaCita");
  $padecimiento = recoge("padecimiento");



  $nombrePacienteOk = false;
  $pApellidooOk = false;
  $sApellidoOk = false;
  $cedulaOk = false;
  $celularOk = false;
  $correoOk = false;
  $fechaNacimientoOk = false;
  $doctorOk = false;
  $tipoCitaOk = false;
  $fechaCitaOk = false;
  $padecimientoOk =false;

  if ($nombrePaciente == "") {
    print "  <p class=\"aviso\">No ha escrito el nombre del paciente.</p>\n";
    print "\n";
  } else {
    $nombrePacienteOk = true;
  }
  if ($primerApellido == "") {
    print "  <p class=\"aviso\">No ha escrito el primer apellido del paciente.</p>\n";
    print "\n";
  } else {
    $pApellidooOk = true;
  }
  if ($segundoApellido == "") {
    print "  <p class=\"aviso\">No ha escrito el segundo apellido del paciente.</p>\n";
    print "\n";
  } else {
    $sApellidoOk = true;
  }
  if ($cedula == "") {
    print "  <p class=\"aviso\">No ha escrito la cudela del paciente.</p>\n";
    print "\n";
  } else {
    $cedulaOk = true;
  }
  if ($celular == "") {
    print "  <p class=\"aviso\">No ha escrito el contacto del paciente.</p>\n";
    print "\n";
  } else {
    $cedulaOk = true;
  }
  if ($correo == "") {
    print "  <p class=\"aviso\">No ha escrito el correo del paciente.</p>\n";
    print "\n";
  } else {
    $correoOk = true;
  }
  if ($fechaNacimiento == "") {
    print "  <p class=\"aviso\">No ha escrito la fecha de nacimiento del paciente.</p>\n";
    print "\n";
  } else {
    $fechaNacimientoOk = true;
  }
  if ($idDoctor == "") {
    print "  <p class=\"aviso\">No ha seleccionado al doctor.</p>\n";
    print "\n";
  } elseif (!is_numeric($idDoctor)) {
    print "  <p class=\"aviso\">El dato del doctor no es válido.</p>\n";
    print "\n";
  } else {
    $idDoctorOk = true;
  }
  if ($fechaCita == "") {
    print "  <p class=\"aviso\">No ha escrito la fecha de la cita del paciente.</p>\n";
    print "\n";
  } else {
    $fechaCitaOk = true;
  }
  if ($idDoctor == "") {
    print "  <p class=\"aviso\">No ha seleccionado al Doctor.</p>\n";
    print "\n";
  } elseif (!is_numeric($idDoctor)) {
    print "  <p class=\"aviso\">El dato del Doctor no es válido.</p>\n";
    print "\n";
  } else {
    $idDoctorOk = true;
  }
  if ($padecimiento == "") {
    print "  <p class=\"aviso\">No ha escrito el padecimiento.</p>\n";
    print "\n";
  } else {
    $padecimientoOk = true;
  }
  if ($nombrePaciente&& $primerApellido&& $segundoApellido&& $cedula&& $celular&& $correo&&
   $fechaNacimiento&& $idDoctor&& $fechaCita && $padecimiento){

      include 'conexion.php';
      //Una vez validados los datos vamos a proceder a insertarlos en base de datos
      echo json_encode(InsertaPaciente($pnombrePaciente,$pprimerApellido,$psegundoApellido,
      $pcedula,$pcelular,$pcorreo,$pfechaNacimiento,$pidDoctor,$pfechaCita,$ppadecimiento)); 
  }
  
  ?>