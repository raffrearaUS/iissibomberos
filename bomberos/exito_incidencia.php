<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once("gestionBD.php");
require_once("gestionarIncidencias.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: nueva_incidencia.php");
}
$conexion = crearConexionBD();
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Incidencia añadida</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once ('cabecera.php');
		include_once('menu.php'); ?>
		<div class="contenedor">
		<?php if (nueva_incidencia($conexion, $formulario)) {
		?>
		
		<h2>Se ha realizado con éxito la inserción de la nueva incidencia.</h2>
		<p>Los valores de la incidencia son:</p>
		<ul>
			<li><?php echo "Fecha: " . $formulario["fechaIncidencia"]; ?></li>
			<li><?php echo "Dirección: " . $formulario["direccionIncidencia"]; ?></li>
			<li><?php echo "Denominación: " . $formulario["denominacionIncidencia"]; ?></li>
			<li>Personal que ha acudido: 
				<ul> 
				<?php
				foreach($formulario["Personal"] as $pers) {
					echo "<li>".$pers."</li>";
				} ?>
				</ul>
			</li>
			<li>Vehículos que han participado: 
				<ul> 
				<?php
				foreach($formulario["Vehiculos"] as $veh) {
					echo "<li>".$veh."</li>";
				} ?>
				</ul>
			</li>
		</ul>
		<?php } ?>
		</div>
		<?php include_once ('pie.php');
		?>
	</body>
</html>
<?php cerrarConexionBD($conexion) ?>