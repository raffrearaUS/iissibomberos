<?php
require_once("gestionBD.php");
require_once("gestionarVehiculos.php");
session_start();
if (isset($_REQUEST["fechaIncidencia"])) {
	$formulario["fechaIncidencia"] = $_REQUEST["fechaIncidencia"];
	$formulario["direccionIncidencia"] = $_REQUEST["direccionIncidencia"];
	$formulario["denominacionIncidencia"] = $_REQUEST["denominacionIncidencia"];
	$formulario["Personal"] = $_REQUEST["Personal"];
	$formulario["Vehiculos"] = $_REQUEST["Vehiculos"];

	$_SESSION["formulario"] = $formulario;
	$errores = validarIncidencia($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: nueva_incidencia.php");
	} else {
		header("Location:exito_incidencia.php");
	}

} else {
	header("Location: nueva_incidencia.php");
}



function validarIncidencia($formulario) {
	$fechaActual= date("Y-m-d"); //Fecha actual

	if(empty($formulario["fechaIncidencia"]) || $formulario["fechaIncidencia"] > $fechaActual ){
		$error[]= "<p>La fecha de la incidencia no puede ser posterior a la fecha actual</p>";
	}
	if(empty($formulario["direccionIncidencia"])){
		$error[]= "<p>La dirección de la incidencia no puede estar vacía</p>";
	}
	if(empty($formulario["denominacionIncidencia"])){
		$error[]= "<p>La denominación de la incidencia no puede estar vacía</p>";
	}
	if(empty($formulario["Personal"])){
		$error[]= "<p>Debe acudir alguna persona</p>";
	}
	if(empty($formulario["Vehiculos"])){
		$error[]= "<p>Debe acudir algún vehículo</p>";
	}
	$conexion = crearConexionBD();
	$plazas = cuenta_plazas($conexion, $formulario["Vehiculos"]);
	cerrarConexionBD($conexion);
	$personas = count($formulario["Personal"]);
	if ($plazas < $personas) {
		$error[]="<p>El total de plazas de vehículos debe ser mayor o igual que el número de personas (plazas: ".$plazas."; personas: ".$personas.")</p>";
	}
	return $error;
}
?>