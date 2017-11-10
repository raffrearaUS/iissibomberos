<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
		header("Location: login.php");
	}
require_once ("gestionBD.php");
require_once ("gestionarTalleres.php");

if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: registro.php");
}

$con = crearConexionBD();
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Taller añadido</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once ('cabecera.php');
		include_once ('menu.php');
		?>
		<div class="contenedor">
		<?php 	// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
// EN EL CONTEXTO DE UNA SENTENCIA IF
if(alta_taller($con ,$formulario)) {
	$_SESSION["login"] = $formulario["direccion"];
			?>
		
		<div>
		<h2>Se ha realizado con éxito la inserción del nuevo taller.</h2>
		<p>Los valores del taller son:</p>
		<ul>
			<li>Nombre: <?php echo $formulario["nombre"] ?></li>
			<li>Dirección: <?php echo $formulario["direccion"] ?></li>
		</ul>
		</div>
		
		<?php } else { ?>
			<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
			<div id = "div_error_registro">
				<p>Ya existe un taller con esos datos.</p>
			</div>
			<?php } ?>
		</div>
		<?php
		include_once ('pie.php');
		cerrarConexionBD($con);
		?>
		
	</body>
</html>