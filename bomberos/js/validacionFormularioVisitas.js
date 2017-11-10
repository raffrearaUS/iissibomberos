/**
 * @author raulr
 */
function validarFormularioVisitas(){
	var error1= validarDescripcion();
	var error2= validarNumeroVisitantes();
	var error3= validarFecha();
	
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0);
}


//Validacion de la descripción
function validarDescripcion(){
	var mensaje="";
	var descripcion= document.getElementById("Descripcion");
	var valid= true;
    
    valid = valid && (descripcion.value != "");
	
	if(!valid){
		mensaje= "La descripción de una visita no puede estar vacía";
	}
    descripcion.setCustomValidity(mensaje);
	return mensaje;
}

//Validacion del numero de visitantes
function validarNumeroVisitantes(){
	var mensaje="";
	var numVis= document.getElementById("Numero_de_visitantes");
	var valid= true;
    
    valid = valid && (numVis.value > 0) && (numVis.value <= 99);
    
	if(!valid){
		mensaje= "El número de visitantes no puede ser ni cero, ni negativo ni superior a 99";
	}
    numVis.setCustomValidity(mensaje);
	return mensaje;
}

//Validacion de la fecha de la visita
function validarFecha(){
	var mensaje="";
	var fechaVisita = document.getElementById("Fecha");
	var fechaVis = new Date(Date.parse(fechaVisita.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid= true;
    
    valid = valid && fechaVis > fechaActual;
	
	if(!valid){
		mensaje = "La fecha de la visita tiene que ser posterior a la fecha actual";
	}
    fechaVisita.setCustomValidity(mensaje);
	return mensaje;
}


