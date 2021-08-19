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

  $idCitaPaciente = recoge("idCitaPaciente");

  $idCitaPacienteOk  = false;

  if ($idCitaPaciente == "") {
    print "  <p class=\"aviso\">No ha envíado la Cita a eliminar.</p>\n";
    print "\n";
  } elseif (!is_numeric($idCitaPaciente)) {
    print "  <p class=\"aviso\">El dato de la Cita no es válido.</p>\n";
    print "\n";
  } else {
    $idTutoriaOk = true;
  }

  if ($idCitaPacienteOk) {
    include 'connection.php';
    EliminaDato($idCitaPaciente);
    header("Location: tutorias.html");
die();	
  }

  ?>