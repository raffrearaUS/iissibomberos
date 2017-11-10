<?php
	session_start();
	if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}

	require_once("gestionBD.php");
	require_once("gestionarIncidencias.php");
	require_once("paginacion_consulta.php");
	
	if (isset($_SESSION["pagina"])){
		$pagina = $_SESSION["pagina"];
		unset($_SESSION["pagina"]);
	}
	
	$pagina = isset($_GET["pag_num"]);
	isset($_GET["pag_tam"]);
	$pag_num = isset($_GET["pag_num"])? (int)$_GET["pag_num"] : (isset($pagina)? (int)$pagina["pag_num"] : 1);
	$pag_tam = isset($_GET["pag_tam"])? (int)$_GET["pag_tam"] : (isset($pagina)? (int)$pagina["pag_tam"] : 10);
	if ($pag_num < 1) $pag_num = 1;
	if ($pag_tam < 1) $pag_tam = 10;

	$conexion = crearConexionBD();
	$query = "SELECT DENOMINACION, DIRECCION, FECHAINCIDENCIA FROM INCIDENCIAS WHERE RESTAFECHAS(SYSDATE, FECHAINCIDENCIA) < 16";
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
  <title>Últimas incidencias</title>
  <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/tablas.css" />
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<nav id= "nav">
		<div id="enlaces">
			<?php for ($pag = 1; $pag <= $total_paginas; $pag++) {
				if ($pag == $pag_num) { ?>
					<span class="current"><?php echo $pag_num ?></span>
				<?php } else { ?>
					<a href="incidencias.php?pag_num=<?php echo $pag ?>&pag_tam=<?php echo $pag_tam?>"><?php echo $pag ?></a>
			<?php } 
			} ?>
		</div>
		
		<form method="get" action="incidencias.php">
			<input id="pag_num" name="pag_num" type="hidden" value="<?php echo $pag_num?>"/>
			<strong>Mostrando</strong>
			<input id="pag_tam" name="pag_tam" type="number" min="1" max="<?php echo $total_registros?>" value="<?php echo $pag_tam?>" autofocus="autofocus" />
			<strong>entradas de</strong> <?php echo $total_registros?>
			<input type="submit" value="Cambiar" />
		</form>
	</nav>
	<table>
		<tr>
			<th>Denominación</th><th>Dirección</th><th>Fecha</th>
		</tr>
	<?php
		foreach($filas as $fila) {
	?>
	<tr>		
		<td><?php echo $fila["DENOMINACION"]?></td>
		<td><?php echo $fila["DIRECCION"]?></td>
		<td><?php echo $fila["FECHAINCIDENCIA"]?></td>
	</tr>
	<?php } ?>
	</table>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>