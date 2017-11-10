function validarFormularioLogin(){
	var error1= validarPid();
	var error2= validarContrasena();
	
	return (error1.length==0) && (error2.length==0);
}



//Validacion del pid
function validarPid(){
	var mensaje="";
	var pid = document.getElementById("pid");
	var valid = true;
    
    valid = valid && (pid.value > 0) && (pid.value <= 99);
	
	if(!valid){
		mensaje = "El PID de un personal no puede ser menor o igual que 0 y mayor o igual a 100";
	}
    pid.setCustomValidity(mensaje);
	return mensaje;
}


//Validacion de la contraseña
function validarContrasena(){
	var mensaje="";	
    var password = document.getElementById("pass");
    var valid = true;
	var longitud = password.value.length>=8; //Longitud de la cadena tiene que ser mayor o igual a 8.
	
    valid= valid && longitud;
		
    if(!valid){
        mensaje = "La longitud de la contraseña debe ser mayor o igual que 8";
    }
    password.setCustomValidity(mensaje);
    return mensaje;
}
