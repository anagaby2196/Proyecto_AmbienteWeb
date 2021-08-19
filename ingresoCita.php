  <?php

  function recoge($var, $m = "")
  {
    
    if (!isset($_REQUEST[$var])) {
      
      $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
      
      $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
      $tmp = $_REQUEST[$var];
      
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
  $primerApellidoOk = false;
  $segundoApellidoOk = false;
  $cedulaOk = false;
  $celularOk = false;
  $correoOk = false;
  $fechaNacimientoOk = false;
  $idDoctorOk = false;
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
    $primerApellidoOk = true;
  }

  if ($segundoApellido == "") {
    print "  <p class=\"aviso\">No ha escrito el segundo apellido del paciente.</p>\n";
    print "\n";
  } else {
    $segundoApellidoOk = true;
  }

  if ($cedula == "") {
    print "  <p class=\"aviso\">No ha escrito la cédula del paciente.</p>\n";
    print "\n";
  } else {
    $cedulaOk = true;
  }

  if ($celular == "") {
    print "  <p class=\"aviso\">No ha escrito el contacto del paciente.</p>\n";
    print "\n";
  } else {
    $celularOk = true;
  }

  if ($correo == "") {
    print "  <p class=\"aviso\">No ha escrito el correo del paciente.</p>\n";
    print "\n";
  } else {
    $correoOk = true;
  }

  if ($fechaNacimiento == "") {
    print "  <p class=\"aviso\">No ha ingresado la fecha de nacimiento del paciente.</p>\n";
    print "\n";
  } else {
    $fechaNacimientoOk = true;
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
  
  if ($fechaCita == "") {
    print "  <p class=\"aviso\">No ha seleccionado la fecha de la cita del paciente.</p>\n";
    print "\n";
  } else {
    $fechaCitaOk = true;
  }

  if ($padecimiento == "") {
    print "  <p class=\"aviso\">No ha escrito el padecimiento.</p>\n";
    print "\n";
  } else {
    $padecimientoOk = true;
  }

  if ($nombrePacienteOk&& $primerApellidoOk&& $segundoApellidoOk&& $cedulaOk&& $celularOk&& $correoOk&&
   $fechaNacimientoOk&& $idDoctorOk&& $fechaCitaOk && $padecimientoOk){

      include 'conexion.php';
     
      echo json_encode(InsertaDatos($nombrePaciente, $primerApellido, $segundoApellido, $cedula, $celular, $correo, $fechaNacimiento,
      $idDoctor, $fechaCita, $padecimiento)); 
  }
  
  ?>