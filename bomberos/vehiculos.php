<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarVehiculos.php");

	if (!isset($_SESSION["loginpid"])) {
		header("Location: login.php");
	}
		

?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Lista de vehículos</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/tablas.css" />

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		$con = crearConexionBD();
		$vehiculos = consulta_vehiculos($con);
		cerrarConexionBD($con);
		?>
		
		<table>
			<tr>
				<th>
					Matrícula
				</th>
				<th>
					Plazas
				</th>
				<th>
					Tipo
				</th>
			</tr>
			
		
		<?php
		foreach ($vehiculos as $v){
		?>
		<tr>
			<td><?php echo $v["MATRICULA"]?></td>
			<td><?php echo $v["NPLAZAS"]?></td>
			<td><?php echo $v["TIPOVEHICULO"]?></td>
		</tr>
		<?php }?> 
		</table>
		<?php
		
		include_once ('pie.php');
		?>
	</body>
</html>