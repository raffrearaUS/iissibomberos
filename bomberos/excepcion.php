<?php
session_start();
unset($_SESSION["excepcion"]);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/biblio.css" />
		<title>Parque de bomberos: ¡Se ha producido un problema!</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
		<link rel="stylesheet" type="text/css" href="CSS/excepcion.css" />
	</head>
	<body>

		<?php
		include_once ("cabecera.php");
		include_once ('menu.php');
		?>

		<div id="contenedorExcepcion">
			<h2>¡Ups!</h2>
			<div id= "imagen"><img src="http://rs1104.pbsrc.com/albums/h329/zorq1/Realistic-fire-animated-transparent-gif-short.gif~c200" />
			</div>
			<p>
				Ocurrió un problema al acceder a la base de datos.
			</p>
		</div>


		<?php
		include_once ("pie.php");
		?>
	</body>
</html>