<?php
    session_start();
	require_once("gestionBD.php");
	require_once("gestionarMantenimiento.php");
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$formulario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}else{
		header("Location: nuevo_mantenimiento.php");
	} 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Mantenimiento añadido</title>
  <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
</head>

<body>
	
	<main>
		
		<?php
		include_once('cabecera.php');
		include_once('menu.php');
		$conexion = crearConexionBD(); ?>
		<div class="contenedor">
		<?php if (alta_mantenimiento($conexion, $formulario))	{
		?>
		<h2>Se ha realizado con éxito la inserción del nuevo mantenimiento.</h2>
		<p>Los datos del mantenimiento son:</p>
		<ul>
			<li><?php echo "Descripción: " . $formulario["Denominacion"]; ?></li>
			<li><?php echo "Fecha: " . $formulario["Fecha"]; ?></li>
			<li><?php echo "Vehículo: " . $formulario["Vehiculo"]; ?></li>
			<li><?php echo "Taller: " . $formulario["Taller"]; ?></li>
		</ul>
		<?php }
		cerrarConexionBD($conexion);
		?>
		</div>
		<?php include_once("pie.php"); ?>
	</main>	
	
	
</body>
</html>
