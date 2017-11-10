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
require_once ("gestionarAdsPuesto.php");
?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Recontratar a un empleado</title>
		<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css" />
		<link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
		<link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>

	</head>
	<body>
		<script>
			$(document).ready(function() {
				$("#pid").on("input", function() {
					$.get("gestionarUsuarios.php", {
						personal : $('#pid').val()
					}, function(data) {
						$("#Puesto").empty();
						$("#Puesto").append(data);
					});
				});
			});
		</script>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
		?>

		<form action="tratamiento_recontratar.php"  method="post">

			<h2>Recontratación</h2>
			<label>Elija un empleado:</label>
			<select name="pid" id="pid" required>
				<option value="" disabled selected>Empleado...</option>
				<?php
$conexion = crearConexionBD();
$usuarios = consultarUsuariosDespedidos($conexion);

foreach ($usuarios as $p) {
				?>
				<option value="<?php echo $p["PID"] ?>"><?php echo $p["PID"]
					?>
					(<?php echo $p["APELLIDOS"] ?>,
					<?php echo $p["NOMBRE"] ?>)
				</option>
				<?php
				} ?>
			</select>
			<label>Elija un rango:</label>
			<select name="Puesto" id="Puesto" required>
			</select>
			<input type="submit" value="Recontratar"/>
		</form>

		<?php
		cerrarConexionBD($conexion);
		include_once ('pie.php');
		?>
	</body>
</html>