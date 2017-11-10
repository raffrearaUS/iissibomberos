function validarFormularioIncidencia(){
	var error1= validarFechaIncidencia();
	var error2= validarDireccion();
	var error3= validarDenominacion();
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0);
}



//Validacion de la matricula
function validarFechaIncidencia(){
	var mensaje="";
	var fechaInc = document.getElementById("fechaIncidencia");
	var fechaIncidencia = new Date(Date.parse(fechaInc.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid = true;
    
    valid = valid && fechaIncidencia <= fechaActual;
	
	if(!valid){
		mensaje = "La fecha de una incidencia no puede ser posterior a la fecha actual";
	}
    fechaInc.setCustomValidity(mensaje);
	return mensaje;
}
//Validacion de la direccion
function validarDireccion(){
	var mensaje="";
	var direccion = document.getElementById("direccionIncidencia");
	var valid = true;
    
    valid = valid && (direccion.value!="");
	
	if(!valid){
		mensaje = "La dirección de la incidencia no puede estar vacía";
	}
    direccion.setCustomValidity(mensaje);
	return mensaje;
}
//Validacion de la denominacion
function validarDenominacion(){
	var mensaje="";
	var denominacion = document.getElementById("denominacionIncidencia");
	var valid = true;
    
    valid = valid && (denominacion.value!="");
	
	if(!valid){
		mensaje = "La denominación de la incidencia no puede estar vacía ";
	}
    denominacion.setCustomValidity(mensaje);
	return mensaje;
}
