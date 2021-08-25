$(document).ready(function () {

    cargaDoctores();

    $("#btEnviar").click(function () {

        ingresaPaciente($("#idDoctor").val(), $("#nombre").val(), $("#cedula").val(), $("#celular").val(),
            $("#correo").val(), $("#fechaNacimiento").val(), $("#fechaCita").val(), $("#padecimiento").val());
    });

    $("#btRestablecer").click(function () {

        LimpiaCampos();
    });
});//Final de document.ready


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
}//Fin Funcion cargaDoctores

function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
    }
}//Fin LlenaDoctoresJSON

function ingresaPaciente(pidDoctor, pnombrePaciente, pcedula, pcelular, pcorreo,
                         pfechaNacimiento, pfechaCita, ppadecimiento) {
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
                url: 'ingresoCita.php',
                type: 'POST',
                dataType: 'json',
    
                success: function (r) {
                    InsercionCitaExitosa(r);
                },
                error: function (r) {
                    InsercionCitaFallida(r);
                }
            });
    } catch (err) {
        alert(err);
    }
}//Fin Funcion ingresaPaciente

function InsercionCitaExitosa(ObjetoJSON) {

    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + ObjetoJSON.mensaje + '</p>');
    LimpiaCampos();
}//Fin Funcion InsercionCitaExitosa 

function InsercionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor ..</p>' + TextoJSON.responseText);
}//Fin Funcion InsercionCitaFallida

function LimpiaCampos() {
        $("#idDoctor").val(''),
        $("#nombre").val(''),
        $("#cedula").val(''),
        $("#celular").val(''),
        $("#correo").val(''),
        $("#fechaNacimiento").val(''),
        $("#fechaCita").val(''),
        $("#padecimiento").val('');
}// Fin Funcion LimpiaCampos