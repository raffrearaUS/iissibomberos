
function validarFormularioTurno(){
	var error1= validarFecha();
	
	return (error1.length==0);
}

//Validacion de la fecha
function validarFecha(){
	var mensaje="";
	var fechaTur = document.getElementById("Fecha");
	var fechaTurno = new Date(Date.parse(fechaTur.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid = true;
    
    valid = valid && fechaTurno >= fechaActual;
	
	if(!valid){
		mensaje = "La fecha de un turno no puede ser anterior a la fecha actual";
	}
    fechaTur.setCustomValidity(mensaje);
	return mensaje;
}