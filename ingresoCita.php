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
  $pApellidoo = recoge("pApellido");
  $sApellido = recoge("sApellido");
  $cedula = recoge("cedula");
  $celular = recoge("celular");
  $correo = recoge("correo");
  $fechaNacimiento = recoge("fechaNacimiento");
  $doctor = recoge("doctor");
  /*$tipoCita = recoge("tipoCita");*/
  $fechaCita  = recoge("fechaCita");
  $padecimiento = recoge("padecimiento"); 

  $nombrePaciente = false;
  $pApellidoo = false;
  $sApellido = false;
  $cedula = false;
  $celular = false;
  $correo = false;
  $fechaNacimiento = false;
  $doctor = false;
  $tipoCita = false;
  $fechaCita = false;
  $padecimiento =false;

  if ($nombrePaciente == "") {
    print "  <p class=\"aviso\">No ha escrito el nombre del paciente.</p>\n";
    print "\n";
  } else {
    $nombrePacienteOk = true;
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

  if ($nombrePacienteOk && $idDoctorOk && $idDiaOk && $horaOk && $padecimientoOk) {
    print "  <p>El paciente ingresado es <strong>$nombrePaciente</strong>.</p>\n";
    print "\n";
    $Doctor = "";
    switch ($idDoctor) {
      case '1':
          $Doctor = "Eduardo González Paniagua";    
        break;
        case '2':
           $Doctor = "Armenia Monge Soto";    
        break;
        case '3':
          $Doctor = "Cleimer Solis Vargas";    
        break;
        case '4':
           $Doctor = "Andrea Rodriguez Vargas";    
        break;
        case '5':
          $Doctor = "José Angel Cedeño Nuñez";    
       break;
      default:
          $Doctor = "No es válido"; 
        break;
    }
      print "  <p>El Doctor seleccionado es <strong>$Doctor</strong>.</p>\n";
      print "\n";

    $dia = "";
      switch ($idDia) {
        case '1':
            $dia = "lunes";    
          break;
          case '2':
             $dia = "martes";    
          break;
          case '3':
            $dia = "miercoles";    
          break;
          case '4':
             $dia = "jueves";    
          break;
          case '5':
            $dia = "viernes";    
         break;
        default:
            $dia = "No es válido"; 
          break;
      }
        print "  <p>El dia seleccionado es <strong>$dia</strong>.</p>\n";
        print "\n";
   
    if ($hora == 10) {
      print "  <p>La hora seleccionada fue <strong>10</strong>.</p>\n";
    } elseif ($hora == 12) {
      print "  <p>La hora seleccionada fue <strong>12</strong>.</p>\n";
    } elseif ($hora == 16) {
      print "  <p>La hora seleccionada fue <strong>16</strong>.</p>\n";
    } elseif ($hora == 18) {
      print "  <p>La hora seleccionada fue <strong>18</strong>.</p>\n";
    }else {
      print "  <p> <strong>NO selecciono la hora</strong>.</p>\n";
    }
    print "\n";

    print "  <p>El padecimiento a tratar es <strong>$padecimiento</strong>.</p>\n";

    include 'conection.php';
     /*  include_once 'conection.php';
    require_once 'conection.php'; */
    //Una vez validados los datos vamos a proceder a insertarlos en base de datos
    echo InsertaPaciente($pPaciente, $pPrApellido, $pDoApellido, $pCedula, $pCelular, $pCorreo, $pFNacimiento, $pPadecimiento);
    echo InsertaCitaPaciente();

  }

  $nombrePaciente = recoge("nombre");
  $pApellidoo = recoge("pApellido");
  $sApellido = recoge("sApellido");
  $cedula = recoge("cedula");
  $celular = recoge("celular");
  $correo = recoge("correo");
  $fechaNacimiento = recoge("fechaNacimiento");
  $doctor = recoge("doctor");
  $fechaCita  = recoge("fechaCita");
  $padecimiento = recoge("padecimiento"); 

  function InsertaPaciente($pPaciente, $pPrApellido, $pDoApellido, $pCedula, $pCelular, $pCorreo, $pFNacimiento, $pPadecimiento)
    {
      $response = "";
      $conn = Conecta();
      // prepare and bind
      $stmt = $conn->prepare("INSERT INTO paciente (Paciente, PrimerApellido, segundoApellido, Cedula, Celular, Correo, FechaNacimiento, Padecimiento) VALUES (?,?,?,?,?,?,?,?)");
      $stmt->bind_param("siiiiiis", $nombrePaciente, $pApellidoo, $sApellido, $cedula, $celular,$correo, $fechaNacimiento,$padecimiento);

      // set parameters and execute
      
      $nombrePaciente= $pPaciente;
      $pApellidoo= $pPrApellido;
      $sApellido= $pDoApellido;
      $nombrePacicedulaente= $pCedula ;
      $celular= $pCelular ;
      $correo= $pCorreo;
      $fechaNacimiento= $pFNacimiento;
      $padecimiento= $pPadecimiento;

      $stmt->execute();

      $response = "Se almaceno el paciente satisfactoriamente";

      $stmt->close();
      $conn->close();

      return $response;
    }
    function InsertaCitaPaciente($pIdCliente, $pIdDoctor, $pFecha)
    {
      $response = "";
      $conn = Conecta();
      // prepare and bind
      $stmt = $conn->prepare("INSERT INTO citapaciente (pPaciente, pPrApellido, pDoApellido, pCedula, pCelular, pCorreo, pFNacimiento, pPadecimiento) VALUES (?,?,?,?,?,?,?,?)");
      $stmt->bind_param("siis", $nombrePaciente, $pApellidoo, $sApellido, $cedula, $celular,$correo, $fechaNacimiento,$padecimiento);

      // set parameters and execute
      
      $nombrePaciente= $pPaciente;
      $pApellidoo= $pPrApellido;
      $sApellido= $pDoApellido;
      $nombrePacicedulaente= $pCedula ;
      $celular= $pCelular ;
      $correo= $pCorreo;
      $fechaNacimiento= $pFNacimiento;
      $padecimiento= $pPadecimiento;

      $stmt->execute();

      $response = "Se almaceno el paciente satisfactoriamente";

      $stmt->close();
      $conn->close();

      return $response;
    }

    function getlastPaciente(){
      $response = "";
      $conn = Conecta();
      // prepare and bind
      $stmt = $conn->prepare("SELECT MAX(idPACIENTE) from paciente;");
     
      $stmt->execute();

      $response = $stmt;

      $stmt->close();
      $conn->close();

      return $response;

    }


  ?>