<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}
require_once ("gestionBD.php");
require_once ("gestionarUsuarios.php");

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
		<title>Registro completado</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/exitoFormulario.css" />
	</head>
	<body>
		<?php
		include_once ('cabecera.php');
		include_once('menu.php'); ?>
		<div class="contenedor">
		<?php if(alta_Usuario($con ,$formulario)) { ?>
		
		<div>
		<h2>Se ha registrado con éxito a <?php echo $formulario["nombre"] ?></h2>
		<h3>Los datos de registro son los siguientes:</h3>
		<ul>
			<li>PID: <?php echo $formulario["pid"] ?></li>
			<li>Nombre: <?php echo $formulario["nombre"] ?></li>
			<li>Apellidos: <?php echo $formulario["apellidos"] ?></li>
			<li>Rango: <?php echo $formulario["Puesto"] ?></li>
		</ul>
		</div>
		
		<?php } else { ?>
			<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
			<div id = "div_error_registro">
				<p>Ya existe un usuario con esos datos.</p>
			</div>
			<?php } ?>
		</div>
		<?php
		include_once ('pie.php');
		cerrarConexionBD($con); ?>
	</body>
</html>