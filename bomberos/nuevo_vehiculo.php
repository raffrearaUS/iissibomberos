<?php
// Inicializamos o recuperamos la sesión
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
if (!isset($_SESSION["formulario"])) {
	// Asignamos valor por defecto a los elementos
	$formulario["matricula"] = "";
	$formulario["nombre"] = "";
	$formulario["nPlazas"] = "";
	$formulario["fechaMatriculacion"] = "";
	$formulario["tipoVehiculo"] = "";
} else{
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
		<title>Añadir vehículo</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
		<link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
		<link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/validacionFormularioVehiculo.js"></script>
	</head>
	<body>

		<?php
		include_once('cabecera.php');
		include_once('menu.php');
            if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
        ?>
        
		
		
		<div>
			<form action="tratamiento_vehiculo.php" method="post" onsubmit="return validarFormularioVehiculo()">
				
				<h2>Añadir vehículo</h2>
					<label for="matricula">Matrícula: </label>
					<input type="text" name="matricula" id="matricula" placeholder="Introduzca matrícula"
					maxlength="8" minlength="7" value="<?php echo $formulario['matricula'];?>" required oninput="return validarMatricula()"/>
					
				
					
					<label for="nombre">Nombre: </label>
					<input type="text" name="nombre" id="nombre" placeholder="Introduzca un nombre"
					maxlength="10" value="<?php echo $formulario['nombre'];?>" />
					
				
					
					<label for="nPlazas">Nº de plazas: </label>
					<input type="number" name="nPlazas" id="nPlazas" placeholder="" max="9" min="1" value="<?php echo $formulario['nPlazas'];?>" required oninput="return validarNumeroPlazas()"/>
					
				
					
					<label for="fechaMatriculacion">Fecha de matriculación: </label>
					<input type="date" name="fechaMatriculacion" id="fechaMatriculacion" placeholder="Introduzca fecha"
					value="" required onchange="return validarFechaMatriculacion()"/>
					
					
					<label for="tipoVehiculo">Tipo: </label>
					<select name="tipoVehiculo" id="tipoVehiculo" required onchange="return validarTipoVehiculo()">
						<option value="AEA">AEA</option>
						<option value="FSV">FSV</option>
						<option value="BUL">BUL</option>
						<option value="UPC">UPC</option>
						<option value="BUP">BUP</option>
					</select>
					
					
					<input type="submit" name="Guardar vehículo" value="Añadir"/>
			</form>
		</div>
		
		<?php
		include_once('pie.php');
		?>
	</body>
</html>