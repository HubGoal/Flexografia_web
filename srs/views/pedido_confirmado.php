
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="views/images/x-icon" href="views/img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header>
        <?php
        include_once('../views/tools/header.php');
        ?>
    </header>
    <div class="pedido_confirmado">
        <h1>Su orden fue enviada!</h1>
        <img src="../views/img/greenCheck.png" alt="">
        <br>
        <a href="../index.php">Volver al inicio</a>
    </div>
    <footer>
            <?php
            include_once('../views/tools/footer.php');
            ?>
        </footer>
</body>