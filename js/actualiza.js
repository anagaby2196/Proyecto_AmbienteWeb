$(document).ready(function() {
    cargaDoctores();
    cargaCita();

    $("#btEnviar").click(function() {
        actualizaCitaPaciente($("#pidCitaPaciente").val(), $("#nombre").val(), $("#cedula").val(), $("#celular").val(), $("#correo").val(),
        $("#fechaNacimiento").val(), $("#idDoctor").val(), $("fechaCita").val(), $("#padecimiento").val());
    });
    $("#btRestablecer").click(function () {
        LimpiaCampos();
    });
});// Fin document.ready

function cargaDoctores() {
    try {
        $.ajax ({
            url:'getDoctores.php'
        })
        .done(function (data) {
            LlenaDoctoresJson(data);
        });
    } catch (err) {
        alert(err);
    }
}//Fin Funcion cargaDoctores

function cargaCita() {
    try {
        $.ajax ({
            url: 'getCita.php?pidCitaPaciente=' + $("#pidCitaPaciente").val()
        })
        .done(function (data) {
            LlenaCitaJson(data);
        });
    } catch(err){
        alert(err);
    }
}//Fin Funcion cargaCita

function actualizaCitaPaciente (pidCitaPaciente, pnombrePaciente, pcedula, pcelular, pcorreo, pfechaNacimiento, pidDoctor, pfechaCita, ppadecimiento) {
    try {
        $.ajax({
            data: {
                idCitaPaciente: pidCitaPaciente,
                nombre: pnombrePaciente,
                cedula: pcedula,
                celular: pcelular,
                correo: pcorreo,
                fechaNacimiento: pfechaNacimiento,
                idDoctor: pidDoctor,
                fechaCita: pfechaCita,
                padecimiento: ppadecimiento,
            },
            url: 'actualiza.php',
            type: 'POST',
            dataType: 'json',

            success: function(r){
                ActualizacionCitaExitosa(r);
            },
            error: function(r){
                ActualizacionCitaFallida(r);
            }
        });
    } catch (err){
        alert(err);
    }
}// Fin Funcion actualizaCitaPaciente

function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i=0; i<ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
    }
}//Fin Funcion LlenaDoctoresJSON

function ActualizacionCitaExitosa (ObjetoJSON) {
    $("#pnlInfo").dialog();
    $("#blInfo").html('<p' + ObjetoJSON.mensaje + '</p>');
    LimpiaCampos();
    window.location.replace("citas.html");
}//Fin Funcion ActualizacionInsercionCitaExitosa

function ActualizacionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrió un error en el servidor ..</p>' + TextoJSON.responseText);
}//Fin Funcion ActualizacionCitaFallida

// function ActualizacionCitaFallida (ObjetoJSON) {
//     $("#pnlMensaje").dialog();
//     $("#pnlMensaje").html('<p>Ocurrió un error en el servidor ..</p>' + ObjetoJSON.mensaje)
// }

function LimpiaCampos () {
    $("#nombre").val('');
    $("#cedula").val('');
    $("#celular").val('');
    $("#correo").val('');
    $("#fechaNacimiento").val('');
    $("#idDoctor").val("1");
    $("#fechaCita").val('');
    $("#padecimiento").val('');
}//Fin Funcion LimpiaCampos

function LlenaCitaJson (TextoJSON) {
    var ObjetoJSON = JSON.parse(TextoJSON);
    $('#nombre').val(ObjetoJSON.nombre);
    $('#cedula').val(ObjetoJSON.cedula);
    $('#celular').val(ObjetoJSON.celular);
    $('#correo').val(ObjetoJSON.correo);
    $('#fechaNacimiento').val(ObjetoJSON.fechaNacimiento);
    $('#idDoctor').val(ObjetoJSON.idDoctor);
    $('#fechaCita').val(ObjetoJSON.fechaCita);
    $('#padecimiento').val(ObjetoJSON.padecimiento);
}//Fin Funcion LlenaCitaJSON