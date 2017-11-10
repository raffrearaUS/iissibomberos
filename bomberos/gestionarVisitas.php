<?php

 function nueva_visita($conexion,$visita) {
	$resultado = true;
	$fecha = date("d/m/Y", strtotime($visita["Fecha"]));
	try {
		
		$visitas = consulta_visitas($conexion, $fecha);
		$nvi= $visitas ->fetch();
		if (!$nvi) {
			$conexion -> beginTransaction();
			$stmt = $conexion -> prepare("CALL CREAR_VISITA(:denominacion, :fecha, :nvis)");
			$stmt -> bindParam(":denominacion", $visita["Descripcion"]);
			$stmt -> bindParam(":nvis", $visita["Numero_de_visitantes"]);
			$stmt -> bindParam(":fecha", $fecha);
			$stmt -> execute();
			$vis = $conexion -> prepare("SELECT ID_VISITA FROM VISITAS WHERE DENOMINACION = :denominacion AND FECHAVISITA = :fecha AND NVISITANTES = :nvis");
			$vis -> bindParam(":denominacion",$visita["Descripcion"]);
			$vis -> bindParam(":nvis", $visita["Numero_de_visitantes"]);
			$vis -> bindParam(":fecha", $fecha);
			$vis -> execute();
			$idvis = $vis->fetch();
		
			foreach ($visita["Personal"] as $per) {
				$pers = $conexion->prepare("INSERT INTO PATIENDEV VALUES(SEC_PERATIENDEV.NEXTVAL, :per, :vis)");
				$pers->bindParam(":vis", $idvis["ID_VISITA"]);
				$pers->bindParam(":per", $per);
				$pers->execute();
			}
		
			$conexion -> commit();
		
		} else {
			$conexion->rollBack();
			$resultado = false;
		}
		
		
	} catch (PDOException $e) {
		$conexion->rollBack();
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
	}
	
	function consulta_visitas($conexion, $fecha) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM VISITAS WHERE FECHAVISITA= :fecha");
		$stmt -> execute(array(':fecha' => $fecha));
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}
	
	
	function consultaVisitasPosteriores($conexion) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM VISITAS WHERE FECHAVISITA >= SYSDATE");
		$stmt -> execute();
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}
	
	function consultaPantiendeVPosteriores($conexion, $fecha) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM VISITAS NATURAL JOIN PATIENDEV WHERE FECHAVISITA = :fecha");
		$stmt -> execute(array(':fecha' => $fecha));
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}
	
	function numVisitasPosteriores($conexion) {
	try {
		$stmt = $conexion -> prepare("SELECT COUNT (*) FROM VISITAS WHERE FECHAVISITA >= SYSDATE");
		$stmt -> execute();
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt ->fetchColumn();
}
 ?>