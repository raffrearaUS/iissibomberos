<?php
// Inicializamos o recuperamos la sesión
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once ("gestionBD.php");
require_once ("gestionarVehiculos.php");
require_once ("gestionarUsuarios.php");
if (!isset($_SESSION["formulario"])) {
	// Asignamos valor por defecto a los elementos
	$formulario["fechaIncidencia"] = "";
	$formulario["direccionIncidencia"] = "";
	$formulario["denominacionIncidencia"] = "";
} else {
	$formulario = $_SESSION["formulario"];
	unset($_SESSION["formulario"]);
}

if (isset($_SESSION["errores"])){
	$errores = $_SESSION["errores"];
unset($_SESSION["errores"]);
}
?>



<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Añadir incidencia</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
		<link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
		<link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
		<script type="text/javascript" src="js/validacionFormularioIncidencia.js"></script>
	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once ('menu.php');
		if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
        ?>
        
		
		
			<form action="tratamiento_incidencia.php" method="post" onsubmit="return validarFormularioIncidencia()">
				<h2>Añadir incidencia</h2>
				
					<label for="fechaIncidencia">Fecha: </label>
					<input type="date" name="fechaIncidencia" id="fechaIncidencia"
					value="<?php echo $formulario['fehcaIncidencia']; ?>" required onchange="return validarFechaIncidencia()"/>
			
					
					<label for="direccionIncidencia">Dirección: </label>
					<input type="text" name="direccionIncidencia" id="direccionIncidencia" placeholder="Calle Juan Sebastian el Cano, Nº20"
					maxlength="50" value="<?php echo $formulario['direccionIncidencia']; ?>" required oninput="return validarDireccion()"/>
					
					
					<label for="denominacionIncidencia">Descripción: </label>
					<input type="text" name="denominacionIncidencia" id="denominacionIncidencia" placeholder="Inundación del salón"
					maxlength="100" value="<?php echo $formulario['denominacionIncidencia']; ?>" required oninput="return validarDenominacion()"/>
					
					<label for="Personal">Personal que ha acudido:</label>
					<select name="Personal[]" id="Personal" size="1" multiple required>
						<?php $conexion = crearConexionBD();
						$personas = lista_personal_activo($conexion);
						$vehiculos = consulta_vehiculos($conexion);
						cerrarConexionBD($conexion);
						foreach ($personas as $pers) { ?>
							<option value="<?php echo $pers["PID"] ?>"><?php echo $pers["PID"] ?> (<?php echo $pers["APELLIDOS"] ?>, <?php echo $pers["NOMBRE"] ?>)</option>
						<?php } ?>
					</select>
					
					<label for="Vehiculos">Vehículos que han participado:</label>
					<select name="Vehiculos[]" id="Vehiculos" size="1" multiple required>
						<?php
						foreach ($vehiculos as $veh) { ?>
							<option value="<?php echo $veh["MATRICULA"] ?>"><?php echo $veh["MATRICULA"] ?></option>
						<?php } ?>
					</select>
					
					<input type="submit" name="Añadir"/>
			</form>
		
		<?php
		include_once ('pie.php');
		?>
	</body>
</html>