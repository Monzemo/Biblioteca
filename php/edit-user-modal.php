<?php 
require_once 'db.php';

if($_POST){
    $user_id = $_POST['user_id'];
    try{
        $stmt = $db_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$user_id));
        $count = $stmt->rowCount();
        if($count != 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_type = $user['user_type'];
            switch ($user_type) {
                case 'administrador':
                    // code...
                    $sql = "SELECT * FROM users INNER JOIN user_data ON users.user_data_id = user_data.user_data_id INNER JOIN admin_data ON users.user_id = admin_data.user_id WHERE users.user_id=:user_id";
                    break;
                case 'alumno':
                        // code...
                    $sql = "SELECT * FROM users INNER JOIN user_data ON users.user_data_id = user_data.user_data_id INNER JOIN alumnos_data ON users.user_id = alumnos_data.user_id WHERE users.user_id=:user_id";
                    break;
            
                case 'maestro':
                    // code...
                    $sql = "SELECT * FROM users INNER JOIN user_data ON users.user_data_id = user_data.user_data_id INNER JOIN maestros_data ON users.user_id = maestros_data.user_id WHERE users.user_id=:user_id";
                    break;
                case 'externo':
                        // code...
                    $sql = "SELECT * FROM users INNER JOIN user_data ON users.user_data_id = user_data.user_data_id INNER JOIN maestros_data ON users.user_id = maestros_data.user_id WHERE users.user_id=:user_id";
                    break;
                
                default:
                    // code...
                    break;
            } //switch end
            $stmt = $db_con->prepare($sql);
            $stmt->execute(array(':user_id'=>$user_id));
            $count = $stmt->rowCount();
            if($count!=0):
                $user = $stmt->fetch(PDO::FETCH_ASSOC);?>
                <div class="formulario-edit">
                <h2>Editar usuario</h2>
                <form action="" id="editar-form" method="post" enctype="multipart/form-data">
                    <div class="error">
                        
                    </div>
                    <table id="tabla-edit">
                        <tr>
                            <td><input type="text" id="id" name="id" placeholder="Id" value="<?php echo $user['uid']; ?>" autofocus required></td>
                        </tr>
                        <tr><td><img src="./uploads/<?php echo $user['avatar']?>"></img></td></tr>
                        <tr>
                            <td>
                                <input type="file" id="foto" name="foto" accept="image/*;capture=camera" placeholder="Selecciona Foto" autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $user['nombre'];?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="apeP" name="apeP" placeholder="Apellido Paterno" value="<?php echo $user['apellido_paterno']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="apeM" name="apeM" placeholder="Apellido Materno" value="<?php echo $user['apellido_materno']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><input type="tel" id="tel" name="tel" placeholder="Telefono" value="<?php echo $user['telefono']; ?>" required></td>
                        </tr>
                        <?php switch($user_type){
                            case 'administrador':?>
                                <tr>
                                    <td><input type="password" id="nip" name="nip" placeholder="NIP">
                                    <span class="descripcion">Editar si quiere cambiar la contraseña</span></td>
                                </tr>
                            <?php break;
                            case 'alumno': ?>
                                <tr><td><input type="text" id="carrera" name="carrera" placeholder="Carrera" value="<?php echo $user['carrera'];?>" required></td></tr>
							    <tr><td><input type="text" id="semestre" name="semestre" placeholder="Semestre" value="<?php echo $user['semestre'];?>" required></td></tr>
                            <?php break; 
                            case 'maestro': ?>
                                <tr><td><input type="text" id="carrera" name="carrera" placeholder="Carrera Profesional" value="<?php echo $user['carrera']; ?>" required></td></tr>
                            <?php break; 
                            case 'externo': ?>
                                <tr><td><input type="text" id="motivo" name="motivo" placeholder="Motivo de visita" value="<?php echo $user['motivo_visita']; ?>" required></td></tr>
                                <?php break; 
                        }?>
                        
                        
                        <tr>
                            <td><input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" value="<?php echo $user['correo']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><h3>Intereses</h3><br></td>
                            <?php
                            $stmt = $db_con->prepare("SELECT nombre FROM intereses WHERE user_id=:user_id");
                            $stmt->execute(array(':user_id'=>$user_id));
                            $intereses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="chbox" name="intereses[]" value="Fisica" <?php if (in_array(array('nombre'=>'Fisica'),$intereses)) echo "checked='checked'"; ?>>Fisica
                                <input type="checkbox" id="chbox" name="intereses[]" value="Calculo" <?php if (in_array(array('nombre'=>'Calculo'),$intereses)) echo "checked='checked'"; ?>>Calculo
                                <input type="checkbox" id="chbox" name="intereses[]" value="Quimica" <?php if (in_array(array('nombre'=>'Quimica'),$intereses)) echo "checked='checked'"; ?>>Quimica
                                <input type="checkbox" id="chbox" name="intereses[]" value="Administracion" <?php if (in_array(array('nombre'=>'Administracion'),$intereses)) echo "checked='checked'"; ?>>Administracion
                                <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                            </td>
                        </tr>
                        
                        <tr>
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
            url:'db_edit.php',
            data: new FormData(this),
            processData:false,
            contentType:false,
            beforeSend:function(){
                console.log("antes");
            },
            success:function(data){
                if(data="1"){
                    alert("Datos actualizados");
                    location.reload();
                }
            }
        })
    });
            </script>
            <?php
            endif;
            
        }
        /*
        $stmt = $db_con->prepare("SELECT * FROM users INNER JOIN user_data ON users.user_data_id = user_data.user_data_id INNER JOIN alumnos_data ON users.user_id = alumnos_data.user_id WHERE users.user_id=:user_id");
        $stmt->execute(array(':user_id'=>$user_id));
        $count = $stmt->rowCount();
        if($count!=0):
            $user = $stmt->fetch(PDO::FETCH_ASSOC);?>
            
        <?php endif; */
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    try{
        $user_id = $_GET['user_id'];
        $stmt = $db_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$user_id));
        $count = $stmt->rowCount();
        if($count != 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $db_con->prepare("DELETE FROM user_data WHERE user_data_id=:user_data_id");
            if($stmt->execute(array(':user_data_id'=>$user['user_data_id']))){
                echo "1";
            }else{
                echo "Query dont execute";
            }
            
        }
        
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>