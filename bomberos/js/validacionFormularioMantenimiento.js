function validarFormularioMantenimiento(){
	var error1= validarDenominacion();
	var error2= validarFecha();
	
	return (error1.length==0) && (error2.length==0);
}



//Validacion de la denominacion
function validarDenominacion(){
	var mensaje="";
	var denominacion = document.getElementById("Denominacion");
	var valid = true;
    
    valid = valid && denominacion.value!="";
	
	if(!valid){
		mensaje = "La denominación no puede estar vacía";
	}
    denominacion.setCustomValidity(mensaje);
	return mensaje;
}
//Validacion de la fecha
function validarFecha(){
	var mensaje="";
	var fechaMant = document.getElementById("Fecha");
	var fechaMantenimiento = new Date(Date.parse(fechaMant.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid = true;
    
    valid = valid && fechaMantenimiento <= fechaActual;
	
	if(!valid){
		mensaje = "La fecha de un mantenimiento no puede ser posterior a la fecha actual";
	}
    fechaMant.setCustomValidity(mensaje);
	return mensaje;
}