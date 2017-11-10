<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}
require_once("gestionBD.php");
require_once("gestionarUsuarios.php");
require_once("gestionarAdsPuesto.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else {
	Header("Location: recontrata.php");
}
	?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Recontratación realizada</title>
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
	    <?php if (alta_AdsPuesto($conexion, $formulario)){ ?>
	    	<h2>Recontratación realizada con éxito</h2>
		<p>Se ha recontratado con éxito al empleado <?php echo $formulario["pid"] ?> como <?php echo $formulario["Puesto"] ?></p>
		<?php } else {
			?>
			<h2>Ha ocurrido un error durante la inserción.</h2>
		<?php } ?>
		</div>
		<?php
		include_once ('pie.php');
		cerrarConexionBD($conexion);
		?>
	</body>
</html>