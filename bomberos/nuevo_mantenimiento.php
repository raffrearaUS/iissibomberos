
<?php
// Inicializamos o recuperamos la sesión
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once ("gestionBD.php");
require_once ("gestionarVehiculos.php");
require_once ("gestionarTalleres.php");
if (!isset($_SESSION["formulario"])) {
	// Asignamos valor por defecto a los elementos
	$formulario["Denominacion"] = "";
	$formulario["Fecha"] = "";
	$formulario["Vehiculo"] = "";
	$formulario["Taller"] = "";
} else{
	$formulario = $_SESSION["formulario"];
	unset($_SESSION["formulario"]);
}
	

if (isset($_SESSION["errores"])){
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Añadir mantenimiento</title>
        <meta name="description" content="">
        <meta name="author" content="raulr">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Añadiendo la hoja de estilos -->
        <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
        <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
        <script type="text/javascript" src="js/validacionFormularioMantenimiento.js"></script>

    </head>

    <body>
        <div class="cajaCuerpo">
        	<?php
        	include_once('cabecera.php');
			include_once('menu.php');
		if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
		?>
                <form action= "tratamiento_mantenimiento.php"  method="post" onsubmit="return validarFormularioMantenimiento()">
                    
                    <h2>Añadir mantenimiento</h2>
                   
                
                    <label  for="Denominacion">Descripción:</label>
                    <input type="text" id="Denominacion" name="Denominacion" value="<?php echo $formulario['Denominacion'];?>" placeholder="Revision de las pastillas del freno" maxlength="60" required oninput="return validarDenominacion()"/>
                      

                    <label  for="Fecha">Fecha:</label>
                    <input type="date" id="Fecha" name="Fecha" required oninput="return validarFecha()"/>
                    
                    <label for="Vehiculo">Vehículo:</label>
                    <select name="Vehiculo" id="Vehiculo" required>
                    	<?php 
                    	$conexion = crearConexionBD();
                    	$vehiculos = consulta_vehiculos($conexion);
						cerrarConexionBD($conexion);
						foreach ($vehiculos as $vehiculo) {?>
                    	<option value="<?php echo $vehiculo["MATRICULA"]?>"><?php echo $vehiculo["MATRICULA"]?></option>
                    	<?php
                    	}
						?>
                    </select>
                    
                    <label for="Taller">Taller:</label>
                    <select name="Taller" id="Taller" required>
                    	<?php 
                    	$conexion = crearConexionBD();
						$talleres = consulta_talleres($conexion);
						cerrarConexionBD($conexion);
						foreach ($talleres as $taller) {?>
                    	<option value="<?php echo $taller["ID_TALLER"]?>"><?php echo $taller["NOMBRE"]?></option>
                    	<?php
                    	}
						?>
                    </select>

                    <input type="submit" value="Añadir" />
                </form>

            
           <?php
           include_once('pie.php');
           ?>
           
        </div>
    </body>
</html>