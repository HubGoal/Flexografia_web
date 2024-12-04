<?php 
    require_once '..//models/config.php';
    require_once '..//controllers/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(esNulo([$email, $password])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(count($errors) == 0) {
        $errors[] = login($email,$password,$con);
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit%3A200%2C300%2C400%2C500%2C600%2C800" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A200%2C300%2C400%2C500%2C600%2C800" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A400" />
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>

    <section class="left__form">
    </section>

    <section class="right__form">
        <form action="login.php" method="post">
            <div class="logo__text">
                <a href="..//index.php">
                <img src="img/23LogoText.png" alt="">
                </a>
                
            </div>
            <h1>Bienvenido de vuelta!</h1>
            <p>Inicie sesion para continuar.</p>

            <?php mostrarMensajes($errors) ?>

            <label for="email">Ingresa tu correo.</label>
            <input type="email" class="box" placeholder="Email" name="email" id="email">


            <label for="password">Contraseña.</label>
            <input type="password" name="password" placeholder="Contraseña" id="password">
            <div>
                <p class="forget-password">¿Olvidaste tu contraseña?</p>
            </div>
            <div class="submit-button">
                <input class="login-button" name="btn_ingresar" type="submit" value="Iniciar Sesión">
            </div>
            <div class="div-button">
                <input class="register-button" type="button" value="Regístrate" onclick="window.location.href = 'register.php';">
            </div>

        </form>
    </section>


</body>

</html>