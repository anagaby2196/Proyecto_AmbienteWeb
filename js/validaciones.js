function valida_datos() {

var elComboDoctor = document.getElementById("idDoctor");

var idDoctor = elComboDoctor.options[elComboDoctor.selectedIndex].value;
   
if(idDoctor.selectedIndex == 0) {
       alert("Por favor escriba su nombre")
       document.formularioRegistro.doctor.focus()
       return 0;
}

if(document.formularioRegistro.nombre.length == 0) {
    alert("Por favor escriba su nombre")
    document.formularioRegistro.nombre.focus()
    return 0;
}

if(document.formularioRegistro.cedula.length == 0) {
    alert("Por favor escriba su nombre")
    document.formularioRegistro.cedula.focus()
    return 0;
}

if(document.formularioRegistro.celular.length == 0) {
    alert("Por favor escriba su nombre")
    document.formularioRegistro.celular.focus()
    return 0;
}

var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(0[1-9]|1[1-9]|2[1-9])$/;

        if (date_regex.test(document.formularioRegistro.fechaNacimiento)) {
            document.getElementById("message").innerHTML = "Date follows dd/mm/yyyy format";
        }
        else {
          document.getElementById("message").innerHTML = "Invalid date format";
        }

if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(document.formularioRegistro.correo)) {
    alert("La dirección de email " + valor + " es correcta.");
   } else {
    alert("La dirección de email es incorrecta.");
   }

if(document.formularioRegistro.fechaCita.length == 0) {
    alert("Por favor escriba su nombre")
    document.formularioRegistro.fechaCita.focus()
    return 0;
}

if(document.formularioRegistro.padecimiento.length == 0) {
    alert("Por favor escriba su nombre")
    document.formularioRegistro.padecimiento.focus()
    return 0;
}

}