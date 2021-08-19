$(document).ready(function () {
    
    cargaDoctores();

   $("#btEnviar").click(function() {
       actualizaCitaPaciente($("#idDoctor").val(), $("#nombre").val(), $("#cedula").val(), $("#celular").val(),
       $("#correo").val(), $("#fechaNacimiento").val(), $("#fechaCita").val(), $("#padecimiento").val());
   });

    $("#btRestablecer").click(function () {
        LimpiaCampos();
    });
    

});

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

function cargaCita() {
    try {
        $.ajax({
            url: 'getCita.php?idCitaPaciente=' + $("#idCitaPaciente").val()
        })
            .done(function (data) {
                LlenaCitaJson(data);
            });
    } catch (err) {
        alert(err);
    }
}

function actualizaCitaPaciente(pidDoctor, pnombrePaciente, pcedula, pcelular, pcorreo, pfechaNacimiento, pfechaCita, ppadecimiento) {
    try {
        $.ajax(
            {
                data: {
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
                    ActualizacionInsercionCitaExitosa(r);
                },
                error: function (r) {
                    ActualizacionCitaFallida(r);
                }
            });
    } catch (err) {
        alert(err);
    }
}

function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
    }
}

function ActualizacionInsercionCitaExitosa(TextoJSON) {

    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
    LimpiaCampos();
    window.location.replace("registro.html");
}

function LimpiaCampos() {
    $("#idDoctor").val(''),
    $("#nombre").val(''),
    $("#cedula").val(''),
    $("#celular").val(''),
    $("#correo").val(''),
    $("#fechaNacimiento").val(''),
    $("#fechaCita").val(''),
    $("#padecimiento").val('')
}

function ActualizacionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor ..</p>' + TextoJSON.responseText);
}

function LlenaCitaJson(TextoJSON) {
    var ObjetoJSON = JSON.parse(TextoJSON);
    $('#idDoctor').val(ObjetoJSON.idDoctor);
    $('#nombre').val(ObjetoJSON.nombre);
    $('#cedula').val(ObjetoJSON.cedula);
    $('#correo').val(ObjetoJSON.correo);
    $('#fechaNacimiento').val(ObjetoJSON.fechaNacimiento);
    $('#fechaCita').val(ObjetoJSON.fechaCita);
    $('#padecimiento').val(ObjetoJSON.padecimiento);
}