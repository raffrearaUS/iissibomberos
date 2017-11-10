<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de usuarios de la capa de acceso a datos
 * #==========================================================#
 */

function alta_taller($conexion, $taller) {

	$resultado = true;
	$talleres = consulta_taller($conexion, $taller["direccion"]);
	$fila = $talleres -> fetch();
	try {
		if (!$fila) {
			$strt = $conexion -> prepare('CALL CREAR_TALLER(:nombre, :direccion)');
			$strt -> execute(array(':nombre' => $taller["nombre"], ':direccion' => $taller["direccion"]));
		} else {
			$resultado = false;

		}
		$fila = null;
		$talleres = null;

	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
}

function consulta_taller($conexion, $direccion) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM TALLERES WHERE DIRECCION = :direccion");
		$stmt -> execute(array(':direccion' => $direccion));
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}

function consulta_talleres($conexion) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM TALLERES ");
		$stmt -> execute();
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}

?>
