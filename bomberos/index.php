<?php 
session_start()
 ?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Parque de Bomberos PM</title>
		<link rel="shortcut icon" href="images/logo.jpg">
		<link rel="apple-touch-icon" href="images/logo.jpg">
		<link rel="stylesheet"  href="css/navegacion.css"/>
		<link rel="stylesheet"  href="css/EstilosIndex.css"/>
		<link rel="stylesheet"  href="css/EstilosComun.css"/>

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		?>
			<h1 class="tituloPagina">INICIO</h1>
		<div class="contenido">
			<h2>Bienvenido a la página web del parque de bomberos de Pino Montano</h2>
		</div>
		<div class="slider">
	<ul>
		<li> <img src="images/IMG_20161012_111007.jpg"></img> </li>
		<li> <img src="images/IMG_20161012_105914.jpg"></img> </li>
		<li> <img src="images/IMG_20161012_105620.jpg"></img> </li>
		<li> <img src="images/IMG_20161012_110155.jpg"></img> </li>
	</ul>
</div>

		<?php
		include_once ('pie.php');
		?>
	</body>
</html>