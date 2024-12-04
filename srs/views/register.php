<?php 
    require_once '..//models/config.php';
    require_once '..//controllers/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)){

    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if(esNulo([$nombre, $email, $password, $repassword])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!esMail($email)){
        $errors[] = "La dirección de correo no es válida";
    }

    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }

    if(emailExiste($email, $con)){
        $errors[] = "El correo electrónico $email ya está en uso";   
    }

    if(count($errors) == 0) {

        $id=registrar([$nombre, $email],$con);

        if ($id>0){
            require_once "..//controllers/mailer.php";
            $mailer =  new Mailer();
            $token = generarToken();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $idUsuario = registraUsuario([$email,$pass_hash,$token,$id],$con);
                if($idUsuario > 0){
                    $url = SITE_URL.'activar_cliente.php?id='.$idUsuario.'&token='.$token;  
                    $asunto = "Activar Cuenta Flexografia 23";
                    $cuerpo = "Estimado $nombre: para continuar con el registro es necesario activar su cuenta en el siguiente link: <a href='$url'>Activar Cuenta</a>";

                    if($mailer->enviarEmail($email, $asunto, $cuerpo)){
                        header("Location:registro_exitoso.php");
                        // echo "Para terminar el proceso de registro siga las instrucciones que le enviamos a la direccion de correo $email";
                        exit;
                    }
                }else {
                    $errors[] = 'Error al registrar usuario';
                }
            }else{
            $errors[] = 'Error al registrar cliente';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit%3A200%2C300%2C400%2C500%2C600%2C800"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A200%2C300%2C400%2C500%2C600%2C800"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A400"/>
    <link rel="stylesheet" href="..//views/css/register.css">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
<section class="left__form">
    </section>

    <section class="right__form">
        <form action="register.php" method="post">
            <div class="logo__text">
                <a href="..//index.php">
                    <img src="img/23LogoText.png" alt="">
                </a>
            </div>
            <h1>Bienvenido!</h1>
            <p>Ingrese los siguientes datos.</p>
            <?php mostrarMensajes($errors) ?>

            <label for="nombre"><span class="text-danger">*</span>Ingresa tu nombre.</label>
            <input type="text" class="box" placeholder="Nombre" name="nombre" id="nombre" required>
            <label for="email"><span class="text-danger">*</span>Correo.</label>
            <input type="email" class="box" placeholder="Email" name="email" id="email" required>
            <span id="validaEmail" class="text-danger"></span>
            <label for="password"><span class="text-danger">*</span>Contraseña.</label>
            <input type="password" class="box" placeholder="Contraseña" name="password" id="password" required>
            <label for="repassword"><span class="text-danger">*</span>Confirmar Contraseña.</label>
            <input type="password" class="box" placeholder="Contraseña" name="repassword" id="repassword" required>
            <div class="submit-button">
                <button type="submit" class="register-button">Registrate</button>
            </div>
            <div class="div-button">
                <input class="login-button" type="button" value="Inicia sesion" onclick="window.location.href = 'login.php';">
            </div>
        </form>
    </section>

</body>
<script>
        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function(){
            existeEmail(txtEmail.value)
        }, false)
        
        function existeEmail(email){
            let url = "..//controllers/clienteAjax.php"
            let formData = new FormData ()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => { //data trae la respuesta pero sin procesar, se procesa en cliente ajax
 
                if(data.ok){
                    document.getElementById('email').value = ''
                    document.getElementById('validaEmail').innerHTML = 'Correo no disponible'
                } else {
                    document.getElementById('validaEmail').innerHTML = ''
                }
            })
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>