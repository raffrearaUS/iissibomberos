<?php
session_start();
if (isset($_REQUEST["Fecha"])) {
	// Recogemos los datos del formulario
	$formulario["Descripcion"] = $_REQUEST["Descripcion"];
	$formulario["Numero_de_visitantes"] = $_REQUEST["Numero_de_visitantes"];
	$formulario["Fecha"] = $_REQUEST["Fecha"];
	$formulario["DNI"] = $_REQUEST["DNI"];
	$formulario["Nombre"] = $_REQUEST["Nombre"];
	$formulario["Telefono"] = $_REQUEST["Telefono"];
	$formulario["Correo"] = $_REQUEST["Correo"];
	$formulario["Personal"] = $_REQUEST["Personal"];
	
	unset($errores);
// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"]= $formulario;
	
// Validamos el formulario en servidor 
	$errores = validarDatosVisita($formulario);
	
// Si se han detectado errores
	if(count($errores) > 0){
		$_SESSION["errores"] = $errores;
		header("Location: Visitas.php");
	}else{
		header("Location:exito_Visita_realizada.php");
	}
}else{
	header("Location: Visitas.php");
}

function validarDatosVisita($formulario){
	$fechaActual= date("Y-m-d"); //Fecha actual
	
	
	if(empty($formulario["Descripcion"])){
		$error[]= "<p>La descripción de la visita no puede estar vacía</p>";
	}
	if(empty($formulario["Numero_de_visitantes"]) || !($formulario["Numero_de_visitantes"] > 0) || !($formulario["Numero_de_visitantes"] <= 99)){
		$error[]= "<p>El número de vistantes no puede estar vacío y tiene que estar comprendido estre 0 y 100</p>";
	}	
	if(empty($formulario["Fecha"]) || $formulario["Fecha"] < $fechaActual ){
		$error[]= "<p>La fecha de la visita no puede ser anterior a la fecha actual</p>";
	}
	if(empty($formulario["Personal"] )){
		$error[]= "<p>Selecciona algún empleado</p>";
	}
	return $error;
}
?>




