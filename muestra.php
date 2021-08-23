<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalabel=no, initial-scale=1, maximun-scale=1.0, maximun-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.css">

    <div class="padre">
        <img class="banner" src="imagenes/Banner.jpg" alt="" style="height: 255.8px;">
    </div>

</head>

<body background="imagenes/pedicura-medica-running-portada2-1556794999.jpg">
<div class="padre">
        <header class="header">
            <div class="menu margen-interno">
                <nav class="nav">
                    <a href="index.html"><i class="fas fa-home" aria-hidden="true" style="padding: 0 2px;"></i><span
                            class="off">Registro</span></a>
                    <a href="citas.html"><i class="fas fa-home" aria-hidden="true" style="padding: 0 2px;"></i><span
                            class="off">Citas Programadas</span></a>
                    <a href="nosotros.html"><i class="fas fa-user" style="padding: 0 2px;"></i><span
                            class="off">Nosotros</span></a>
                    <a href="servicios.html"><i class="fas fa-ambulance" style="padding: 0 2px;"></i><span
                            class="off">Servicios</span></a>
                    <a href="promociones.html"><i class="fas fa-tags" style="padding: 0 2px;"></i><span
                            class="off">Promociones de Temporada</span></a>
                    <a href="contacto.html"><i class="fas fa-envelope" style="padding: 0 2px;"></i><span
                            class="off">Contacto</span></a>
                </nav>
                <div class="social">
                    <div>
                        <a href="index.html"><i class="fab fa-facebook-square"></i></a>
                        <a href="index.html"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="registro margen-interno">
                <br>
                <h1><u><b>ACTUALIZACIÓN DE INFORMACIÓN</b></u></h1>
                <div ID="pnlMensaje" title="Error" style="display:none">
                <div>
                    <strong>Atención!</strong> Se ha presentado el siguiente problema.
                    <br />
                    <br />
                    <p ID="blMensajes"></p>
                </div>
            </div>
            <div ID="pnlInfo" title="Mensaje" style="display : none;">
                <div>
                    <strong>Información!</strong> Procesamiento éxitoso.
                    <br />
                    <br />
                    <p ID="blInfo"></p>
                </div>
            </div>
            <?php
                $idCitaPaciente =   $_REQUEST['idCitaPaciente'];
	        ?>
                
                <input name="idCitaPaciente" type="text" id="idCitaPaciente" value='<?php echo $idCitaPaciente ?>' hidden /><br />
                    <div class="registro">
                        <div class="form-group col-5">
                            <div class="">
                                <label for="usr">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="form-group col-5">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="form-group col-5">
                            <label for="celular">Número de teléfono</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="form-group col-5">
                            <label for="correo">Correo Electrónico</label>
                            <input type="text" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group col-5">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento"
                                required>
                        </div>
                        <div class="form-group col-5 ">
                            <label for="idDoctor" placeholder="Seleccione un doctor">Seleccione un Doctor</label>
                            <select class="form-control" name="idDoctor" id="idDoctor" required></select>
                        </div>
                        <div class="form-group col-5">
                            <label for="fechaCita">Seleccione la fecha de la cita</label>
                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" required>
                        </div>
                        <div class="form-group col-5">
                            <label for="padecimiento">Padecimiento</label>
                            <textarea class="form-control" id="padecimiento" name="padecimiento"
                                placeholder="Indique cuales son sus padecimientos"
                                style="height:200px"></textarea><br><br>
                        </div>
                    </div>
                
            </div>
        </header>
        <footer class="footer margen-interno">
            <nav class="pie">
                <a href="#">Desarrollado por Jhonsel Díaz Chacón y Ana Gabriela Mora Salas </a>
            </nav>
        </footer>
    </div>
        <div class="main">
            <?php
            ImprimeDatos();

            function Conecta() {	

                $servidor = "localhost";
                $usuario ="root";
                $password = "";
                $BD = "clinica";
              
                $laconexion = mysqli_connect($servidor, $usuario, $password, $BD);
                  
                  if($laconexion){
                    //echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
                  }else{
                    //echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
                  }
                return $laconexion;
              }//Fin Funcion Conexion

            function ConsultaSQL($elQuery)
            {
                $laconexion = Conecta();
                $queryDevuelto = $laconexion->query($elQuery);
                return $queryDevuelto;
            }

            function ImprimeDatos()
            {
                $elSQL = "SELECT c.idCitaPaciente, d.Nombre as Nombre_Doctor, c.nombre, c.cedula, c.celular, c.correo,
                c.fechaNacimiento, c.fechaCita, c.padecimiento FROM citapaciente c, doctor d
         WHERE idCitaPaciente = pidCitaPaciente AND D.idDoctor=C.idDoctor";
                $miQuery = ConsultaSQL($elSQL);
                echo "<div id=ContactDiv>";
                echo "<br>";
                imprimeTabla($miQuery);
                echo "</div>";
            }

            //Imprimir tabla
            function imprimeTabla($miQuery)
            {
                echo "<table class='table'";
                echo "<tr>";
                echo " <th scope='col'> Doctor </th>";
                echo " <th scope='col'> Paciente </th>";
                echo " <th scope='col'> Cedula </th>";
                echo " <th scope='col'> Celular </th>";
                echo " <th scope='col'> Correo </th>";
                echo " <th scope='col'> Fecha de Nacimiento </th>";
                echo " <th scope='col'> Fecha de la Cita </th>";
                echo " <th scope='col'> Padecimiento </th>";
                echo " <th scope='col'> Actualizar </th>";
                echo " <th scope='col'> Eliminar </th>";
                echo "</tr>";
                if ($miQuery->num_rows > 0) {
                    while ($row = $miQuery->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["Nombre_Doctor"] .      "</td> ";
                        echo "<td>" . $row["nombre"] .      "</td> ";
                        echo "<td>" . $row["cedula"] .      "</td> ";
                        echo "<td>" . $row["celular"] .      "</td> ";
                        echo "<td>" . $row["correo"] .      "</td> ";
                        echo "<td>" . $row["fechaNacimiento"] .      "</td> ";
                        echo "<td>" . $row["fechaCita"] .      "</td> ";
                        echo "<td>" . $row["padecimiento"] .      "</td> ";
                        echo "<td>" . "<a href='actualizaCitaPaciente.php?idCitaPaciente=" .  $row["idCitaPaciente"] .
                            "'>Modificar</a>" .   "</td>";
                        echo "<td>" . "<a href='eliminaCita.php?idCitaPaciente=" .  $row["idCitaPaciente"] .
                            "'>Eliminar</a>" .   "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo " <th> No se han registrado citas aún </th>";
                    echo "</tr>";
                    //    echo "0 Filas";
                }
                echo "</table>";
            }
            //End imprimeTabla  -----------------------------------------------------------

            ?>
        </div>
</body>

</html>