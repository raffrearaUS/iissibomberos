<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once ("gestionBD.php");
require_once ("gestionarVisitas.php");
?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Próximas visitas</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/tablas.css" />

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		$conexion = crearConexionBD();
		$visitas = consultaVisitasPosteriores($conexion);
		?>
		
		<?php if (numVisitasPosteriores($conexion)){ ?> 
			<table>
			<tr>
				<th>
					Fecha
				</th>
				<th>
					Denominación
				</th>
				<th>
					Nº de visitantes
				</th>
				<th>
					Personas que atienden la visita
				</th>
			</tr>
			<?php foreach ($visitas as $v) {?>
			<tr>
				<td><?php echo $v["FECHAVISITA"] ?></td>
				<td><?php echo $v["DENOMINACION"] ?></td>
				<td><?php echo $v["NVISITANTES"] ?></td>
				<td><?php foreach (consultaPantiendeVPosteriores($conexion, $v["FECHAVISITA"]) as $pid) { 
					echo $pid["PID"]; 
					?>
					
				<?php } ?></td>
			</tr>
			<?php } ?> 
			
				
			
		</table>

		<?php } else { ?>
			
			No existen visitas próximamente.
			
		<?php }?>
		
			

		<?php
		cerrarConexionBD($conexion);
		include_once ('pie.php');
		?>
	</body>
</html>
