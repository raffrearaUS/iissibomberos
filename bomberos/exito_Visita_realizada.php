<?php
    require_once("gestionBD.php");
require_once("gestionarVisitas.php");

    session_start();
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$formulario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}else{
		header("Location: Visitas.php");
	} 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Visita solicitada</title>
  <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
</head>

<body>
	
	<main>
		<?php 
		include_once("cabecera.php");
		include_once("menu.php");
		$con = crearConexionBD(); ?>
		<div class="contenedor">
		<?php if (nueva_visita($con, $formulario)) {?>
			<h2> La visita ha sido solicitada con éxito.</h2>
		<p>Los datos introducidos son los siguientes:</p>
		<ul>
			<li><?php echo "Descripción: " . $formulario["Descripcion"]; ?></li>
			<li><?php echo "Número de visitantes: " . $formulario["Numero_de_visitantes"]; ?></li>
			<li><?php echo "Fecha: " . $formulario["Fecha"]; ?></li>
		</ul>
		<?php } else {?> 
			<p>Ya existe una visita para la fecha solicitada.</p>
			
		<?php } 
		cerrarConexionBD($con);
		?>
		</div>
		<?php include_once("pie.php"); ?>
	</main>
		
</body>
</html>
