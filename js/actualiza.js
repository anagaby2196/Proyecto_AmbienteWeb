$(document).ready(function () {
    
    cargaDoctores();

   $("#btEnviar").click(function(){
       actualizaCitaPaciente($("#nombre").val(),$("#pApellido").val(),
       $("#sApellido").val(),$("#cedula").val(),$("#celular").val(),
       $("#correo").val(),$("#fechaNacimiento").val(),$("input[name='doctor']:checked").val(),
       $("#fechaCita").val(),$("#padecimiento").val())
   })

    $("#btRestablecer").click(function () {
        LimpiaCampos();
    });
    

});//(document).ready ==============================

function cargaDoctores() {
    try {
        $.ajax({
            url: 'getDoctores.php'
        })
            .done(function (data) {
                LlenaDoctoresJson(data);
            });
    } catch (err) {
        alert(err);
    }
}

function actualizaTutoria(pidTutoria, pnombreAlumno, pidProfesor, pidDia, pHora, pAsunto) {
    try {
        $.ajax(
            {
                data: {
                    idTutoria: pidTutoria,
                    nombreAlumno: pnombreAlumno,
                    idProfesor: pidProfesor,
                    idDia: pidDia,
                    hora: pHora,
                    asunto: pAsunto,
                },
                url: 'actualiza.php',
                type: 'POST',
                dataType: 'json',
                // beforeSend: function () 
                //  {
                //     $("#pnlInfo").fadeTo("slow");
                //     $("#pnlMensaje").fadeTo("slow");
                //  },
                success: function (r) {
                    ActualizacionInsercionTutoriaExitosa(r);
                },
                error: function (r) {
                    ActualizacionTutoriaFallida(r);
                }
            });
    } catch (err) {
        alert(err);
    }
}//Fin actualizaTutoria ================================================

function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        // elHTML2 = ObjetoJSON[i].primerApellido;
        // elHTML3 = ObjetoJSON[i].segundoApellido;
        $('#idDoctor').append($('<option></option>').val(elValor));
    }
}

function ActualizacionInsercionTutoriaExitosa(TextoJSON) {

    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
    LimpiaCampos();
    window.location.replace("tutorias.html");
}//Fin ActualizacionInsercionTutoriaExitosa ================================================

function LimpiaCampos() {
    $('#nombreAlumno').val('');
    $('#asunto').val('');
    $("#idProfesor").val("1");
    $("#idDia").val("1");
    $("input[name=hora][value='10']").prop("checked",true);
    //$('input[name="hora"]').attr('checked', false);
}//Fin LimpiaCampos ================================================

function ActualizacionTutoriaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor ..</p>' + TextoJSON.responseText);
}//Fin InsercionTutoriaFallida ================================================

function LlenaTutoriaJson(TextoJSON) {
    var ObjetoJSON = JSON.parse(TextoJSON);
    $('#nombreAlumno').val(ObjetoJSON.alumno);
    $('#asunto').val(ObjetoJSON.asunto);
    $("#idProfesor").val(ObjetoJSON.idProfesor);
    $("#idDia").val(ObjetoJSON.idDia);
    $("input[name=hora][value=" + ObjetoJSON.hora + "]").prop("checked",true);
}//Fin LlenaProfesorJson =========================================