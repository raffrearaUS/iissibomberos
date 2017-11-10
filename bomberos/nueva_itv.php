
<?php
session_start();
if (!isset($_SESSION["loginpid"])) {
	header("Location: login.php");
}
require_once ("gestionBD.php");
require_once ("gestionarVehiculos.php");

if (!isset($_SESSION["formulario"])) {
	// Asignamos valor por defecto a los elementos
	$formulario["Fecha"] = "";
	$formulario["Resultado"] = "";
	$formulario["Vehiculo"] = "";
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

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Añadir ITV</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Añadiendo la hoja de estilos -->
        <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/Estilo_formularios.css" />
        <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
        <script type="text/javascript" src="js/validacionFormularioItv.js"></script>

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
                <form action="tratamiento_itv.php"  method="post" onsubmit="return validarFormularioItv()">
                    
                    <h2>Añadir ITV</h2>
                   
                
                    <label  for="Fecha">Fecha:</label>
                    <input type="date" id="Fecha" name="Fecha" value="<?php echo $formulario['Fecha'];?>" required onchange="return validarFecha()"/>
                      

                    <label  for="Resultado">Resultado:</label>
					<select name="Resultado" id="Resultado" required>
						<option value="FAVORABLE">FAVORABLE</option>
						<option value="DESFAVORABLE">DESFAVORABLE</option>
					</select>
					
					<label for="Vehiculo">Vehículo:</label>
					<select name="Vehiculo" id="Vehiculo" required onchange="return validarResultado()">
						<option value="" disabled selected>Selecciona vehiculo</option>
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
					
                    <input type="submit" value="Añadir" />
                </form>

            
           <?php
           include_once('pie.php');
           ?>
           
        </div>
    </body>
</html>