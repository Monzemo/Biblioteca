<?php include 'header.php';
session_start();

$form_token = md5(uniqid('auth',true));

$_SESSION['form_token'] = $form_token;

 ?>

		<!-- Inicio del Contenedor ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		<div class="content">
			<h1>Altas de Administradores &oacute; registros nuevos</h1>
			<br>
			<p>Bienvenido Administrador</p><br>
			<div class="nuevo">
				<select name="select_formulario" id="select_formulario">
					<option value="default">[Selecciona el tipo de Registro]</option>
					<option value="admin">Administradores</option>
					<option value="alumno">Alumnos</option>
					<option value="maestro">Maestros</option>
					<option value="externo">Visitas Externas</option>
				</select> <!-- boton de seleccion -->
			</div><br><br>
			<div class="loader" style="display:none;">Loading...</div>
		  
			<div class="altas-admin" style="display:none;"><!-- inicio de formulario de administradores +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="formulario-reg-admin"><br>
				<h2>Registro de Administradores</h2><br><hr><br>
					<form action="" id="registro-form" method="post" enctype="multipart/form-data">
						<div id="error">
						</div>
						<table id="tabla-reg">
							<tr><td><input type="text" id="id" name="id" placeholder="Id" autofocus required></td></tr>
							<tr><td><input type="file" id="foto" name="foto" accept="image/*;capture=camera" placeholder="Selecciona Foto" required></td></tr>
							<tr><td><input type="text" id="nombre" name="nombre" placeholder="Nombre" required></td></tr>
							<tr><td><input type="text" id="apeP" name="apeP" placeholder="Apellido Paterno" required></td></tr>
							<tr><td><input type="text" id="apeM" name="apeM" placeholder="Apellido Materno" required></td></tr>
							<tr><td><input type="tel" id="tel" name="tel" placeholder="Telefono" required></td></tr>
							<tr><td><input type="password" id="nip" name="nip" placeholder="NIP" required></td></tr>
							<tr><td><input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" required></td></tr>
							<tr><td><h3>Intereses</h3><br></td></tr>
							<tr><td><input type="checkbox" id="chbox" name="intereses[]" value="Fisica">Fisica
							<input type="checkbox" id="chbox" name="intereses[]" value="Calculo">Calculo
							<input type="checkbox" id="chbox" name="intereses[]" value="Quimica">Quimica
							<input type="checkbox" id="chbox" name="intereses[]" value="Administracion">Administracion</td></tr>
							<input type="hidden" name="form_token" value="<?php echo $form_token; ?>">
							<input type="hidden" name="user_type" value="administrador">
							<tr><td><br><input type="submit" value="Registrar" id="regis"></td></tr>
						</table>
					</form>
				</div>
			</div><!-- fin de formulario admin++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div class="altas-alum" style="display:none;"><!-- inicio formulario de alumnos ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
				<div class="formulario-reg-alum">
				<h2>Registro de Alumnos</h2><br><hr><br>
					<form action="" id="registro-form" method="post" enctype="multipart/form-data">
						<table id="tabla-reg">
							<tr><td><input type="text" id="id" name="id" placeholder="Numero de Control" autofocus required></td></tr>
							<tr><td><input type="file" id="foto" name="foto" accept="image/*;capture=camera" placeholder="Selecciona Foto" accept="image/*;capture=camera" autofocus required></td></tr>
							<tr><td><input type="text" id="nombre" name="nombre" placeholder="Nombre" autofocus required></td></tr>
							<tr><td><input type="text" id="apeP" name="apeP" placeholder="Apellido Paterno" autofocus required></td></tr>
							<tr><td><input type="text" id="apeM" name="apeM" placeholder="Apellido Materno" autofocus required></td></tr>
							<tr><td><input type="tel" id="tel" name="tel" placeholder="Telefono" autofocus required></td></tr>
							<tr><td><input type="text" id="carrera" name="carrera" placeholder="Carrera" autofocus required></td></tr>
							<tr><td><input type="text" id="semestre" name="semestre" placeholder="Semestre" autofocus required></td></tr>
							<tr><td><input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" autofocus required></td></tr>
							<tr><td><h3>Intereses</h3><br></td></tr>
							<tr><td><input type="checkbox" id="chbox" name="intereses[]" value="Fisica">Fisica
							<input type="checkbox" id="chbox" name="intereses[]" value="Calculo">Calculo
							<input type="checkbox" id="chbox" name="intereses[]" value="Quimica">Quimica
							<input type="checkbox" id="chbox" name="intereses[]" value="Administracion">Administracion</td></tr>
							<input type="hidden" name="form_token" value="<?php echo $form_token; ?>">
							<input type="hidden" name="user_type" value="alumno">
							<tr><td><br><input type="submit" value="Registrar" id="regis"></td></tr>
						</table>
					</form>
				</div>
			</div><!-- fin de formulario alumnos ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div class="altas-maestros" style="display:none;"><!-- inicio de formulario maestros ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="formulario-reg-maestro">
				<h2>Registro de Maestros</h2><br><hr><br>
					<form action="" id="registro-form" method="post" enctype="multipart/form-data">
						<table id="tabla-reg">
							<tr><td><input type="text" id="id" name="id" placeholder="Matricula" autofocus required></td></tr>
							<tr><td><input type="file" id="foto" name="foto" accept="image/*;capture=camera" placeholder="Selecciona Foto" autofocus required></td></tr>
							<tr><td><input type="text" id="nombre" name="nombre" placeholder="Nombre" autofocus required></td></tr>
							<tr><td><input type="text" id="apeP" name="apeP" placeholder="Apellido Paterno" autofocus required></td></tr>
							<tr><td><input type="text" id="apeM" name="apeM" placeholder="Apellido Materno" autofocus required></td></tr>
							<tr><td><input type="tel" id="tel" name="tel" placeholder="Telefono" autofocus required></td></tr>
							<tr><td><input type="text" id="carrera" name="carrera" placeholder="Carrera Profesional" autofocus required></td></tr>
							<tr><td><input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" autofocus required></td></tr>
							<tr><td><h3>Intereses</h3><br></td></tr>
							<tr><td><input type="checkbox" id="chbox" name="intereses[]" value="Fisica">Fisica
							<input type="checkbox" id="chbox" name="intereses[]" value="Calculo">Calculo
							<input type="checkbox" id="chbox" name="intereses[]" value="Quimica">Quimica
							<input type="checkbox" id="chbox" name="intereses[]" value="Administracion">Administracion</td></tr>
							<input type="hidden" name="form_token" value="<?php echo $form_token; ?>">
							<input type="hidden" name="user_type" value="maestro">
							<tr><td><br><input type="submit" value="Registrar" id="regis"></td></tr>
						</table>
					</form>
				</div>
			</div><!-- fin de formulario maestros+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div class="altas-visitas" style="display:none;"><!-- inicio formulario visitas ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="formulario-reg-visita">
				<h2>Registro de Visitas Externas</h2><br><hr><br>
					<form action="" id="registro-form" class="registro-form" method="post" enctype="multipart/form-data">
						<table id="tabla-reg">
							<tr><td><input type="text" id="id" name="id" placeholder="Usuario" autofocus required></td></tr>
							<tr><td><input type="file" id="foto" name="foto" accept="image/*;capture=camera" placeholder="Selecciona Foto" autofocus required></td></tr>
							<tr><td><input type="text" id="nombre" name="nombre" placeholder="Nombre" autofocus required></td></tr>
							<tr><td><input type="text" id="apeP" name="apeP" placeholder="Apellido Paterno" autofocus required></td></tr>
							<tr><td><input type="text" id="apeM" name="apeM" placeholder="Apellido Materno" autofocus required></td></tr>
							<tr><td><input type="tel" id="tel" name="tel" placeholder="Telefono" autofocus required></td></tr>
							<tr><td><input type="text" id="motivo" name="motivo" placeholder="Motivo de visita" autofocus required></td></tr>
							<tr><td><input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" autofocus required></td></tr>
							<tr><td><h3>Intereses</h3><br></td></tr>
							<tr><td><input type="checkbox" id="chbox" name="intereses[]" value="Fisica">Fisica
							<input type="checkbox" id="chbox" name="intereses[]" value="Calculo">Calculo
							<input type="checkbox" id="chbox" name="intereses[]" value="Quimica">Quimica
							<input type="checkbox" id="chbox" name="intereses[]" value="Administracion">Administracion</td></tr>
							<input type="hidden" name="form_token" value="<?php echo $form_token; ?>">
							<input type="hidden" name="user_type" value="externo">
							<tr><td><br><input type="submit" value="Registrar" id="regis"></td></tr>
						</table>
					</form>
				</div>
			</div>
		</div><!-- fin de formulario visitas +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Fin del contenedor +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	</div>
	
	<script src="../js/register.js"></script> 
<?php include 'footer.php'; ?>
