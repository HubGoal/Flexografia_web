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

function esMail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function validaPassword($password, $repassword){

    if(strcmp($password, $repassword) === 0){
        return true;
    }
return false;
}

function generarToken(){    
    return md5(uniqid(mt_rand(),false));

}

function registrar(array $datos,$con){
    $sql = $con->prepare( "INSERT INTO clientes (nombre,email) VALUES (?,?)");
    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;
}

function registraUsuario(array $datos,$con){
    $sql = $con->prepare("INSERT INTO usuarios (correo,password,token,id_cliente)
    VALUES (?,?,?,?)");

    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;

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

function login($email,$password,$con){
    $sql = $con->prepare("SELECT us.id, us.correo, us.password, cl.nombre FROM usuarios us INNER JOIN clientes cl ON cl.Id = us.id_cliente WHERE correo LIKE ? LIMIT 1");


    $sql->execute([$email]);

    if($row = $sql->fetch(PDO::FETCH_ASSOC)){
        if(esActivo($email,$con)){
            if(password_verify($password,$row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['correo'];
                $_SESSION['user_name'] = $row['nombre'];
                header("Location:..//index.php");
                exit;
            }
        }else {
            return "El usuario no ha sido activado";
        }
    }else {
        return "El usuario y/o contraseña son incorrectos";
    }
}

function esActivo($email,$con){
    $sql = $con->prepare("SELECT activacion from usuarios WHERE correo LIKE ? LIMIT 1 ");
    $sql->execute([$email]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if($row['activacion'] == 1){
        return true;
    }else{
        return false;
    }
}