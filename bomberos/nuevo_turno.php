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
if (!isset($_SESSION["formulario"])) {
	$formulario["Fecha"] = "";
	$formulario["Personal"] = "";
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
	<title>Asignar turno</title>
	<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
    <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css" />
    <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
    <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
    <script type="text/javascript" src="js/validacionFormularioTurno.js"></script>
    
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
		
		
		<form action="tratamiento_turno.php" method="post" onsubmit="return validarFormularioTurno()">
            <h2>Asignar turno</h2>
				<label for="Fecha">Fecha: </label>
				<input type="date" name="Fecha" id="Fecha" required onchange="return validarFecha()"/>
				
				<label for="Personal">Empleado:</label>
				<select name="Personal" id="Personal" required>
					<option value="" disabled selected>Empleado...</option>
					<?php 
                    	$conexion = crearConexionBD();
                    	$personals = lista_personal_activo($conexion);
						cerrarConexionBD($conexion);
						foreach ($personals as $persona) {?>
                    	<option value="<?php echo $persona["PID"]?>"><?php echo $persona["PID"] ?> (<?php echo $persona["APELLIDOS"] ?>, <?php echo $persona["NOMBRE"] ?>)</option>
                    	<?php
                    	}
						?>
				</select>
				
				<input type="submit" value="Asignar"/>
		</form>

		<?php
		include_once ('pie.php');
		?>
	</body>
</html>