<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}
require_once("gestionBD.php");
require_once("gestionarAscenso.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: ascenso.php");
}
$conexion = crearConexionBD();
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Ascenso realizado</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once ('cabecera.php');
		include_once('menu.php'); ?>
		<div class="contenedor">
		<?php if (ascenso($conexion, $formulario)) {
		?>
		<h2>Ascenso realizado con éxito</h2>
			<p>El empleado <?php echo $formulario["personal"] ?> ha sido correctamente ascendido a <?php echo $formulario["rango"] ?>.</p>
		<?php } else { ?>
			<p>No se ha podido realizar el ascenso.</p>
		<?php } ?>
		</div>
		<?php include_once ('pie.php');
		?>
	</body>
</html>
<?php cerrarConexionBD($conexion) ?>