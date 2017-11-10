<?php
session_start();
if (isset($_REQUEST["direccion"])) {
	$formulario["nombre"] = $_REQUEST["nombre"];
	$formulario["direccion"] = $_REQUEST["direccion"];
	
	$_SESSION["formulario"] = $formulario;
	$errores = validarTaller($formulario);
	
	if (count($errores) > 0) {
		$_SESSION["errores"] = $errores;
		header("Location: nuevo_taller.php");
	} else {
		header("Location: exito_taller.php");
	}

} else {
	header("Location: nuevo_taller.php");
}

function validarTaller($formulario) {
	if (strlen($formulario["nombre"])>30) {
		$error[] = "<p>El nombre no puede contener más de 30 caracteres</p>";
	}

	if (empty($formulario["direccion"]) || strlen($formulario["direccion"])>50) {
		$error[] = "<p>La dirección no puede estar vacía ni contener más de 50 caracteres</p>";
	}

	return $error;
}
?>