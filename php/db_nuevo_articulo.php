<?php
require_once 'db.php';

session_start();
if($_POST){
    if($_POST['form_token'] != $_SESSION['form_token']){
        echo "Form invalido";
    }else{
        $id = $_POST['id'];
        $archivo = $_FILES['archivo'];
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $descripcion = $_POST['descripcion'];
        
        try{
            $stmt = $db_con->prepare("SELECT * FROM articulos WHERE articulo_id=:articulo_id");
            $stmt->execute(array(':articulo_id' => $id));
            $count = $stmt->rowCount();
            if($count==0){
                $prefix = time() . '_';
                $destiny = "uploads/";
                $newName = $prefix . $archivo['name'];
                if(move_uploaded_file($archivo['tmp_name'], $destiny . $newName)){
                    $stmt = $db_con->prepare("INSERT INTO articulos(articulo_id, nombre_archivo, titulo, subtitulo, descripcion) VALUES (:articulo_id, :nombre_archivo, :titulo, :subtitulo, :descripcion)");
                    $stmt->bindParam(":articulo_id", $id);
                    $stmt->bindParam(":nombre_archivo", $newName);
                    $stmt->bindParam(":titulo", $titulo);
                    $stmt->bindParam(":subtitulo", $subtitulo);
                    $stmt->bindParam(":descripcion", $descripcion);
                    if($stmt->execute()){
                        echo "1";
                    }
                }
                
            }
        }catch(PDOException $e){
        echo "Error";
        echo $e->getMessage();
      }
        
    }
}