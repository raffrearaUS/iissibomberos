<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once("gestionBD.php");
require_once("gestionarVehiculos.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: nuevo_vehiculo.php");
}
$conexion = crearConexionBD();
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Vehículo añadido</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once('cabecera.php');
		include_once('menu.php'); ?>
		<div class="contenedor">
		<?php if (nuevo_vehiculo($conexion, $formulario))	{
		?>
		<h2>Se ha realizado con éxito la inserción del nuevo vehículo.</h2>
		<p>Los valores del vehículo son:</p>
		<ul>
			<li><?php echo "Matrícula: " . $formulario["matricula"]; ?></li>
			<li><?php echo "Nombre: " . $formulario["nombre"]; ?></li>
			<li><?php echo "Número de plazas: " . $formulario["nPlazas"]; ?></li>
			<li><?php echo "Fecha de matriculación: " . $formulario["fechaMatriculacion"]; ?></li>
			<li><?php echo "Tipo de vehículo: " . $formulario["tipoVehiculo"]; ?></li>
		</ul>
		<?php } else { ?>
			<p>Ya existe un vehículo con la misma matrícula.</p>
		<?php } ?>	
		</div>
		<?php
		include_once('pie.php');
		?>
	</body>
</html>
<?php cerrarConexionBD($conexion) ?>
