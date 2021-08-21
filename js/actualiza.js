$(document).ready(function () {
    
    cargaDoctores();
    cargaCita();

   $("#btEnviar").click(function() {
       actualizaCitaPaciente($("#idCitaPaciente").val(),$("#idDoctor").val(), $("#nombre").val(), $("#cedula").val(), $("#celular").val(),
                             $("#correo").val(), $("#fechaNacimiento").val(), $("#fechaCita").val(), $("#padecimiento").val());
   });

    $("#btRestablecer").click(function () {
        LimpiaCampos();
    });
    

});// Fin document.ready

function cargaDoctores() {
    try {
        $.ajax ({
            url: 'getDoctores.php'
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
            url: 'getCita.php?idCitaPaciente=' + $("#idCitaPaciente").val()
        })
            .done(function (data) {
                LlenaCitaJson(data);
            });
    } catch (err) {
        alert(err);
    }
}//Fin Funcion cargaCita

function actualizaCitaPaciente(pidCitaPaciente, pidDoctor, pnombrePaciente, pcedula, pcelular, pcorreo, pfechaNacimiento, pfechaCita, ppadecimiento) {
    try {
        $.ajax(
            {
                data: {
                    idCitaPaciente: pidCitaPaciente,
                    idDoctor: pidDoctor,
                    nombre: pnombrePaciente,
                    cedula: pcedula,
                    celular: pcelular,
                    correo: pcorreo,
                    fechaNacimiento: pfechaNacimiento,
                    fechaCita: pfechaCita,
                    padecimiento: ppadecimiento,
                },
                url: 'actualiza.php',
                type: 'POST',
                dataType: 'json',
               
                success: function (r) {
                    ActualizacionCitaExitosa(r);
                },
                error: function (r) {
                    ActualizacionCitaFallida(r);
                }
            });
    } catch (err) {
        alert(err);
    }
}// Fin Funcion actualizaCitaPaciente

function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
    }
}//Fin Funcion LlenaDoctoresJSON

function ActualizacionCitaExitosa(TextoJSON) {

    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
    LimpiaCampos();
    window.location.replace("registro.html");
}//Fin Funcion ActualizacionInsercionCitaExitosa

function ActualizacionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrió un error en el servidor ..</p>' + TextoJSON.responseText);
}//Fin Funcion ActualizacionCitaFallida

function LimpiaCampos() {
    $("#idDoctor").val(''),
    $("#nombre").val(''),
    $("#cedula").val(''),
    $("#celular").val(''),
    $("#correo").val(''),
    $("#fechaNacimiento").val(''),
    $("#fechaCita").val(''),
    $("#padecimiento").val('');
}//Fin Funcion LimpiaCampos

function LlenaCitaJson(TextoJSON) {
    var ObjetoJSON = JSON.parse(TextoJSON);
    $('#idDoctor').val(ObjetoJSON.idDoctor);
    $('#nombre').val(ObjetoJSON.nombre);
    $('#cedula').val(ObjetoJSON.cedula);
    $('#correo').val(ObjetoJSON.correo);
    $('#fechaNacimiento').val(ObjetoJSON.fechaNacimiento);
    $('#fechaCita').val(ObjetoJSON.fechaCita);
    $('#padecimiento').val(ObjetoJSON.padecimiento);
}//Fin Funcion LlenaCitaJSON