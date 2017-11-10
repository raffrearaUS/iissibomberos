<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de usuarios de la capa de acceso a datos
 * #==========================================================#
 */

function alta_mantenimiento($conexion, $mantenimiento) {

	$resultado = true;
	$fecha = date("d/m/Y", strtotime($mantenimiento["Fecha"]));
	try {
			
			$strt = $conexion -> prepare('CALL CREAR_MANTENIMIENTO(:denominacion, :fecha, :matricula, :id_taller)');
			$strt -> execute(array(':denominacion' => $mantenimiento["Denominacion"], ':fecha' => $fecha, ':matricula' => $mantenimiento["Vehiculo"], ':id_taller'
			 => $mantenimiento["Taller"]));
		
		
		return $resultado;
	} catch (PDOException $e) {
		$resultado = false;
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

}

function consultarMantenimiento($conexion, $matricula) {

	try {
		$strt = $conexion -> prepare('SELECT FECHA, NOMBRE, DENOMINACION FROM MANTENIMIENTOS NATURAL JOIN TALLERES WHERE MATRICULA = :mat');
		$strt -> execute(array(':mat' => $matricula));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt;

}

function numMantenimientos($conexion, $matricula) {

	try {
		$strt = $conexion -> prepare('SELECT COUNT (*) FROM MANTENIMIENTOS NATURAL JOIN TALLERES WHERE MATRICULA = :mat');
		$strt -> execute(array(':mat' => $matricula));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetchColumn();

}



