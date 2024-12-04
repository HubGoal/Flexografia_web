<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="images/x-icon" href="img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/style.css">
</head>
<main>

</main>

<body>
    <header>
        <?php
        include_once ('../views/tools/header.php');
        ?>
    </header>

    <main class="registro-exitoso">
        <img src="img/23.svg" alt="Logotipo" class="registro-exitoso__logo">
        <div class="registro-exitoso__mensaje">
            <p>Gracias por registrarte!</p>
        </div>
        <div class="registro-exitoso__mensaje">
            <p>En breve recibirás instrucciones a tu correo sobre cómo activar tu cuenta.</p>
        </div>
        <a href="../index.php">Volver a inicio</a>
    </main>

    <footer>
        <?php
        include_once ('../views/tools/footer.php');
        ?>
    </footer>
</body>

</html>