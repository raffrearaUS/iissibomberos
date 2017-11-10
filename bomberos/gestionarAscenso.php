<?php

 function ascenso($conexion, $ascenso) {
	$resultado = true;
	$fecha = date("d/m/Y");
	try {
		$desp = $conexion->prepare("UPDATE ADSCRIPCIONPUESTO SET FECHAFIN = :fecha WHERE PID = :pid AND FECHAFIN IS NULL");
		$desp->bindParam(":fecha", $fecha);
		$desp->bindParam(":pid", $ascenso["personal"]);
		$desp->execute();
		$asc = $conexion->prepare("CALL CREAR_ADSCPUESTO(:pid, :rango, :fechainicio, NULL)");
		$asc->bindParam(":fechainicio", $fecha);
		$asc->bindParam(":pid", $ascenso["personal"]);
		$asc->bindParam(":rango", $ascenso["rango"]);
		$asc->execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
}
 ?>