<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}
require_once("gestionBD.php");
require_once("gestionarTurnos.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: nuevo_turno.php");
}
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Turno añadido</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
	    $conexion = crearConexionBD(); ?>
	    <div class="contenedor">
	    <?php if (alta_turno($conexion, $formulario))	{ ?>
	    
		<h2>Se ha realizado con éxito la asignación del turno.</h2>
		<p></p>Los datos del turno son:</p>
		<ul>
			<li>Fecha: <?php echo $formulario["Fecha"] ?></li>
			<li>Empleado: <?php echo $formulario["Personal"] ?></li>
		</ul>
		<?php } else {
		?>	<p>El turno ya está guardado en la base de datos.</p> <?php 
		} ?>
		</div>
		<?php
		include_once ('pie.php');
		cerrarConexionBD($conexion);
		?>
	</body>
</html>