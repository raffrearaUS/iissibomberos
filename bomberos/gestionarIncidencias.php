<?php

 function nueva_incidencia($conexion,$incidencia) {
	$resultado = true;
	$fecha = date("d/m/Y", strtotime($incidencia["fechaIncidencia"]));
	try {
		$conexion->beginTransaction();
		$stmt = $conexion->prepare("CALL CREAR_INCIDENCIA(:denominacion, :direccion, :fecha)");
		$stmt->bindParam(":denominacion", $incidencia["denominacionIncidencia"]);
		$stmt->bindParam(":direccion", $incidencia["direccionIncidencia"]);
		$stmt->bindParam(":fecha", $fecha);
		$stmt->execute();
		$inc = $conexion->prepare("SELECT ID_INCIDENCIA FROM INCIDENCIAS WHERE DENOMINACION = :denominacion AND DIRECCION = :direccion AND FECHAINCIDENCIA = :fecha");
		$inc->bindParam(":denominacion", $incidencia["denominacionIncidencia"]);
		$inc->bindParam(":direccion", $incidencia["direccionIncidencia"]);
		$inc->bindParam(":fecha", $fecha);
		$inc->execute();
		$idinc = $inc->fetch();
		foreach ($incidencia["Vehiculos"] as $veh) {
			$vehic = $conexion->prepare("INSERT INTO VPARTICIPAI VALUES(SEC_VEHPARTICIPAINC.NEXTVAL, :inc, :veh)");
			$vehic->bindParam(":inc", $idinc["ID_INCIDENCIA"]);
			$vehic->bindParam(":veh", $veh);
			$vehic->execute();
		}
		foreach ($incidencia["Personal"] as $per) {
			$pers = $conexion->prepare("INSERT INTO PPARTICIPAI VALUES(SEC_PERPARTICIPAINC.NEXTVAL, :per, :inc)");
			$pers->bindParam(":inc", $idinc["ID_INCIDENCIA"]);
			$pers->bindParam(":per", $per);
			$pers->execute();
		}
		$conexion->commit();
	} catch (PDOException $e) {
		$conexion->rollBack();
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
}
 ?>