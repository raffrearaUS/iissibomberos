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

if (isset($_SESSION["errores"])){
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Ascenso de personal</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="js/personal.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
        <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once('menu.php');

		
            if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
        ?>
    
	<form method="post" action="tratamiento_ascenso.php">
		<h2>Ascenso</h2>
		<p>Nota: para ser sargento o cabo, un empleado debe haber trabajado durante al menos dos años.</p>
		<label>Elija un empleado: </label>
		<select name="personal" id="personal">
			<option value="" disabled selected>Empleado...</option>
			<?php $conexion = crearConexionBD();
				$personal = lista_personal_activo($conexion);
				cerrarConexionBD($conexion);
				foreach ($personal as $fila) { ?>
				<option value="<?php echo $fila["PID"] ?>"><?php echo $fila["PID"] ?> (<?php echo $fila["APELLIDOS"] ?>, <?php echo $fila["NOMBRE"] ?>)</option>
			<?php } ?>
		</select><br />
		<label>Elija un rango: </label>
		<select name="rango" id="rango">
		</select><br />
		<input type="submit" value="Ascender" />
	</form>
<?php
	include_once("pie.php");
?>

</body>
</html>