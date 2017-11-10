<?php
session_start();
if (isset($_REQUEST["Fecha"])) {
	// Recogemos los datos del formulario
	$formulario["Denominacion"] = $_REQUEST["Denominacion"];
	$formulario["Fecha"] = $_REQUEST["Fecha"];
	$formulario["Vehiculo"] = $_REQUEST["Vehiculo"];
	$formulario["Taller"] = $_REQUEST["Taller"];
	
	
// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"]= $formulario;
	
// Validamos el formulario en servidor 
	$errores = validarDatosMantenimiento($formulario);
	
// Si se han detectado errores
	if(count($errores) > 0){
		$_SESSION["errores"] = $errores;
		header("Location: nuevo_mantenimiento.php");
	}else{
		header("Location:exito_mantenimiento.php");
	}
}else{
	header("Location: nuevo_mantenimiento.php");
}

function validarDatosMantenimiento($formulario){
	$fechaActual= date("Y-m-d"); //Fecha actual
	
	//Validacion de la descripcion.No puede estar vacio
	if(empty($formulario["Denominacion"])){
		$error[]= "<p>La descripción del mantenimiento no puede estar vacía</p>";
	}
	
	if(empty($formulario["Vehiculo"])){
		$error[]= "<p>Debe elegir un vehículo</p>";
	}
	
	if(empty($formulario["Taller"])){
		$error[]= "<p>Debe elegir un taller</p>";
	}
		
	//Validacion de la fecha. No puede ser anterior a la fecha actual	
	if(empty($formulario["Fecha"]) || strtotime($formulario["Fecha"]) > strtotime($fechaActual)){
		$error[]= "<p>La fecha del mantenimiento no puede ser posterior a la fecha actual</p>";
	}
	return $error;
}
?>




