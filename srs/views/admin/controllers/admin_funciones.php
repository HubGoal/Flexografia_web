<?php

function esNulo(array $parametros)
{
    foreach ($parametros as $parametro) {
        if(strlen(trim($parametro) < 1)) {
            return true;
        }
    }
    return false;
}



function emailExiste($email, $con){
    $sql = $con->prepare( "SELECT id FROM usuarios WHERE correo LIKE ? LIMIT 1");
    $sql->execute([($email)]);
    if ($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}
function mostrarMensajes(array $errors){
    if(count($errors) > 0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>'. $error .'</li>';
        }
        echo '<ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}  

function validaToken($id, $token,$con){
    $msg = "";
    $sql = $con->prepare( "SELECT id FROM usuarios WHERE id LIKE ? AND token LIKE ? LIMIT 1");
    $sql->execute([$id,$token]);
    if ($sql->fetchColumn() > 0){
        if(activarUsuario($id,$con)){
            $msg = "Cuenta Activada";
        }else{
            $msg = "Error al activar tu cuenta";
        }

    }else {
        $msg = "Error al encontrar informacion del cliente";
    }
    return $msg;
}

function activarUsuario($id,$con){
    $sql = $con->prepare( "UPDATE usuarios SET activacion = 1, token = '' WHERE id LIKE ? ");
    return $sql ->execute([$id]);


}

function login($usuario,$password,$con){
    $sql = $con->prepare("SELECT id,usuario,password,nombre FROM admin WHERE usuario LIKE ? AND activo = 1 LIMIT 1");

    $sql->execute([$usuario]);
    if($row = $sql->fetch(PDO::FETCH_ASSOC)){
            if(password_verify($password,$row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nombre'];
                $_SESSION['user_type'] = 'admin';
                header("Location:inicio.php");
                exit;
            }
    }else {
        return "El usuario y/o contraseña son incorrectos";
    }
}
