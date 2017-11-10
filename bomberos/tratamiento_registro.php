<?php
session_start();
if (isset($_REQUEST["pid"])) {
	$formulario["pid"] = $_REQUEST["pid"];
	$formulario["nombre"] = $_REQUEST["nombre"];
	$formulario["apellidos"] = $_REQUEST["apellidos"];
	$formulario["pass"] = $_REQUEST["pass"];
	$formulario["confirmpass"] = $_REQUEST["confirmpass"];
	$formulario["Puesto"] = $_REQUEST["Puesto"];
	
	
	$_SESSION["formulario"] = $formulario;
	$errores = validarUsuario($formulario);

	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: registro.php");
	} else {
		
		header("Location:exito_registro.php");
	}

} else {
	header("Location: registro.php");
}

function validarUsuario($formulario) {
	
	
	if (empty($formulario["nombre"])) {
		$error[] = "<p>El nombre no puede estar vacío</p>";
	}

	if (empty($formulario["apellidos"])) {
		$error[] = "<p>Los apellidos no pueden estar vacíos</p>";
	}

	if (empty($formulario["pid"]) || !is_numeric($formulario["pid"]) || $formulario["pid"] < 0 || $formulario["pid"] > 99) {
		$error[] = "<p>El PID es incorrecto</p>";
	}

	if (strlen($formulario["pass"]) < 8) {
		$error[] = "<p>La contraseña debe tener 8 caracteres como mínimo</p>";
	}

	if ($formulario["confirmpass"] != $formulario["pass"]) {
		$error[] = "<p>La confirmación no coincide con la contraseña</p>";
	}
	return $error;
}
?>