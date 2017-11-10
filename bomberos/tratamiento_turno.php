<?php
session_start();
require_once("gestionBD.php");
require_once ("gestionarTurnos.php");

if (isset($_REQUEST["Fecha"])) {
	$formulario["Fecha"] = $_REQUEST["Fecha"];
	$formulario["Personal"] = $_REQUEST["Personal"];

	$_SESSION["formulario"] = $formulario;
	$errores = validarTurno($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: nuevo_turno.php");
	} else {
		header("Location:exito_turno.php");
	}

} else {
	header("Location: nuevo_turno.php");
}

function validarTurno($formulario) {
	$fechaActual= date("Y-m-d");
	if(empty($formulario["Fecha"]) || strtotime($formulario["Fecha"]) < strtotime($fechaActual)){
		$error[]= "<p>La fecha del turno no puede ser anterior a la fecha actual</p>";
	}
	
	if(empty($formulario["Personal"])) {
		$error[]= "<p>Debe elegir algún empleado</p>";
	}
	
	$conexion = crearConexionBD();
	if(consultarTurnos($conexion, $formulario) == false){
		$error[]= "<p>Un empleado no puede tener dos turnos consecutivos</p>";
	}
	
	
	cerrarConexionBD($conexion);
	return $error;
}
?>