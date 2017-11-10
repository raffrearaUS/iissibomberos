<?php
session_start();
require_once("gestionarUsuarios.php");
require_once("gestionBD.php");
if (isset($_REQUEST["pid"])) {
	$formulario["pid"] = $_REQUEST["pid"];
	$formulario["Puesto"] = $_REQUEST["Puesto"];	
	
	$_SESSION["formulario"] = $formulario;
	$errores = validarUsuario($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: recontrata.php");
	} else {
		
		header("Location:exito_recontrata.php");
	}

} else {
	
	header("Location: recontrata.php");
}

function validarUsuario($formulario) {
	$con = crearConexionBD();
	$usuarios = consultarUsuariosDespedidos($con);
	$existe = false;
	foreach ($usuarios as $u) {
		if ($u["PID"]== $formulario["pid"]) {
			$existe = true;
		}
	}
	if (!$existe) {
		$error[] = "<p>Selecciona un empleado de la lista</p>";
	}
	$pers["personal"] = $formulario["pid"];
	if (($formulario["Puesto"] == "SARGENTO" || $formulario["Puesto"] == "CABO")
	&& cuenta_tiempo($con, $pers) < 365*2) {
		$error[] = "<p>Selecciona un rango de la lista</p>";
	}
	
	cerrarConexionBD($con);
	return $error;
}
?>