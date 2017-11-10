<?php
require_once("gestionBD.php");
require_once("gestionarAdsPuesto.php");
if (isset($_GET["personal"])) {
	$conexion = crearConexionBD();
	$cuenta = cuenta_tiempo($conexion, $_GET);
	$rangos = lista_rangos($conexion);
	foreach ($rangos as $rango) {
		if ($rango["RANGO"] != "SARGENTO" && $rango["RANGO"] != "CABO") {
			echo '<option value="'.$rango["RANGO"].'">'.$rango["RANGO"].'</option>';
		} else if ($cuenta >= 365*2) {
			echo '<option value="'.$rango["RANGO"].'">'.$rango["RANGO"].'</option>';
		}
	}
	cerrarConexionBD($conexion);
	unset($_GET["personal"]);
}

function alta_usuario($conexion, $usuario) {

	$resultado = true;

	try {
		$usuarios = consultarPid($conexion, $usuario["pid"], $usuario["nombre"], $usuario["apellidos"]);

		if (!$usuarios) {
			
			$conexion -> beginTransaction();
			$strt = $conexion -> prepare('INSERT INTO PERSONAL VALUES(:pid, :apellidos, :nombre, :pass)');
			$strt -> execute(array(':pid' => $usuario["pid"], ':nombre' => $usuario["nombre"], ':apellidos' => $usuario["apellidos"], ':pass' => md5($usuario["pass"])));
			alta_AdsPuesto($conexion, $usuario);
			$conexion -> commit();
			
			
		} else {
			$resultado = false;

		}
		$usuarios = null;
		$fila = null;
		return $resultado;
	} catch (PDOException $e) {
		$conexion -> rollBack();
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

}

function consultarUsuario($conexion, $pid, $pass) {

	try {
		$strt = $conexion -> prepare('SELECT COUNT(*) AS TOTAL FROM PERSONAL WHERE PID = :pid AND PASS = :pass');
		$strt -> execute(array(':pid' => $pid, ':pass' => md5($pass)));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetchColumn();

}

function consultarPid($conexion, $pid, $nombre, $apellidos) {

	try {
		$strt = $conexion -> prepare('SELECT * FROM PERSONAL WHERE PID = :pid OR (NOMBRE = :nombre AND APELLIDOS = :apellidos)');
		$strt -> execute(array(':pid' => $pid, ':nombre' => $nombre, ':apellidos' => $apellidos));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetch();

}

function consultarRango($conexion, $pid) {

	try {
		$strt = $conexion -> prepare('SELECT RANGO FROM PERSONAL NATURAL JOIN ADSCRIPCIONPUESTO WHERE PID = :pid AND FECHAFIN IS NULL');
		$strt -> execute(array(':pid' => $pid));

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}

	return $strt -> fetch();

}

function lista_personal_activo($conexion) {

	try {
		$stmt = $conexion -> prepare('SELECT PID, NOMBRE, APELLIDOS, RANGO, FECHAINICIO FROM PERSONAL NATURAL JOIN ADSCRIPCIONPUESTO WHERE FECHAFIN IS NULL ORDER BY PID');
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	return $stmt;
}

function lista_rangos($conexion) {

	try {
		$stmt = $conexion -> prepare('SELECT * FROM PUESTOS');
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	return $stmt;
}

function despedir($conexion,$pid) {
	$fecha = date("d/m/Y");
	try {
		$stmt=$conexion->prepare('UPDATE ADSCRIPCIONPUESTO SET FECHAFIN = :fecha WHERE PID = :pid AND FECHAFIN IS NULL');
		$stmt->bindParam(':fecha',$fecha);
		$stmt->bindParam(':pid',$pid);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar($conexion,$pid,$nombre,$apellidos) {
	try {
		$stmt=$conexion->prepare('UPDATE PERSONAL SET NOMBRE = :nombre, APELLIDOS = :apellidos WHERE PID = :pid');
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':pid',$pid);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function cuenta_tiempo($conexion, $pers) {
 	$resultado = 0;
	$fecha = date("d/m/Y");
	try {
		$conexion -> beginTransaction();
		$desp = $conexion->prepare("UPDATE ADSCRIPCIONPUESTO SET FECHAFIN = :fecha WHERE PID = :pid AND FECHAFIN IS NULL");
		$desp->bindParam(":fecha", $fecha);
		$desp->bindParam(":pid", $pers["personal"]);
		$desp->execute();
		$asc = $conexion->prepare("SELECT * FROM ADSCRIPCIONPUESTO WHERE PID = :pid");
		$asc->bindParam(":pid", $pers["personal"]);
		$asc->execute();
		foreach ($asc as $fila) {
			$fin = DateTime::createFromFormat("d/m/y", $fila["FECHAFIN"]);
			$inicio = DateTime::createFromFormat("d/m/y", $fila["FECHAINICIO"]);
			$resultado += date_diff($inicio, $fin)->format("%a");
		}
		$conexion -> rollBack();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $resultado;
 }

function consultarUsuariosDespedidos($conexion) {
	
	try {
		$strt = $conexion -> query('SELECT DISTINCT PID, NOMBRE, APELLIDOS FROM PERSONAL NATURAL JOIN ADSCRIPCIONPUESTO WHERE FECHAFIN IS NOT NULL AND PID NOT IN (SELECT PID FROM PERSONAL NATURAL JOIN ADSCRIPCIONPUESTO WHERE FECHAFIN IS NULL) ORDER BY PID');

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	
	
	return $strt;

}

?>
