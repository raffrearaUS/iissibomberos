<?php
require_once("gestionBD.php");
require_once("gestionarUsuarios.php");
session_start();
if (isset($_REQUEST["personal"])) {
	$formulario["personal"] = $_REQUEST["personal"];
	$formulario["rango"] = $_REQUEST["rango"];
	$_SESSION["formulario"] = $formulario;
	$errores = validarAscenso($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: ascenso.php");
	} else {
		header("Location: exito_ascenso.php");
	}

} else {
	header("Location: ascenso.php");
}



function validarAscenso($formulario) {
	if(empty($formulario["personal"])){
		$error[]= "<p>Debe elegir un empleado</p>";
	}
	if(empty($formulario["rango"])){
		$error[]= "<p>Debe elegir un rango</p>";
	}
	if($formulario["rango"] == "CABO" || $formulario["rango"] == "SARGENTO") {
		$conexion = crearConexionBD();
		$cuenta = cuenta_tiempo($conexion, $formulario);
		cerrarConexionBD($conexion);
		if($cuenta < 365 * 2) {
			$error[] = "<p>Para ser sargento o cabo el empleado debe haber trabajado al menos dos años (actual: ".$cuenta.")</p>";
		}
	}
	return $error;
}
?>