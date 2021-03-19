function formatoRut(rut){

    let aux = rut;

    let valor = rut.value.replaceAll('.','');
    //console.log(valor);
    valor = valor.replace('-',''); // rut sin puntos ni guion.

    let digitoVerificador = valor.slice(-1);
    let primeraParte;
    let segundaParte;
    let terceraParte;
    let rutSalida;

    if (valor.length == 9) {

        primeraParte = valor.substring(0,2);
        segundaParte = valor.substring(2,5);
        terceraParte = valor.substring(5,8);

    }else if(valor.length == 8){

        primeraParte = valor.substring(0,1);
        segundaParte = valor.substring(1,4);
        terceraParte = valor.substring(4,7);

    }

    rutSalida = primeraParte + '.' + segundaParte + '.' + terceraParte
        + '-' + digitoVerificador;

    return rutSalida;

};

function validarRut(rut){

    if(rut.value.length < 8) return ;

    var valor = rut.value.replace('.','');
    valor = valor.replace('.','');
    valor = valor.replace('-',''); // rut sin puntos ni guion.
    var cuerpo = valor.slice(0,-1);
    var digito_verificador = valor.slice(-1);
    var suma = 0;
    var iterador = 2;

    for(var i = cuerpo.length - 1 ; i >= 0; i--){

        if(iterador > 7) iterador = 2;
        suma = suma + cuerpo[i] * iterador;
        iterador++;

    }

    var resto = suma%11;

    var condicion = 11 - resto;

    var result = true;

    if( condicion == 11 && digito_verificador == 0) {

        return result;

    }else if(condicion == 10 && (digito_verificador == 'k' || digito_verificador == 'k')){

        return result;

    }else if(condicion == digito_verificador) {

        return result;
    }else{

        result = false;
        return result;
    }

};


$("#rut").change(function(e){

    e.preventDefault();

    let rut = document.getElementById("rut");

    let isValid = validarRut(rut);

    // console.log(rut.value);

    if(isValid){
        document.getElementById("rut").value = formatoRut(rut);
        document.getElementById("rut_alert").innerHTML = '';
    }else if(rut.value == ""){
        document.getElementById("rut_alert").innerHTML = '';
    }else{
        document.getElementById("rut_alert").innerHTML = 'Error, verifique el rut ingresado !';
    }
});



