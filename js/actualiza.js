$(document).ready(function () {
    
    cargaDoctores();

   $("#btEnviar").click(function() {
       actualizaCitaPaciente($("#nombre").val(), $("#pApellido").val(),
       $("#sApellido").val(), $("#cedula").val(), $("#celular").val(),
       $("#correo").val(), $("#fechaNacimiento").val(), $("#idDoctor").val(),
       $("#fechaCita").val(),$("#padecimiento").val());
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

function actualizaCitaPaciente(pnombrePaciente, pprimerApellido, psegundoApellido, pcedula, pcelular, pcorreo, pfechaNacimiento, pidDoctor, pfechaCita, ppadecimiento) {
    try {
        $.ajax(
            {
                data: {
                    nombre: pnombrePaciente,
                    pApellido: pprimerApellido,
                    sApellido: psegundoApellido,
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
    $("#nombre").val(''),
    $("#pApellido").val(''),
    $("#sApellido").val(''),
    $("#cedula").val(''),
    $("#celular").val(''),
    $("#correo").val(''),
    $("#fechaNacimiento").val(''),
    $("#idDoctor").val(''),
    $("#fechaCita").val(''),
    $("#padecimiento").val('')
}

function ActualizacionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor ..</p>' + TextoJSON.responseText);
}

function LlenaCitaJson(TextoJSON) {
    var ObjetoJSON = JSON.parse(TextoJSON);
    $('#nombre').val(ObjetoJSON.nombre);
    $('#pApellido').val(ObjetoJSON.primerApellido);
    $('#sApellido').val(ObjetoJSON.segundoApellido);
    $('#cedula').val(ObjetoJSON.cedula);
    $('#correo').val(ObjetoJSON.correo);
    $('#fechaNacimiento').val(ObjetoJSON.fechaNacimiento);
    $('#idDoctor').val(ObjetoJSON.idDoctor);
    $('#fechaCita').val(ObjetoJSON.fechaCita);
    $('#padecimiento').val(ObjetoJSON.padecimiento);
}