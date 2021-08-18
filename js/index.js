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
