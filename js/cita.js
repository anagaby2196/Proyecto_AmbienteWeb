$(document).ready(function () {

    cargaCitas();

});//Fin document.ready

function cargaCitas() {
    try {
        $.ajax({
            url: 'getCitas.php'
        })
            .done(function (data) {
                ImprTablaJson(data);
            });
    } catch (err) {
        alert(err);
    }
}//Fin Funcion cargaCitas

function ImprTablaJson(TextoJSON) {
    let ObjetoJSON = JSON.parse(TextoJSON);

    $("#citas").append("<tr>");
    $("#citas").append(" <th scope='col'> Doctor </th>");
    $("#citas").append(" <th scope='col'> Paciente </th>");
    $("#citas").append(" <th scope='col'> Cedula  </th>");
    $("#citas").append(" <th scope='col'> Celular </th>");
    $("#citas").append(" <th scope='col'> Correo </th>");
    $("#citas").append(" <th scope='col'> Fecha de Nacimiento </th>");
    $("#citas").append(" <th scope='col'> Fecha de la Cita </th>");
    $("#citas").append(" <th scope='col'> Padecimiento </th>");
    $("#citas").append(" <th scope='col'> Actualizar </th>");
    $("#citas").append(" <th scope='col'> Eliminar </th>");
    $("#citas").append("</tr>");

    for (i = 0; i < ObjetoJSON.length; i++) {
        $("#citas").append("<tr>");
        $("#citas").append("<th scope='row'>" + ObjetoJSON[i].Nombre_Doctor + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].nombre + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].cedula + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].celular + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].correo + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].fechaNacimiento + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].fechaCita + "</td> ");
        $("#citas").append("<td>" + ObjetoJSON[i].padecimiento + "</td> ");
        $("#citas").append("<td>" + "<a href='actualizaCitaPaciente.php?idCitaPaciente=" + ObjetoJSON[i].idCitaPaciente + "'>Actualizar</a>" + "</td>");
        $("#citas").append("<td>" + "<a href='eliminaCita.php?idCitaPaciente=" + ObjetoJSON[i].idCitaPaciente + "'>Eliminar</a>" + "</td>");
        $("#citas").append("</tr>");
    }
}//Fin Funcion ImprTablaJson