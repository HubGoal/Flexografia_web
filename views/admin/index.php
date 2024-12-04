<?php
require 'config/database.php';
require 'config/config.php';
require 'controllers/admin_funciones.php';

$db = new Database();
$con = $db->conectar();
/*
$password = password_hash('admin', PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (usuario,password,nombre,correo,activo,fecha_alta) VALUES ('admin','$password','Administrador','contacto@23publicidad.mx', 1 , NOW())";

$con ->query($sql);*/
$errors = [];
// print_r(gettype($errors));
if(!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if(esNulo([$usuario,$password])){
        $errors []="Debe llenar todos los campos";
    }

    if(count($errors) == 0){
        $errors[] = login($usuario,$password,$con);
    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit%3A200%2C300%2C400%2C500%2C600%2C800" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A200%2C300%2C400%2C500%2C600%2C800" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A400" />
    <link rel="stylesheet" href="..//css/login.css">
    <title>Login Administrador</title>
</head>

<body>
    <section class="left__form">
    </section>

    <section class="right__form">
        <form action="index.php" method="post">
            <div class="logo__text">
                <a href="..//index.php">
                <img src="img/23LogoText.png" alt="">
                </a>
                
            </div>
            <h1>Bienvenido de vuelta!</h1>
            <p>Inicie sesion para continuar como administrador.</p>


            <label for="usuario">Ingresa tu usuario.</label>
            <input type="text" class="box" placeholder="Usuario" name="usuario" id="usuario" requiredsad autofocus>


            <label for="password">Contraseña.</label>
            <input type="password" name="password" placeholder="Contraseña" id="password" requiredasd>
            <?php mostrarMensajes($errors); ?>

            <div>
                <p class="forget-password">¿Olvidaste tu contraseña?</p>
            </div>
            <div class="submit-button">
                <input class="login-button" name="btn_ingresar" type="submit" value="Iniciar Sesión">
            </div>

        </form>
    </section>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>