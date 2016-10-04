<?php include 'header.php'; ?>

<?php 

require_once 'db.php'; ?>

<!-- SELECT * FROM user_data INNER JOIN users ON users.user_data_id = user_data.user_data_id; -->

	<!-- Modal -->
	<div class="ventana">
		<div class="cs-loader">
		  <div class="cs-loader-inner">
		    <label>	●</label>
		    <label>	●</label>
		    <label>	●</label>
		    <label>	●</label>
		    <label>	●</label>
		    <label>	●</label>
		  </div>
		</div>
		<div class="modal-form"  style="width:50%; height:50%;">
			<div class="cerrar"><a href="javascript:closeVentana();">Cerrar</a></div>
			<div class="content" id="modal-form">
				
			</div>
		</div>
	</div>
	<!-- End Modal -->

		<!-- Inicio del Contenedor ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="content">
			<h1>Altas de Administradores &oacute; registros nuevos</h1>
			<br>
			<p>Bienvenido Administrador</p><br>
			
			
<?php
try{
	$stmt = $db_con->prepare("SELECT * FROM user_data INNER JOIN users ON users.user_data_id = user_data.user_data_id");
	$stmt->execute();
	$count = $stmt->rowCount();
	if($count != 0){?>
		<div class="tabla">
				<table id="bus-edit">
						<tr>
							<th>Selecci&oacute;n</th>
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Telefono</th>
							<th>Correo</th>
							<th>Tipo</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
		<?php
		$users = $stmt->fetchAll();
		foreach($users as $row){?>
			<tr>
				<td><input type="checkbox" id="selec" name="selec" value="<?php echo $row['user_id']?>"></td>
				<td><?php echo $row['nombre'] ?></td>
				<td><?php echo $row['apellido_paterno']?></td>
				<td><?php echo $row['apellido_materno']?></td>
				<td><?php echo $row['telefono']?></td>
				<td><?php echo $row['correo']?></td>
				<td id="user_type"><?php echo $row['user_type']?></td>
				<td><input type="submit" value="Modificar" class="modif" id="modif"></td>
				<td><input type="submit" value="Eliminar" class="elim" id="elim"></td>
			</tr>
		<?php } ?>
		</table>
		</div>
	<?php }
    }catch(PDOException $e){
    	echo "Error";
    	echo $e->getMessage();
    }


?>

		
			
						
			
		</div>
		<script type="text/javascript" src="../js/allUsers.js"></script>
		<!-- Fin del contenedor ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php include 'footer.php'; ?>