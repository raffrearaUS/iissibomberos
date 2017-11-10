<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarTurnos.php");

	if (!isset($_SESSION["loginpid"])) {
		header("Location: login.php");
	}
		

?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Mis turnos</title>
		<link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/EstilosAbout.css" />
        

	</head>
	<body>

		<?php
		include_once ('cabecera.php');
		include_once('menu.php');
		$con = crearConexionBD();
		$turnos = consultarTurnoPid($con, $_SESSION["loginpid"]);
		cerrarConexionBD($con);
		?>
		<div id="divTurnos">
		<h2 id="turnos">Mis turnos</h2>
			<ul id="lista_turnos">
		<?php
		foreach ($turnos as $t){
		?>
		
		<li>
		<?php echo $t["FECHA"];?>
		</li>
		

		
		

		<?php }?> 
		</ul>
		</div>
		<?php
		
		
		include_once ('pie.php');
		?>
	</body>
</html>