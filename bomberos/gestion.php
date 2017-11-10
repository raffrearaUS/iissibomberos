<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión del parque</title>
   <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/gestion.css" />
        
</head>
<body>
	<?php include_once("cabecera.php");
	include_once("menu.php") ?>
	<div class="cajaGestion">
		
		<ul class="lista">
		<?php if($_SESSION["loginrango"] == "SARGENTO") { ?>
		<li><a href="registro.php">Registrar a un empleado</a></li>
		<li><a href="personal.php">Gestión de personal</a></li>
		<li><a href="ascenso.php">Ascender</a></li>
		<li><a href="recontrata.php">Recontratar</a></li>
		<li><a href="nuevo_turno.php">Asignar turno</a></li>
		<?php } ?>
		<li><a href="turnos.php">Mis turnos</a></li>
		<li><a href="nuevo_vehiculo.php">Añadir vehículo</a></li>
		<li><a href="vehiculos.php">Lista de vehículos</a></li>
		<li><a href="nuevo_taller.php">Añadir taller</a></li>
		<li><a href="nuevo_mantenimiento.php">Añadir mantenimiento</a></li>
		<li><a href="nueva_itv.php">Añadir ITV</a></li>
		<li><a href="mantenimiento.php">Mantenimientos e ITVs de vehículos</a></li>
		<li><a href="nueva_incidencia.php">Añadir incidencia</a></li>
		<li><a href="incidencias.php">Últimas incidencias</a></li>
		<li><a href="lista_visitas.php">Próximas visitas</a></li>
		</ul>
		
	</div>
	<?php include_once("pie.php") ?>
</body>
</html>