<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/backend.css">
	<link rel="shortcut icon" href="imagenes/icono-admin.ico">
	<title>Administraci&oacute;n de Biblioteca ITE</title>
</head>
<body>
	<div class="container">
		<!-- Inicio del Header========================================= -->
		<div class="header">
			<div id="logo-sep">
				<img width="200" heigth="100" src="../imagenes/sep.gif" alt="">
			</div>
			<div id="logo-admin">
				<img src="../imagenes/3.png" alt="">
			</div>
			<div id="logo-dges">
				<img src="../imagenes/dgest.png" alt="">
			</div>
		</div>
		<!-- Fin del Header ========================================-->
		<!-- Inicio del menu ==================================================================-->
		<div class="slidebar">
			<ul class="nav">
				<li><a href="index.php">Inicio</a>
				<li><a href="#">Registro</a>
					<ul>
						<li><a href="../php/nuevo-registro.php">Nuevo</a></li>
						<li><a href="../php/registro.php">Buscar y Editar</a></li>
					</ul>
				</li>
				<li><a href="#">Articulos de inf.</a>
					<ul>
						<li><a href="../php/articulo-nuevo.php">Nuevo</a></li>
						<li><a href="../php/articulo-modif.php">Buscar y Editar</a></li>
					</ul>
				</li>
				<li><a href="../php/busqueda.php">Busqueda</a></li>
				<li><a href="#">Estadisticas</a>
					<ul>
						<li><a href="../php/estad-graficas.php">Graficas</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Fin del menu ===============================================================================-->
		<!-- Inicio del Contenedor =========================================================================== -->
		<div class="content">
			<h1>Administraci&oacute;n</h1>
			<br>
			<p>Bienvenido Administrador</p>
			<br>
			<div class="texto-indicativo">
				<p>En esta secci&oacute;n se le permitira hacer las modificaciones o actualizaciones que crea conveniente para el mejor manejo del sistema,
				   esperando le sea de mucha utilidad y facil manejo.</p>
			</div>
			<div class="ejem">
				<img src="../imagenes/logoadmin.jpg" alt="">
			</div>
		</div>
		<!-- Fin del contenedor =========================================================================================-->
		<!-- Inicio del footer ==============================================================================================-->
		<div class="footer">
			<p>&copy; Copyright - Biblioteca Instituto Tecnol&oacute;gico de Ensenada 2016</p>
		</div>
		<!-- Fin del footer =====================================================================================================-->
	</div>
</body>
</html>