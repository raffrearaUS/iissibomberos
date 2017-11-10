<?php
echo '<nav>
		<ul>
			<li><a href="index.php"> <strong>Inicio</strong> </a></li>
			<li><a href="about.php"> <strong>Sobre nosotros</strong> </a></li>
			<li><a href="Visitas.php"> <strong>Visitas</strong> </a></li>';
	if (!isset($_SESSION["loginpid"])) {		
			echo '<li id="sesion" style="float:right"><a href="login.php"><strong>Iniciar sesión</strong> </a></li>';
	} else {
			echo '
			<li style="float:right"><a href="logout.php"> <strong>Desconectarse</strong> </a></li>
			<li id="gestion" style="float:right"><a href="gestion.php"> <strong>Gestión</strong></a></li>';
	}
	echo '</ul>
	</nav>'
 ?>