<?php
require_once 'db.php';
require_once 'ImageManipulator.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){
    
}

if($_POST){
    $user_id = $_POST['user_id'];
    $uid = $_POST['id'];
    $avatar = $_FILES['foto'];
    $nombre = $_POST['nombre'];
    $apeP = $_POST['apeP'];
    $apeM = $_POST['apeM'];
    $tel = $_POST['tel'];
    $nip = $_POST['nip'];
    $correo = $_POST['correo'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $motivo = $_POST['motivo'];
    
    
    try{
        $stmt = $db_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$user_id));
        $count = $stmt->rowCount();
        if($count != 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($avatar['name']!=''){
                $newName = uploadAvatar($avatar);
                if($newName != "0"){
                    $stmt = $db_con->prepare("UPDATE user_data SET avatar=:avatar WHERE user_data_id=:user_data_id");
                    $stmt->bindParam(":avatar",$newName);
                    $stmt->bindParam(":user_data_id",$user['user_data_id']);
                    $stmt->execute();
                }
            }
            $stmt = $db_con->prepare("UPDATE user_data SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, telefono=:telefono WHERE user_data_id=:user_data_id");
            $stmt->bindParam(":nombre",$nombre);
            $stmt->bindParam(":apellido_paterno",$apeP);
            $stmt->bindParam(":apellido_materno",$apeM);
            $stmt->bindParam(":telefono",$tel);
            $stmt->bindParam(":user_data_id",$user['user_data_id']);
            if($stmt->execute()){
                $stmt = $db_con->prepare("UPDATE users SET uid=:uid, correo=:correo WHERE user_id=:user_id");
                $stmt->bindParam(":uid",$uid);
                $stmt->bindParam(":correo",$correo);
                $stmt->bindParam(":user_id",$user['user_id']);
                if($stmt->execute()){
                    switch($user['user_type']){
                        case 'administrador':
                            if($nip != ''){
                                $stmt = $db_con->prepare("UPDATE admin_data SET nip=:nip WHERE user_id=:user_id");
                                $stmt->bindParam(":nip",$nip);
                                $stmt->bindParam(":user_id",$user['user_id']);
                                if($stmt->execute()){
                                  echo "1";
                                };
                            }
                            break;
                        case 'alumno':
                            $stmt = $db_con->prepare("UPDATE alumnos_data SET carrera=:carrera, semestre=:semestre WHERE user_id=:user_id");
                            $stmt->bindParam(":carrera",$carrera);
                            $stmt->bindParam(":semestre",$semestre);
                            $stmt->bindParam(":user_id",$user['user_id']);
                            if($stmt->execute()){
                              echo "1";
                            };
                            break;
                        case 'maestro':
                            $stmt = $db_con->prepare("UPDATE maestros_data SET carrera=:carrera WHERE user_id=:user_id");
                            $stmt->bindParam(":carrera",$carrera);
                            $stmt->bindParam(":user_id",$user['user_id']);
                            if($stmt->execute()){
                              echo "1";
                            };
                            break;
                        case 'externo':
                            $stmt = $db_con->prepare("UPDATE externos_data SET motivo_visita=:motivo_visita WHERE user_id=:user_id");
                            $stmt->bindParam(":motivo_visita",$motivo);
                            $stmt->bindParam(":user_id",$user['user_id']);
                            if($stmt->execute()){
                              echo "1";
                            };
                            break;
                    }
                    
                    if(!empty($_POST['intereses'])){
                        $stmt = $db_con->prepare("DELETE FROM intereses WHERE user_id=:user_id");
                        if($stmt->execute(array('user_id'=>$user['user_id']))){
                            foreach($_POST['intereses'] as $interes){
                                $stmt = $db_con->prepare("INSERT INTO intereses(user_id,nombre) VALUES(:user_id, :nombre)");
                                $stmt->bindParam(":user_id",$user['user_id']);
                                $stmt->bindParam(":nombre",$interes);
                                $stmt->execute();
                            }
                        }
                    }
                }
            }
            
        }
    }catch(PDOException $e){
        echo $e->getMessage();
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
