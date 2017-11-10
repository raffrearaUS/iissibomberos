<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
		header("Location: login.php");
	}
if (!isset($_SESSION["formulario"])) {
	$formulario["nombre"] = "";
	$formulario["direccion"] = "";
} else {
	$formulario = $_SESSION["formulario"];
	unset($_SESSION["formulario"]);
}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
?>




<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Añadir taller</title>
		<script type="text/javascript" src="js/validacionFormularioTaller.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
        <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		?>
		<br />
		<?php
		if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
		?>
		
		<div>
			<form action="tratamiento_taller.php" method="post" onsubmit="return validarFormularioTaller()">
				<h2>Añadir taller</h2>
					<label for="nombre">Nombre: </label>
					<input type="text" name="nombre" id="nombre" placeholder="Introduzca un nombre" maxlength="30" value="<?php echo $formulario["nombre"]?>"/>
					<br />
					<label for="direccion">Dirección: </label>
					<input type="text" name="direccion" id="direccion" placeholder="Introduzca dirección" maxlength="50" value="<?php echo $formulario["direccion"]?>" required oninput="return validarDireccion()"/>
					<br />
					<input type="submit" name="Guardar vehículo" value="Añadir"/>
				
			</form>
		</div>
		<?php
		include_once ('pie.php');
		?>
	</body>
</html>