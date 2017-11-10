<?php 
session_start()
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Conócenos</title>
		<meta name="description" content="">
		<meta name="author" content="raulr">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		
		<!-- Añadiendo la hoja de estilos -->
		<link rel="stylesheet"  href="css/navegacion.css"/>
		<link rel="stylesheet"  href="CSS/EstilosComun.css"/>
        <link rel="stylesheet"  href="CSS/EstilosAbout.css"/>
		
	
	</head>

	<body>
		<div class="cajaCuerpo">
		
		
	    <?php
	   	    include_once('cabecera.php');
			include_once('menu.php');
	    ?>
	    
			<h1 class="tituloPagina">CONÓCENOS</h1>
            
			
            <div class="contenido">
                <h2>Ubicación</h2>
                <p>
				El parque de bomberos se encuentra en el barrio de Pino Montano, en la provicia de Sevilla, situado en el norte de
				la capital. Se encuentra en la calle Sembradores. Para ver la localización en el mapa, haga click en
				<a href="https://www.google.es/maps/place/Sembradores+(Parque+Bomberos)/
				@37.4231283,-5.9687274,16z/
				data=!4m8!1m2!2m1!1sparque+de+bomberos+cerca+de+pino+montano,+sevilla!3m4!1s0xd126941977eb3b1:0xd1fec027031c9712!8m2!3d37.422493!4d-5.9662576" target="_blank"> <strong>Ubicación</strong></a>
                </p>
			
                <h3>Servicio</h3>
			    <p>
				Estamos a la disposición de todos los ciudadanos de Pino Montano. El parque de bomberos realiza acciones de salvamento en el barrio de Pino Montano y alrededores,
				en situaciones donde se requiere una atención profesional (apertura de viviendas, incendios, rescates, inundaciones, etc.).
				Contamos con una variada flota de vehículos para cubrir todo tipo de intervenciones:
			    </p>
                <br/>
                <ul>
                	<li><strong>Bomba Urbana Pesada (<em>BUP</em>)</strong></li>
                	<li><strong>Bomba Urbana Ligera (<em>BUL</em>)</strong></li>
                	<li><strong>Unidade de Personal y Carga (<em>UPC</em>)</strong></li>
                	<li><strong>Auto Escala Automatica (<em>AEA</em>)</strong></li>
                	<li><strong>Furgón de Salvamentos Varios (<em>FSV</em>)</strong></li>
                </ul> 
            </div>
            
	    <?php
		    include_once('pie.php');
	    ?>
            
		</div>
	</body>
</html>
