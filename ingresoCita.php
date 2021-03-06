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
  }//Fin Funcion recoge

  $idDoctor = recoge("idDoctor");
  $nombrePaciente = recoge("nombre");
  $cedula = recoge("cedula");
  $celular = recoge("celular");
  $correo = recoge("correo");
  $fechaNacimiento = recoge("fechaNacimiento");
  $fechaCita = recoge("fechaCita");
  $padecimiento = recoge("padecimiento");

  $idDoctorOk = false;
  $nombrePacienteOk = false;
  $cedulaOk = false;
  $celularOk = false;
  $correoOk = false;
  $fechaNacimientoOk = false;
  $fechaCitaOk = false;
  $padecimientoOk =false;


  if ($idDoctor == "") {
    print "  <p class=\"aviso\">No ha seleccionado al Doctor.</p>\n";
    print "\n";
  } elseif (!is_numeric($idDoctor)) {
    print "  <p class=\"aviso\">El dato del Doctor no es válido.</p>\n";
    print "\n";
  } else {
    $idDoctorOk = true;
  }//Fin idDoctor

  if ($nombrePaciente == "") {
    print "  <p class=\"aviso\">No ha escrito el nombre del paciente.</p>\n";
    print "\n";
  } else {
    $nombrePacienteOk = true;
  }//Fin nombrePaciente

  if ($cedula == "") {
    print "  <p class=\"aviso\">No ha escrito la cédula del paciente.</p>\n";
    print "\n";
  } else {
    $cedulaOk = true;
  }//Fin cedula

  if ($celular == "") {
    print "  <p class=\"aviso\">No ha escrito el contacto del paciente.</p>\n";
    print "\n";
  } else {
    $celularOk = true;
  }//Fin celular

  if ($correo == "") {
    print "  <p class=\"aviso\">No ha escrito el correo del paciente.</p>\n";
    print "\n";
  } else {
    $correoOk = true;
  }//Fin correo

  if ($fechaNacimiento == "") {
    print "  <p class=\"aviso\">No ha ingresado la fecha de nacimiento del paciente.</p>\n";
    print "\n";
  } else {
    $fechaNacimientoOk = true;
  }//Fin fechaNacimiento
  
  if ($fechaCita == "") {
    print "  <p class=\"aviso\">No ha seleccionado la fecha de la cita del paciente.</p>\n";
    print "\n";
  } else {
    $fechaCitaOk = true;
  }//Fin fechaCita

  if ($padecimiento == "") {
    print "  <p class=\"aviso\">No ha escrito el padecimiento.</p>\n";
    print "\n";
  } else {
    $padecimientoOk = true;
  }//Fin padecimiento

  if ($idDoctorOk&& $nombrePacienteOk&& $cedulaOk&& $celularOk&& $correoOk&&
      $fechaNacimientoOk&& $fechaCitaOk && $padecimientoOk){

      include 'conexion.php';
     
      echo json_encode(InsertaDatos($idDoctor, $nombrePaciente, $cedula, $celular, $correo, $fechaNacimiento,
                                    $fechaCita, $padecimiento)); 
  }//Fin InsertaDatos
  
  ?>