<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarUsuarios.php");

if (isset($_POST["pid"])) {
	$pid = $_POST["pid"];
	$pass = $_POST["pass"];
	$con = crearConexionBD();
	$usuarios = consultarUsuario($con, $pid, $pass);
	$rango = consultarRango($con, $pid);
	cerrarConexionBD($con);
	if ($usuarios == 1) {
		$_SESSION["loginpid"] = $pid;
		$_SESSION["loginrango"] = $rango["RANGO"];
		header("Location: index.php");
	} else {
		$login = "Error";
	}
}
?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Iniciar sesión</title>
		<script type="text/javascript" src="js/validacionFormularioLogin.js"></script>
		<link rel="stylesheet"  href="css/navegacion.css"/>
		<link rel="stylesheet"  href="css/EstilosComun.css"/>
		<link rel="stylesheet"  href="css/Estilos_formulario_login.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		?>

		<?php
	if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}
		?>
		<form action="login.php" method="post" onsubmit="return validarFormularioLogin()">
			
				<h1>Iniciar sesión</h1>
				<label for="pid">PID: </label>
				<input type="number" name="pid" id="pid" placeholder="12" minlength = "1" maxlength="2" required oninput="return validarPid()"/>
				
				<label for="pass">Contraseña: </label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres" minlength = "8" required oninput="return validarContrasena()"/>
				
				<input type="submit" value="Iniciar sesión"/>
			

		</form>

		<?php
		include_once ('pie.php');
		?>
	</body>
</html>