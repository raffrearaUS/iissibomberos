<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}
if (!isset($_SESSION["formulario"])) {
	$formulario["nombre"] = "";
	$formulario["pid"] = "";
	$formulario["apellidos"] = "";
	$formulario["pass"] = "";
	$formulario["confirmpass"] = "";
	$formulario["Puesto"] = "";
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
	<title>Registrar a un empleado</title>
	<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
    <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css" />
    <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
    <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/registro.js"></script>
    <script type="text/javascript" src="js/validacionFormularioRegistro.js"></script>
    
</head>
<body>
   
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
		
		

		<form action="tratamiento_registro.php" method="post" onsubmit="return validarFormularioRegistro()">
            
            <h2>Registro</h2>
			
				<label for="pid">PID: </label>
				<input type="number" name="pid" id="pid" value="<?php echo $formulario['pid'];?>" placeholder="12" maxlength="2" required oninput="return validarPid()"/>
				
				
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" id="nombre" value="<?php echo $formulario['nombre'];?>" placeholder="Valentín" required oninput="return validarNombre()"/>
				
		
				<label for="apellidos">Apellidos: </label>
				<input type="text" name="apellidos" id="apellidos" value="<?php echo $formulario['apellidos'];?>" placeholder="Troyano Sevillano" required oninput="return validarApellidos()"/>
				
	
				<label for="pass">Contraseña: </label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres" minlength = "8" required oninput="return validarPass()"/>
				
				
				<label for="confirmpass">Confirmar contraseña: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Repita contraseña" minlength = "8" required oninput="return validarConfirmacionPass()"/>
				
				<label for="Puesto">Rango:</label>
				<select name="Puesto" id="Puesto">
					<option value="BOMBERO">BOMBERO</option>
					<option value="CONDUCTOR">CONDUCTOR</option>
					<option value="CENTRALITA">CENTRALITA</option>
				</select>
				<input type="submit" value="Registrar"/>
		</form>

		<?php
		include_once ('pie.php');
		?>
	</body>
</html>