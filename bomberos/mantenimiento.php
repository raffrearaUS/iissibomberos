<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}

require_once ("gestionBD.php");
require_once ("gestionarMantenimiento.php");
require_once ("gestionarVehiculos.php");
require_once ("gestionarItv.php");

if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}

$con = crearConexionBD();
$vehiculos = consulta_vehiculos($con);
cerrarConexionBD($con);

?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Mantenimientos e ITVs de vehículos</title>
		<link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css" />
		<link rel="stylesheet" type="text/css" href="CSS/tablas.css" />
		<link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
	</head>
	<body>
		<?php 
		include_once ('cabecera.php');
		include_once('menu.php');
		?>
		
		<form action="mantenimiento.php" method="post">
		<h2>Mantenimientos e ITVs</h2>
		<label>Elija un vehículo:</label>
			<select name="vehiculo">
				<?php
				foreach ($vehiculos as $v) { ?>
					<option name="<?php echo $v["MATRICULA"] ?>"><?php echo $v["MATRICULA"] ?></option>;
					
				<?php } ?>
				
			</select>
			<input type="submit" name="Consultar mantenimientos" value="Consultar"/>
		</form>
		

		<?php
		
		if (isset($_POST["vehiculo"])) {
	$matricula = $_POST["vehiculo"];
	$con = crearConexionBD();
	$mantenimiento = consultarMantenimiento($con, $matricula);
	$itv = consultarItvs($con, $matricula);
	cerrarConexionBD($con);
		?>
		<div class="contenedor">
			
			<div id="cajaTablaMant">
				<h2>Mantenimientos</h2>
		<?php if (numMantenimientos($con, $matricula) != 0){ 
			?>
			<table id="mantenimiento">
			<tr>
				<th> Fecha </th>
				<th> Nombre Taller </th>
				<th> Denominación </th>
			</tr>
			<?php
		foreach ($mantenimiento as $m){
			?>

			<tr>
				<td><?php echo $m["FECHA"]
				?></td>
				<td><?php echo $m["NOMBRE"]
				?></td>
				<td><?php echo $m["DENOMINACION"]
				?></td>
			</tr>

			<?php  } ?>
		</table>
		<?php }else{?>
			<p>No existen mantenimientos para el vehículo introducido</p>
		<?php }?>
				
				
			</div>
			
			<div id="cajaTablaItv">
				<h2>ITVs</h2>
		<?php if (numItvs($con, $matricula) != 0){ 
			?>
			<table id="itv">
			<tr>
				<th> Fecha </th>
				<th> Resultado </th>
			</tr>
			<?php
		foreach ($itv as $i){
			?>

			<tr>
				<td><?php echo $i["FECHA"]
				?></td>
				<td><?php echo $i["RESULTADO"]
				?></td>
			</tr>

			<?php  } ?>
		</table>
		<?php }else{?>
			<p>No existen ITVs para el vehículo introducido</p>
		<?php }?>
				
				
				
			</div>
		
			
		</div>
		
		
		<?php
		}
		include_once ('pie.php');
		?>
	</body>
</html>