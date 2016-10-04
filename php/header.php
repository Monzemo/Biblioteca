<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/backend.css">
	<link rel="stylesheet" href="../css/backend-altas.css">
	<!--<script src="../js/jquery-1.12.3.min.js"></script>-->
	<link rel="shortcut icon" href="../imagenes/icono-sello.ico">
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	<title>Administraci&oacute;n de Biblioteca ITE</title>
</head>
<body>
	<div class="container">
		<!-- Inicio del Header ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
		<!-- Fin del Header +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Inicio del menu +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="slidebar">
			<ul class="nav">
				<li><a href="../admin/index.php">Inicio</a>
				<li><a href="#">Registro</a>
					<ul>
						<li><a href="../php/nuevo-registro.php">Nuevo</a></li>
						<li><a href="../php/registro.php">Buscar y Editar</a></li>
					</ul></li>
				<li><a href="#">Articulos de inf.</a>
					<ul>
						<li><a href="articulo-nuevo.php">Nuevo</a></li>
						<li><a href="articulo-modif.php">Buscar y Editar</a></li>
					</ul>
				</li>
				<li><a href="busqueda.php">Busqueda</a></li>
				<li><a href="#">Estadisticas</a>
					<ul>
						<li><a href="estad-graficas.php">Graficas</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Fin del menu ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
