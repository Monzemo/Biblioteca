<?php include 'header.php'; 
require_once 'db.php';
?>
		<div class="content">
			<h1>Modificar Articulo</h1>
			<br>
			<p>Bienvenido Administrador</p><br>
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
			<div class="ventana-tabla">
				<div class="busqueda"><!-- botones para busqueda de articulo ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<fieldset id="buscador">
						<input type="text" id="buscador" placeholder="Buscar" required>
						<input type="submit" value="Buscar" id="registrar">
						<select name="tipo_usuario" id="tipo" required><option value="">[Seleciona tipo de busqueda]</option></select>
					</fieldset>
				</div><!-- fin de botones de qa busqueda de artuculo ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
			try{
				$stmt =$db_con->prepare("SELECT * FROM articulos");
				$stmt->execute();
				$count =$stmt->rowCount();
				if($count!=0):?>
				<div class="tabla"><!-- inicio de tabla de busqueda ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<table id="bus-edit">
						<tr>
							<th>Seleccion</th>
							<th>Id</th>
							<th>Foto</th>
							<th>Titulo</th>
							<th>Subtitulo</th>
							<th>Descripcion</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
						<!-- Empiezan registros -->
						<?php 
							$articulos = $stmt->fetchAll();
							foreach ($articulos as $articulo) {?>
							<tr>
							<td><input type="checkbox" id="selec" name="selec" value="<?php echo $articulo['articulo_id']; ?>"></td>
							<td><?php echo $articulo['articulo_id']; ?></td>
							<td><a href="uploads/<?php echo $articulo['nombre_archivo'] ?>"><?php echo $articulo['nombre_archivo']; ?></a></td>
							<td><?php echo $articulo['titulo']; ?></td>
							<td><?php echo $articulo['subtitulo']; ?></td>
							<td><?php echo $articulo['descripcion']; ?></td>
							<td><input type="submit" value="Modificar" class="modif" id="modif"></td>
							<td><input type="submit" value="Eliminar" class="elim" id="elim"></td>
						</tr>
							
							<?php
							
							}
						?>
						
					</table>
				</div><!--fin de tabla de busqueda ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
				endif;
				}catch(PDOException $e){
					echo "Error";
					echo $e->getMessage();
				}
			
			
			?>
			
			
				
			</div>
		</div>
		<script>
			$(function(){
				
				$('.elim').click(function(event){
		        	$("input:checkbox[name=selec]:checked").each(function(){
		            if (confirm('¿Seguro que desea eliminar el usuario?')) {
		                $.ajax({
		                type:'DELETE',
		                url:'edit-articulo.php?articulo_id='+$(this).val(),
		                beforeSend:function(){
		                    
		                },
		                success:function(data){
		                    console.log(data);
		                    if(data=="1"){
		                        alert("Usuario eliminado correctamente");
		                        location.reload();
		                    }
		                }
		            })
		            } else {
		                alert('Eliminacion cancelada.');
		            }
		            
		        })
    })
				
				$('.modif').click(function(event){
					$("input:checkbox[name=selec]:checked").each(function(){
						$.ajax({
							type:'GET',
							url:'edit-articulo.php?articulo_id='+$(this).val(),
							beforeSend:function(){
								openVentana();	
							},
							success:function(data){
								$('.cs-loader').hide();
								$('#modal-form').show().html(data);
								console.log(data);
							}
						});
					});
				});
				
				
				function closeVentana(){
			        $(".ventana").slideUp("fast");
			    }
			    
			    $('.cerrar').click(function(){
			        console.log("cerrar");
			        closeVentana();
			    })
			    
			    function openVentana(){
			        $(".ventana").slideDown("slow");
			    }
			    
			    $('input[type="checkbox"]').on('change', function() {
			        $('input[type="checkbox"]').not(this).prop('checked', false);
			    });
			});
		</script>
		<!-- Fin del contenedor +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!-- Inicio del footer ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="footer">
			<p>&copy; Copyright - Biblioteca Instituto Tecnol&oacute;gico de Ensenada 2016</p>
		</div>
		<!-- Fin del footer +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	</div>