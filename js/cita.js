$(document).ready(function () {

    cargaTutorias();

});//(document).ready ==============================

function cargaTutorias() {
    try {
        $.ajax({
            url: 'getTutorias.php'
        })
            .done(function (data) {
                ImprTablaJson(data);
            });
    } catch (err) {
        alert(err);
    }// fin catch
}//fin Ajax_Completo ==============================

function ImprTablaJson(TextoJSON) {
    let ObjetoJSON = JSON.parse(TextoJSON);

    $("#tutorias").append("<tr>");
    $("#tutorias").append(" <th scope='col'> Alumno  </th>");
    $("#tutorias").append(" <th scope='col'> Profesor </th>");
    $("#tutorias").append(" <th scope='col'> Día  </th>");
    $("#tutorias").append(" <th scope='col'> Hora </th>");
    $("#tutorias").append(" <th scope='col'> Asunto </th>");
    $("#tutorias").append(" <th scope='col'> Actualiza </th>");
    $("#tutorias").append(" <th scope='col'> Elimina </th>");
    $("#tutorias").append("</tr>");

    for (i = 0; i < ObjetoJSON.length; i++) {
        $("#tutorias").append("<tr>");
        $("#tutorias").append("<th scope='row'>" + ObjetoJSON[i].alumno + "</td> ");
        $("#tutorias").append("<td>" + ObjetoJSON[i].profesor + "</td> ");
        $("#tutorias").append("<td>" + ObjetoJSON[i].dia + "</td> ");
        $("#tutorias").append("<td>" + ObjetoJSON[i].hora + "</td> ");
        $("#tutorias").append("<td>" + ObjetoJSON[i].asunto + "</td> ");
        $("#tutorias").append("<td>" + "<a href='actualizaTutoria.php?idTutoria=" + ObjetoJSON[i].id + "'>Modificar</a>" + "</td>");
        $("#tutorias").append("<td>" + "<a href='eliminarTutoria.php?idTutoria=" + ObjetoJSON[i].id + "'>Eliminar</a>" + "</td>");
        $("#tutorias").append("</tr>");
    }
}//Fin ImprTablaJson ================================================