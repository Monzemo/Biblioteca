<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/backend.css">
	<link rel="stylesheet" href="../css/backend-altas.css">
	<title>Administraci&oacute;n de Biblioteca ITE</title>
</head>
<body>
	<div class="container">
		<!-- Inicio del Header ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
		<!-- Fin del Header ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Inicio del slider +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="slidebar">
			<ul class="nav">
				<li><a href="../admin/index.php">Inicio</a>
				<li><a href="#">Registro</a>
					<ul>
						<li><a href="../php/nuevo-registro.php">Nuevo</a></li>
						<li><a href="../php/registro.php">Buscar y Editar</a></li>
					</ul>
				</li>
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
		<!-- Fin del slider ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Inicio del Contenedor +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="content">
			<h1>Buscador de registros</h1>
			<br>
			<p>Bienvenido Administrador</p><br>
			<div class="ventana-tabla">
				<div class="busqueda"><!-- botones de busqueda y seleccion +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<fieldset id="buscador">
						<input type="text" id="buscador" placeholder="Buscar" required>
						<input type="submit" value="Buscar" id="registrar">
						<select name="tipo_usuario" id="tipo" required><option value="">[Seleciona tipo de busqueda]</option></select>
					</fieldset>
				</div><!-- fin de botones y seleccion +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="tabla"><!-- inicio de tabla de busqueda ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<table id="bus-edit">
						<tr>
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Telefono</th>
							<th>Correo</th>
							<th>Carrera</th>
						</tr>
						<tr>
							<td>Item #1</td>
							<td>Item #2</td>
							<td>Item #3</td>
							<td>Item #4</td>
							<td>Item #5</td>
							<td>Item #6</td>
						</tr>
						<tr>
							<td>Item #1</td>
							<td>Item #2</td>
							<td>Item #3</td>
							<td>Item #4</td>
							<td>Item #5</td>
							<td>Item #6</td>
						</tr>
					</table>
				</div><!-- fin de tabla de busqueda +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			</div>
		</div>
		<!-- Fin del contenedor ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Inicio del footer +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="footer">
			<p>&copy; Copyright - Biblioteca Instituto Tecnol&oacute;gico de Ensenada 2016</p>
		</div>
		<!-- Fin del footer ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	</div>
</body><!--
<script>
    function openVentana(){
        $(".ventana").slideDown("slow");
    }
    function closeVentana(){
        $(".ventana").slideUp("fast");
    }
</script>-->
</html>