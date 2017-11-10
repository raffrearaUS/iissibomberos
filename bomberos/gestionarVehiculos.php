<?php

 function nuevo_vehiculo($conexion,$vehiculo) {
	$resultado = true;
	$fecha = date("d/m/Y", strtotime($vehiculo["fechaMatriculacion"]));
	try {
		$existe = $conexion->prepare("SELECT * FROM VEHICULOS WHERE MATRICULA=:matricula");
		$existe->bindParam(":matricula", $vehiculo["matricula"]);
		$existe->execute();
		$fila = $existe->fetch();
		if (!$fila) {
			$stmt = $conexion->prepare("CALL CREAR_VEHICULO(:matricula, :nombre, :nplazas, :fecha, :tipo)");
			$stmt->bindParam(":matricula", $vehiculo["matricula"]);
			$stmt->bindParam(":nombre", $vehiculo["nombre"]);
			$stmt->bindParam(":nplazas", $vehiculo["nPlazas"]);
			$stmt->bindParam(":fecha", $fecha);
			$stmt->bindParam(":tipo", $vehiculo["tipoVehiculo"]);
			$stmt->execute();
		} else {
			$resultado = false;
		}
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
}
 
 function consulta_vehiculos($conexion) {
	try {
		$stmt = $conexion -> prepare('SELECT * FROM VEHICULOS');
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	return $stmt;
}

function cuenta_plazas($conexion, $vehiculos) {
	$plazas = 0;
	try {
		$stmt = $conexion->prepare('SELECT NPLAZAS, MATRICULA FROM VEHICULOS');
		$stmt -> execute();
		foreach ($stmt as $veh) {
			if (in_array($veh["MATRICULA"], $vehiculos)) {
				$plazas += $veh["NPLAZAS"];
			}
		}
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	return $plazas;
}
 ?>