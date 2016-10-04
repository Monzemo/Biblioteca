<?php
require_once 'db.php';
require_once 'ImageManipulator.php';
session_start();
if($_POST){
  if($_POST['form_token'] != $_SESSION['form_token']){
    echo "Form invalido";
  }else{
    $uid = $_POST['id'];
    $avatar = $_FILES['foto'];
    $nombre = $_POST['nombre'];
    $apeP = $_POST['apeP'];
    $apeM = $_POST['apeM'];
    $tel = $_POST['tel'];
    $nip = $_POST['nip'];
    $correo = $_POST['correo'];
    $user_type = $_POST['user_type'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $motivo = $_POST['motivo'];
    // Administrador Data: id, foto, nombre, apeP, apeM, tel, nip, correo, intereses.
      try{
        $stmt = $db_con->prepare("SELECT * FROM users WHERE uid=:uid");
        $stmt->execute(array(':uid' => $uid));
        $count = $stmt->rowCount();
        if($count==0){
          
          //$avatar_storage_name = upifloadAvatar($avatar);
          $avatarSaved = uploadAvatar($avatar);
          if($avatarSaved != "0"){
            $stmt = $db_con->prepare("INSERT INTO user_data(avatar,nombre,apellido_paterno,apellido_materno,telefono) VALUES(:avatar, :nombre, :apellido_paterno, :apellido_materno, :telefono)");
            $stmt->bindParam(":avatar",$avatarSaved);
            $stmt->bindParam(":nombre",$nombre);
            $stmt->bindParam(":apellido_paterno",$apeP);
            $stmt->bindParam(":apellido_materno",$apeM);
            $stmt->bindParam("telefono",$tel);
          
            if($stmt->execute()){
              //echo "Registrado";
              $stmt = $db_con->prepare("INSERT INTO users(uid,correo,user_type,user_data_id) VALUES (:uid, :correo, :user_type, :user_data_id)");
              $stmt->bindParam(":uid",$uid);
              $stmt->bindParam(":correo",$correo);
              $stmt->bindParam(":user_type",$user_type);
              $stmt->bindParam(":user_data_id",$db_con->lastInsertId());
              if($stmt->execute()){
                // Users create.
                $user_id = $db_con->lastInsertId();
                
                if(!empty($_POST['intereses'])){
                  foreach($_POST['intereses'] as $interes){
                    $stmt = $db_con->prepare("INSERT INTO intereses(user_id,nombre) VALUES(:user_id, :nombre)");
                    $stmt->bindParam(":user_id",$user_id);
                    $stmt->bindParam(":nombre",$interes);
                    $stmt->execute();
                  }
                }
                switch ($user_type) {
                  case 'administrador':
                    // code...
                    $stmt = $db_con->prepare("INSERT INTO admin_data(user_id,nip) VALUES (:user_id, :nip)");
                    $stmt->bindParam(":user_id",$user_id);
                    $stmt->bindParam(":nip",$nip);
                    if($stmt->execute()){
                      echo "1";
                    };
                    break;
                  
                  case 'alumno':
                    $stmt = $db_con->prepare("INSERT INTO alumnos_data(user_id,carrera,semestre) VALUES (:user_id, :carrera, :semestre)");
                    $stmt->bindParam(":user_id",$user_id);
                    $stmt->bindParam(":carrera",$carrera);
                    $stmt->bindParam(":semestre",$semestre);
                    if($stmt->execute()){
                      echo "1";
                    };
                    break;
                  case 'maestro':
                    $stmt = $db_con->prepare("INSERT INTO maestros_data(user_id, carrera) VALUES (:user_id, :carrera)");
                    $stmt->bindParam(":user_id",$user_id);
                    $stmt->bindParam(":carrera",$carrera);
                    if($stmt->execute()){
                      echo "1";
                    };
                    break;
                  case 'externo':
                    $stmt = $db_con->prepare("INSERT INTO externos_data(user_id, motivo_visita) VALUES (:user_id, :movito)");
                    $stmt->bindParam(":user_id",$user_id);
                    $stmt->bindParam(":motivo",$motivo);
                    if($stmt->execute()){
                      echo "1";
                    };
                    break;
                  default:
                    // code...
                    break;
                }
              }
            }else{
              echo "Query not execute";
            }
          }else{
            echo "Ocurrio un Error al subir la imagen";
          }
          
          
        }else{
          echo "1";
        }
      }catch(PDOException $e){
        echo "Error";
        echo $e->getMessage();
      }
  }
}

function uploadAvatar($avatar){
  $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
  $fileExtension = strrchr($avatar['name'], ".");
  if(in_array($fileExtension, $validExtensions)){
    $newNamePrefix = time() . '_';
    $manipulator = new ImageManipulator($avatar['tmp_name']);
    //$width = $manipulator->getWidth();
    //$height = $manipulator->getHeight();
    //$centerX = round($width/2);
    //$centerY = round($height/2);
    
    //las dimenciones del avatar seran de 200x130
    //$x1 = $centerX - 100; // 200 / 2;
    //$y1 = $centerY - 65; // 130 / 2;
    
    //$x2 = $centerX + 100; //200 / 2;
    //$y2 = $centerY + 65; //130 /2;
    
    //imagen centrada y recortada a 200 x 130
    $newImage = $manipulator->resample("200", "130");
    
    $manipulator->save('uploads/' . $newNamePrefix . $avatar['name']);
    return $newNamePrefix . $avatar['name'];
  }else{
    return "0"; //Usado para checar si hay algun error;
  }
}


?>
