function validarFormularioRegistro(){
	var error1= validarNombre();
	var error2= validarApellidos();
    var error3= validarPid();
    var error4= validarPass();
    var error5= validarConfirmacionPass();
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0) && (error5.length==0);
}


//Validacion del nombre
function validarNombre(){
	var mensaje="";
	var nom = document.getElementById("nombre");
	var valid = true;
    
    valid =  valid && (nom.value != "");
	
	if(!valid){
		mensaje = "El nombre no puede estar vacío";
	}
    nom.setCustomValidity(mensaje);
	return mensaje;
}


//Validacion de los apellidos
function validarApellidos(){
	var mensaje="";
	var apell = document.getElementById("apellidos");
	var valid = true;

    valid =  valid && (apell.value != "");
	
	if(!valid){
		mensaje = "Los apellidos no pueden estar vacíos";
	}
    apell.setCustomValidity(mensaje);
	return mensaje;
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
function validarPass(){
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

//Validacion de contraseña y confirmacion son iguales
function validarConfirmacionPass(){
	var mensaje="";
	var confirmarContrasena = document.getElementById("confirmpass");
    var contrasena = document.getElementById("pass").value;
	var valid = true;
    
    valid = valid && (contrasena == confirmarContrasena.value);
	
	if(!valid){
		mensaje = "La contraseña no coincide con la confirmación de la contraseña";
	}
    confirmarContrasena.setCustomValidity(mensaje);
	return mensaje;
}