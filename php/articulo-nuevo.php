<?php include 'header.php'; ?>
<?php 
session_start();
$form_token=md5(uniqid('auth',true));
$_SESSION['form_token']=$form_token;
require_once 'db.php'; ?>

		<!-- Inicio del Contenedor -->
		<div class="content">
			<h1>Articulos nuevos</h1>
			<br>
			<p>Bienvenido Administrador</p>
			<div class="ejem">
				<form action="" id="login" method="post" enctype="multipart/form-data">
					
					<h1>Nuevo Articulo</h1>
					<fieldset id="inputs">
						<input type="text" id="id" name="id" placeholder="Id" autofocus required>
						<input type="file" id="archivo" name="archivo" placeholder="Selecciona Foto" autofocus required>
						<input type="text" id="titulo" name="titulo" placeholder="Titulo del Articulo" autofocus required>
						<input type="text" id="subtitulo" name="subtitulo" placeholder="Subtitulo del Articulo" autofocus required>
						<input type="text" id="descripcion" name="descripcion" placeholder="Descripcion del articulo" autofocus required>
						<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" >
					</fieldset>
					<fieldset id="actions">
						<input type="submit" value="Registrar" id="regis">
						<input type="reset" value="Cancelar" id="reset">
					</fieldset>
				</form>
			</div>
		</div>
		<script>
			jQuery(document).ready(function($) {
				$('#login').submit(function(event){
					console.log("submit")
					event.preventDefault();
					$.ajax({
						type:'POST',
						url:'db_nuevo_articulo.php',
						data: new FormData(this),
						processData:false,
      					contentType:false,
						beforeSend:function(){
							$('#loading').show();
						},
						success:function(data){
							$('#loading').hide();
							console.log(data);
						}
						
					})
				})
			});
		</script>
		<!-- Fin del contenedor -->
		<!-- Inicio del footer -->
<?php include 'footer.php'; ?>