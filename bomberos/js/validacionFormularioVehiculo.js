function validarFormularioVehiculo(){
	var error1= validarMatricula();
	var error2= validarNumeroPlazas();
	var error3= validarFechaMatriculacion();
	var error4= validarTipoVehiculo();
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0);
}



//Validacion de la matricula
function validarMatricula(){
	var mensaje="";
	var matricula = document.getElementById("matricula");
	var valid = true;
    
    valid = valid && (matricula.value!="") && (matricula.value.length==7 || matricula.value.length==8);
	
	if(!valid){
		mensaje = "La matrícula no puede estar vacía y debe tener 7 u 8 caracteres";
	}
	matricula.setCustomValidity(mensaje);
	return mensaje;
}
//Validacion del numero de plazas
function validarNumeroPlazas(){
	var mensaje="";
	var numeroPlazas = document.getElementById("nPlazas");
	var valid = true;
    
    valid = valid && numeroPlazas.value >0 && numeroPlazas.value <=9;
	
	if(!valid){
		mensaje = "El número de plazas tiene que ser mayor que 0 y menor que 10";
	}
    numeroPlazas.setCustomValidity(mensaje);
	return mensaje;
}
//Vaidacion de la fecha de matriculacion
function validarFechaMatriculacion(){
	var mensaje="";
	var fechaMatricula = document.getElementById("fechaMatriculacion");
	var fechaMat = new Date(Date.parse(fechaMatricula.value)).setHours(0,0,0,0);
	var fechaActual = new Date();
	fechaActual.setHours(0,0,0,0);
	var valid = true;
    valid = valid && (fechaMat <= fechaActual);

	if(!valid){
		mensaje = "La fecha de matriculación no puede ser posterior a la fecha actual";
	}
    fechaMatricula.setCustomValidity(mensaje);
	return mensaje;
}
//Validacion del tipo de vehiculo
function validarTipoVehiculo(){
	var mensaje="";
	var tipoVehiculo = document.getElementById("tipoVehiculo");
	var valid = true;
    
    valid = valid && tipoVehiculo.value!= "";
	
	
	if(!valid){
		mensaje = "El tipo de vehículo no puede estar vacío";
	}
    tipoVehiculo.setCustomValidity(mensaje);
	return mensaje;
}