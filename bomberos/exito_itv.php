<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once("gestionBD.php");
require_once("gestionarItv.php");

if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: nuevo_vehiculo.php");
}
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>ITV añadida</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once('cabecera.php');
		include_once('menu.php');
		?>
		<div class="contenedor">
		<?php
        $conexion = crearConexionBD();
        if (alta_itv($conexion, $formulario)) {
        ?>
        
		<h2>Se ha realizado con éxito la inserción de la nueva ITV.</h2>
		<p>Los valores de la ITV son:</p>
		<ul>
			<li><?php echo "Fecha: " . $formulario["Fecha"]; ?></li>
			<li><?php echo "Resultado: " . $formulario["Resultado"]; ?></li>
			<li><?php echo "Vehículo: " . $formulario["Vehiculo"]; ?></li>
		</ul>
		<?php 
		}
        cerrarConexionBD($conexion);
        ?>
		</div>
		<?php
		include_once('pie.php');
		?>
	</body>
</html>