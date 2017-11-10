<?php
 function alta_itv($conexion,$itv) {
	$resultado = true;
	$fecha = date("d/m/Y", strtotime($itv["Fecha"]));
	try {
		$stmt = $conexion->prepare("CALL CREAR_ITV(:Fecha, :Resultado, :matricula)");
		$stmt->bindParam(":Fecha", $fecha);
		$stmt->bindParam(":Resultado", $itv["Resultado"]);
		$stmt->bindParam(":matricula", $itv["Vehiculo"]);
		$stmt->execute();
		
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
}
 
 function consultar_itvs($conexion){
 	try{
 		$stmt = $conexion -> prepare("SELECT * FROM ITVS");
		$stmt -> execute();
 	}catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
 	}
	return $stmt;
 }
 
 function consultarItvs($conexion, $matricula) {

	try {
		$strt = $conexion -> prepare('SELECT FECHA, RESULTADO FROM ITVS WHERE MATRICULA = :mat');
		$strt -> execute(array(':mat' => $matricula));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt;

}
 
 function numItvs($conexion, $matricula) {

	try {
		$strt = $conexion -> prepare('SELECT COUNT (*) FROM ITVS WHERE MATRICULA = :mat');
		$strt -> execute(array(':mat' => $matricula));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetchColumn();

}
?>