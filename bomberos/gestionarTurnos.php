<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de usuarios de la capa de acceso a datos
 * #==========================================================#
 */

function alta_turno($conexion, $formulario) {

	$resultado = true;
	$fecha = date("d/m/Y", strtotime($formulario["Fecha"]));
	try {
		
		$turnos = consultarTurno($conexion, $formulario);
		
		if(!$turnos){
			
		
			$conexion -> beginTransaction();	
			
			$strt = $conexion -> prepare('CALL CREAR_TURNO(:fecha)');
			$strt -> execute(array(':fecha' => $fecha));
			$stmt = $conexion ->prepare('INSERT INTO PPARTICIPAT VALUES(sec_perparticipatur.nextval, :pid, :fecha)');
			$stmt -> execute(array(':pid'=>$formulario["Personal"], ':fecha'=>$fecha));
			
			$conexion -> commit();
		} else {
			$conexion -> beginTransaction();
			$stmt = $conexion ->prepare('INSERT INTO PPARTICIPAT VALUES(sec_perparticipatur.nextval, :pid, :fecha)');
			$stmt -> execute(array(':pid'=>$formulario["Personal"], ':fecha'=>$fecha));
			$conexion -> commit();
		}
		$turnos = null;
			
		return $resultado;
	} catch (PDOException $e) {
		$conexion -> rollBack();
		$resultado = false;
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

}

function consultarTurno($conexion, $formulario){
	try {
		$fecha = date("d/m/Y", strtotime($formulario["Fecha"]));
		$strt = $conexion -> prepare('SELECT *  FROM TURNOS  WHERE FECHA = :fecha');
		$strt -> execute(array(':fecha' => $fecha));
		
	
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetchColumn();
}

function consultarTurnoPid($conexion, $pid) {

	try {
		$strt = $conexion -> prepare('SELECT * FROM TURNOS NATURAL JOIN PPARTICIPAT WHERE PID = :pid AND FECHA > SYSDATE');
		$strt -> execute(array(':pid' => $pid));
			
		

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt;

}

function consultarTurnos($conexion, $formulario) {

	try {
		$strt = $conexion -> prepare('SELECT *  FROM TURNOS NATURAL JOIN PPARTICIPAT WHERE PID = :pid');
		$strt -> execute(array(':pid' => $formulario["Personal"]));
		
		$res = true;
		
		
		$fin= DateTime::createFromFormat("Y-m-d", $formulario["Fecha"]);
		
		foreach ($strt as $turno) {
			$inicio= DateTime::createFromFormat("d/m/y", $turno["FECHA"]);
			$resultado = date_diff($inicio, $fin)->format("%a");
			
			if($resultado <= 1 && $resultado >= -1){
				$res = false;
			}
		}
	
		
		

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $res;

}

