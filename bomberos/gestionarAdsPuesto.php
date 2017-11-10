<?php

 function alta_AdsPuesto($conexion, $formulario) {
	$resultado = true;
	
	try {
	
			$stmt = $conexion->prepare("CALL CREAR_ADSCPUESTO(:pid, :nombre, :fechainicio, NULL)");
			$stmt->bindParam(":pid", $formulario["pid"]);
			$stmt->bindParam(":nombre", $formulario["Puesto"]);
			$stmt->bindParam(":fechainicio", date("d/m/Y"));
			
			$stmt->execute();
		   
		
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$conexion -> rollBack();
		header("Location: excepcion.php");
	}
	return $resultado;
}
 
 function consulta_adscripciones($conexion, $pid) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM ADSCRIPCIONPUESTO WHERE PID = :pid ");
		$stmt->bindParam(":pid", $pid);
		$stmt -> execute();
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $stmt;
}
 
 function consulta_tiempoAds($conexion, $pid) {
	try {
		$stmt = $conexion -> prepare("SELECT * FROM ADSCRIPCIONPUESTO WHERE PID = :pid ");
		$stmt->bindParam(":pid", $pid);
		$stmt -> execute();
		$cuenta = 0;
		foreach($stmt as $adsc){
			$cuenta = $cuenta + ($adsc["FECHAFIN"] - $adsc["FECHAINICIO"]); 
		}
	} catch (PDOException $e) {

		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $cuenta;
}
 ?>