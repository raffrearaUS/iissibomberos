function validarFormularioItv(){
	var error1= validarResultado();
	var error2= validarFecha();
	
	return (error1.length==0) && (error2.length==0);
}



//Validacion del resultado
function validarResultado(){
	var mensaje="";
	var resultado = document.getElementById("Resultado");
	var valid = true;
    
    valid = valid && resultado.value!="";
	
	if(!valid){
		mensaje = "El resultado de una ITV no puede estar vacío";
	}
    resultado.setCustomValidity(mensaje);
	return mensaje;
}

//Validacion de la fecha de la itv
function validarFecha(){
	var mensaje="";
	var fechaI = document.getElementById("Fecha");
	var fechaItv = new Date(Date.parse(fechaI.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid = true;
    
    valid = valid && fechaItv <= fechaActual;
	
	if(!valid){
		mensaje = "La fecha de la ITV de un vehículo no puede ser posterior a la fecha actual";
	}
    fechaI.setCustomValidity(mensaje);
	return mensaje;
}
