<?php	
	session_start();	
	
	if (isset($_SESSION["personal"])) {
		$personal = $_SESSION["personal"];
		unset($_SESSION["personal"]);
		
		require_once("gestionBD.php");
		require_once("gestionarUsuarios.php");
		
		$conexion = crearConexionBD();
		$res = modificar($conexion, $personal["PID"], $personal["NOMBRE"], $personal["APELLIDOS"]);
		cerrarConexionBD($conexion);
		if ($res != "") {
			header("Location: excepcion.php");
		} else {
			header("Location: personal.php");
		}
	} 
	else
		Header("Location: personal.php"); 
?>
