function validarFormularioTaller(){
	var error1= validarDireccion();
	
	return (error1.length==0);
}



//Validar direccion
function validarDireccion(){
	var mensaje="";
	var direccion = document.getElementById("direccion");
	var valid = true;
    
    valid = valid && direccion.value!="";
	
	if(!valid){
		mensaje = "La dirección de un taller no puede estar vacía";
	}
    direccion.setCustomValidity(mensaje);
	return mensaje;
}
