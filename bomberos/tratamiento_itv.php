<?php
session_start();
if (isset($_REQUEST["Fecha"])) {
	$formulario["Fecha"] = $_REQUEST["Fecha"];
	$formulario["Resultado"] = $_REQUEST["Resultado"];
	$formulario["Vehiculo"] = $_REQUEST["Vehiculo"];
	
	$_SESSION["formulario"] = $formulario;
	$errores = validarItv($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location:nueva_itv.php");
	} else {
		header("Location:exito_itv.php");
	}

} else {
	header("Location:nueva_itv.php");
}

function validarItv($formulario) {
	$fechaActual= date("Y-m-d"); //Fecha actual
	
	if(empty($formulario["Fecha"]) || $formulario["Fecha"] > $fechaActual ){
		$error[]= "<p>La fecha de la ITV de un coche no puede ser posterior a la fecha actual</p>";
	}
	if(empty($formulario["Resultado"])){
		$error[]= "<p>El resultado de una ITV no puede estar vacío";
	}
	return $error;
}
?>