<?php
session_start();
if (isset($_REQUEST["matricula"])) {
	$formulario["matricula"] = $_REQUEST["matricula"];
	$formulario["nombre"] = $_REQUEST["nombre"];
	$formulario["nPlazas"] = $_REQUEST["nPlazas"];
	$formulario["fechaMatriculacion"] = $_REQUEST["fechaMatriculacion"];
	$formulario["tipoVehiculo"] = $_REQUEST["tipoVehiculo"];
	
	$_SESSION["formulario"] = $formulario;
	$errores = validarUsuario($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location:nuevo_vehiculo.php");
	} else {
		header("Location:exito_vehiculo.php");
	}

} else {
	header("Location:nuevo_vehiculo.php");
}

function validarUsuario($formulario) {
	$fechaActual= date("Y-m-d"); //Fecha actual
	
	if(empty($formulario["matricula"]) || strlen($formulario["matricula"]) < 7){
		$error[]= "<p>La matrícula de un vehículo no puede estar vacía o tener menos de 7 caracteres</p>";	
	}
	if(empty($formulario["nPlazas"]) || $formulario["nPlazas"] <= 0 || $formulario["nPlazas"] > 9){
		$error[]= "<p>El número de plazas de un vehículo no puede estar vacío ni ser menor que 0 ni superior a 9</p>";
	}
	if($formulario["fechaMatriculacion"] > $fechaActual ){
		$error[]= "<p>La fecha de matriculacion de un coche no puede ser posterior a la fecha actual</p>";
	}
	if(empty($formulario["tipoVehiculo"])){
		$error[]= "<p>El tipo de un vehículo no puede estar vacío";
	}

	return $error;
}
?>