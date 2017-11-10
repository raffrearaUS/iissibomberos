<?php	
	session_start();
	
	if (isset($_REQUEST["PID"])) {
		$personal["PID"] = $_REQUEST["PID"];
		$personal["NOMBRE"] = $_REQUEST["NOMBRE"];
		$personal["APELLIDOS"] = $_REQUEST["APELLIDOS"];
		$personal["RANGO"] = $_REQUEST["RANGO"];
		$personal["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		
		$_SESSION["personal"] = $personal;
			
		if (isset($_REQUEST["editar"])) Header("Location: personal.php"); 
		else if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_personal.php");
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_personal.php"); 
	}
	else 
		Header("Location: personal.php");
	
?>