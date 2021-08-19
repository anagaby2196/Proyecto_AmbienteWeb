$(document).ready(function(){
   
    cargaDoctores();

   $("#btEnviar").click(function(){
       ingresaPaciente($("#nombre").val(),$("#pApellido").val(),
       $("#sApellido").val(),$("#cedula").val(),$("#celular").val(),
       $("#correo").val(),$("#fechaNacimiento").val(),$("input[name='doctor']:checked").val(),
       $("#fechaCita").val(),$("#padecimiento").val())
   })

   $("btRestablecer").click(function(){
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
function LlenaDoctoresJson(TextoJSON) {
    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i].idDoctor;
        elHTML = ObjetoJSON[i].Nombre;
        elHTML2 = ObjetoJSON[i].primerApellido;
        elHTML3 = ObjetoJSON[i].segundoApellido;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML).html(elHTML2).html(elHTML3));
    }
}

function ingresaPaciente(pnombrePaciente, pprimerApellido, psegundoApellido, pcedula,pcelular,pcorreo,pfechaNacimiento,pidDoctor,pfechaCita,ppadecimiento) {
    try {
        $.ajax(
            {
                data: {
                    nombrePaciente=pnombrePaciente,
                    primerApellido=pprimerApellido,
                    segundoApellido=psegundoApellido,
                    cedula=pcedula,
                    celular=pcelular,
                    correo=pcorreo,
                    fechaNacimiento=pfechaNacimiento,
                    idDoctor=pidDoctor,
                    fechaCita=pfechaCita,
                    padecimiento=ppadecimiento,

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
}
function InsercionCitaExitosa(TextoJSON) {

    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
    LimpiaCampos();
}
function InsercionCitaFallida(TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor ..</p>' + TextoJSON.responseText);
}

function LimpiaCampos() {
    $("#nombre").val(''),
    $("#pApellido").val(''),
    $("#sApellido").val(''),
    $("#cedula").val(''),
    $("#celular").val(''),
    $("#correo").val(''),
    $("#fechaNacimiento").val(''),
    $("input[name='doctor']:checked").val(''),
    $("#fechaCita").val(''),
    $("#padecimiento").val('')
}
