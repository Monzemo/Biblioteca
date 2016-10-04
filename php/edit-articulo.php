<?php 
require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST){
        $articulo_id = $_POST['articulo_id'];
        $id = $_POST['id'];
        $archivo = $_FILES['archivo'];
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $descripcion = $_POST['descripcion'];
        try{
            if($archivo['name'] != ''){
                $prefix = time() . '_';
                $destino = "uploads/";
                $newName = $prefix . $archivo['name'];
                if(move_uploaded_file($archivo['tmp_name'], $destino . $newName)){
                    $stmt = $db_con->prepare("UPDATE articulos SET nombre_archivo=:nombre_archivo WHERE articulo_id=:old_articulo_id");
                    $stmt->bindParam(":nombre_archivo", $newName);
                    $stmt->bindParam(":old_articulo_id", $articulo_id);
                    $stmt->execute();
                }
            }
            $stmt = $db_con->prepare("UPDATE articulos SET articulo_id=:articulo_id, titulo=:titulo, subtitulo=:subtitulo, descripcion=:descripcion WHERE articulo_id=:old_articulo_id");
            $stmt->bindParam(":articulo_id", $id);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":subtitulo", $subtitulo);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":old_articulo_id", $articulo_id);
            if($stmt->execute()){
                echo "1";
            }
        }catch(PDOException $e){
        echo "Error";
        echo $e->getMessage();
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    try{
        
        $articulo_id = $GET['articulo_id'];
        $stmt = $db_con->prepare("DELETE FROM articulos WHERE articulo_id=:articulo_id");
        if($stmt->execute(array(':articulo_id'=>$articulo_id))){
            echo "1";
        }else{
            echo "QUery dotn";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $articulo_id = $_GET['articulo_id'];
    try{
        $stmt = $db_con->prepare("SELECT * FROM articulos WHERE articulo_id=:articulo_id");
        $stmt->execute(array(':articulo_id'=>$articulo_id));
        $count = $stmt->rowCount();
        if($count != 0){
            $articulo = $stmt->fetch(PDO::FETCH_ASSOC);?>
            <div class="formulario-edit">
                <h2>Editar articulo</h2>
                <form action="" id="editar-form" method="post" enctype="multipart/form-data">
                    <div class="error">
                        
                    </div>
                    <table id="tabla-edit">
                        <tr>
                            <td><input type="text" id="id" name="id" placeholder="Id" value="<?php echo $articulo['articulo_id']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><a href="uploads/<?php echo $articulo['nombre_archivo'] ?>"><?php echo $articulo['nombre_archivo']; ?></a></td>
                        </tr>
                        <tr>
                            <td><input type="file" id="archivo" name="archivo" placeholder="Selecciona Foto"></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="titulo" name="titulo" placeholder="Titulo del Articulo" value="<?php echo $articulo['titulo']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="subtitulo" name="subtitulo" placeholder="Subtitulo del Articulo" value="<?php echo $articulo['subtitulo']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="descripcion" name="descripcion" placeholder="Descripcion del articulo" value="<?php echo $articulo['descripcion']; ?>" required></td>
                        </tr>
                        <tr>
                            <input type="hidden" id="articulo_id" name="articulo_id" value="<?php echo $articulo['articulo_id']; ?>">
                            <td><input type="submit" value="Editar" id="regis"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <script>
                $('#editar-form').submit(function(event){
                   event.preventDefault();
                   $.ajax({
                       type:'POST',
                       url:'edit-articulo.php',
                       data: new FormData(this),
                       processData:false,
                       contentType:false,
                       success:function(data){
                           console.log(data);
                           if(data="1"){
                               alert("Datos actualizados");
                               location.reload();
                           }
                       }
                   })
                });
            </script>
        <?php }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>