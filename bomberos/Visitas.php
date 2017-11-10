
<?php

require_once("gestionBD.php");
require_once("gestionarUsuarios.php");

// Inicializamos o recuperamos la sesión
session_start();


if (!isset($_SESSION["formulario"])) {
	// Asignamos valor por defecto a los elementos
	$formulario["Descripcion"] = "";
	$formulario["Numero_de_visitantes"] = "";
	$formulario["Fecha"] = "";
	$formulario["Personal"] = "";
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

        <title>Visitas</title>
        <meta name="description" content="">
        <meta name="author" content="CONFRETO">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Añadiendo la hoja de estilos -->
        <link rel="stylesheet" type="text/css" href="CSS/EstilosComun.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/navegacion.css" />
        <link rel="stylesheet" type="text/css" href="CSS/Estilos_formulario_visita.css" />
        <link rel="stylesheet" type="text/css" href="CSS/errorPhp.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/validacionFormularioVisitas.js"></script>

    </head>

    <body>
    	
    	<?php
    	include_once("cabecera.php");
		include_once("menu.php");
    	?>
        <div class="cajaCuerpo">
            <?php
		if (isset($errores)) {
			echo '<div class = "error">';
			foreach ($errores as $error) {
				echo $error;
			}

			echo '</div>';
		}
		?>


            
                
                <form action="tratamiento_visitas.php"  method="post" onsubmit="return validarFormularioVisitas()">
                    
                    <h4>Solicitar una visita</h4>
                
                    <label  for="Descripcion">Descripción:</label>
                    <input type="text" id="Descripcion" name="Descripcion" value="<?php echo $formulario['Descripcion'];?>" placeholder="Visita escolar" maxlength="50" required oninput="return validarDescripcion()"/>
                     

                    <label  for="Numero_de_visitantes">Número de visitantes:</label>
                    <input type="number" id="Numero_de_visitantes" name="Numero_de_visitantes" placeholder="50" required value ="<?php echo $formulario['Numero_de_visitantes'];?>" title="Visitantes" oninput="return validarNumeroVisitantes()"/>

                    <label  for="Fecha">Fecha:</label>
                    <input type="date" id="Fecha" name="Fecha" required onchange="return validarFecha()"/>
                    
                    <label for="Personal">Personal solicitado:</label>
					<select name="Personal[]" id="Personal" size="1" multiple required>
						<?php $conexion = crearConexionBD();
						$personas = lista_personal_activo($conexion);
						cerrarConexionBD($conexion);
						foreach ($personas as $pers) { ?>
							<option value="<?php echo $pers["PID"] ?>"><?php echo $pers["PID"] ?> (<?php echo $pers["APELLIDOS"] ?>, <?php echo $pers["NOMBRE"] ?>)</option>
						<?php } ?>
					</select>
                        
                    <input type="submit" value="Solicitar" />
                </form>

            
           <?php
           include_once('pie.php');
           ?>
           
        </div>
    </body>
</html>