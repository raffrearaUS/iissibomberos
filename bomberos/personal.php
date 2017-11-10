<?php
	session_start();
	if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
	if ($_SESSION["loginrango"]!="SARGENTO") {
	header("Location: gestion.php");
}

	require_once("gestionBD.php");
	require_once("gestionarUsuarios.php");
	require_once("paginacion_consulta.php");
	
	if (isset($_SESSION["personal"])){
		$personal = $_SESSION["personal"];
		unset($_SESSION["personal"]);
	}
	
	if (isset($_SESSION["pagina"])){
		$pagina = $_SESSION["pagina"];
		unset($_SESSION["pagina"]);
	}
	
	$pagina = isset($_GET["pag_num"]);
	isset($_GET["pag_tam"]);
	$pag_num = isset($_GET["pag_num"])? (int)$_GET["pag_num"] : (isset($pagina)? (int)$pagina["pag_num"] : 1);
	$pag_tam = isset($_GET["pag_tam"])? (int)$_GET["pag_tam"] : (isset($pagina)? (int)$pagina["pag_tam"] : 9);
	if ($pag_num < 1) $pag_num = 1;
	if ($pag_tam < 1) $pag_tam = 9;

	$conexion = crearConexionBD();
	$query = "SELECT PID, NOMBRE, APELLIDOS, RANGO, FECHAINICIO FROM PERSONAL NATURAL JOIN ADSCRIPCIONPUESTO WHERE FECHAFIN IS NULL ORDER BY PID";
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = $total_registros/$pag_tam;
	if ($total_registros%$pag_tam > 0) {
		$total_paginas++;
	}
	if ($pag_num > $total_paginas) {
		$pag_num = 1;
	}
	$pagina = array();
	$pagina["pag_num"] = $pag_num;
	$pagina["pag_tam"] = $pag_tam;
	$_SESSION["pagina"] = $pagina;
	$filas = consulta_paginada($conexion, $query, $pag_num, $pag_tam);
	cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de personal</title>
  <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/tablas.css" />
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once('menu.php');
?>

<main>
	
	<nav id="nav">
		<div id="enlaces">
			<?php for ($pag = 1; $pag <= $total_paginas; $pag++) {
				if ($pag == $pag_num) { ?>
					<span class="current"><?php echo $pag_num ?></span>
				<?php } else { ?>
					<a href="personal.php?pag_num=<?php echo $pag ?>&pag_tam=<?php echo $pag_tam?>"><?php echo $pag ?></a>
			<?php } 
			} ?>
		</div>
		
		<form  method="get" action="personal.php">
			<input id="pag_num" name="pag_num" type="hidden" value="<?php echo $pag_num?>"/>
			<strong>Mostrando</strong>
			<input id="pag_tam" name="pag_tam" type="number" min="1" max="<?php echo $total_registros?>" value="<?php echo $pag_tam?>" autofocus="autofocus" />
			<strong>entradas de</strong> <?php echo $total_registros?>
			
			<input type="submit" value="Cambiar" />
		</form>
	</nav>
	
	<table>
		<tr>
			<th>PID</th><th>Nombre</th><th>Apellidos</th><th>Rango</th><th>Fecha inicio</th><th>Acciones</th>
		</tr>
	<?php
		foreach($filas as $fila) {
	?>
	<tr>
		<form method="post" action="controlador_personal.php">
			<input type="hidden" name="PID" id="PID" value="<?php echo $fila["PID"]?>" />
			<input type="hidden" name="RANGO" id="RANGO" value="<?php echo $fila["RANGO"]?>" />
			<input type="hidden" name="FECHAINICIO" id="FECHAINICIO" value="<?php echo $fila["FECHAINICIO"]?>" />
			<td><?php echo $fila["PID"]?></td>
		<?php
			if (isset($personal) && $personal["PID"] == $fila["PID"]) { ?>
				<td><input type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $fila["NOMBRE"]?>" /></td>
				<td><input type="text" name="APELLIDOS" id="APELLIDOS" value="<?php echo $fila["APELLIDOS"]?>" /></td>
				<?php }	else { ?>
				<input type="hidden" name="NOMBRE" id="NOMBRE" value="<?php echo $fila["NOMBRE"]?>" />
				<input type="hidden" name="APELLIDOS" id="APELLIDOS" value="<?php echo $fila["APELLIDOS"]?>" />
				<td><?php echo $fila["NOMBRE"]?></td>
				<td><?php echo $fila["APELLIDOS"]?></td>
		<?php } ?>
		<td><?php echo $fila["RANGO"]?></td>
		<td><?php echo $fila["FECHAINICIO"]?></td>
		<td>
		<?php if (isset($personal) && $personal["PID"] == $fila["PID"]) { ?>
				<button id="guardar" name="guardar" type="submit">
					<img src="images/bag_menuito.bmp" alt="Guardar cambios" />
				</button>
		<?php } else {?>
				<button id="editar" name="editar" type="submit">
					<img src="images/pencil_menuito.bmp" alt="Editar" />
				</button>
		<?php } ?>
			<button id="borrar" name="borrar" type="submit" onclick="return confirm('¿Seguro que quiere despedir a este empleado?')">
				<img src="images/remove_menuito.bmp" alt="Borrar">
			</button>
		</td>
		</form>
	</tr>
	<?php } ?>
	</table>
	<p>¿Quiere ascender a un empleado? Pulse <a href="ascenso.php">aquí</a>.</p>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>