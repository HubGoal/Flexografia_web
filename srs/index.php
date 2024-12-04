<?php

require_once 'models/database.php';
require_once 'models/config.php';

$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id_product, nombre, img_url FROM products WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="views/images/x-icon" href="views/img/23Logo.png">
    <link rel="stylesheet" href="views\css\style.css">
</head>

<body>
    <header>
        <?php
        include_once ('views/tools/header.php');
        ?>
    </header>

    <div class="hero">
        <div class="hero__text">
            <div class="hero__description">
                <h1 class="hero__title male50">Flexografia</h1>
                <p class="hero__title__text male50">Impresiones de la mejor <span class="word">calidad</span></p>
            </div>

        </div>
        <div class="hero__img">
            <img src="views/img/flexografia_hero.png" alt="Etiquetas de Flexografia" class="hero__img--stickers
                ">
        </div>
    </div>

    <main class="contenedor">
        <h1 class="grid__title">Nuestros Productos</h1>
        <div class="grid__container">

            <?php foreach ($resultado as $row) { ?>
                <div class="product">
                    <?php
                    $id = $row['id_product'];
                    $imagen = "views/img/products/" . $id . "/principal.png";
                    if (!file_exists($imagen)) {
                        $imagen = "views/img/products/1/principal.png";
                    }
                    $title = $row["nombre"];
                    ?>
                    <a href="views/product.php?id=<?php echo $row['id_product']; ?>&token=<?php echo
                          hash_hmac('sha1', $row['id_product'], KEY_TOKEN); ?> "><img src="<?php echo $imagen; ?>" alt=""
                            class="product__img"></a>
                    <h3 class="product__title">
                        <?php echo $title; ?>
                    </h3>
                </div>
            <?php } ?>
        </div>
    </main>
    <section class="exhibidor">
        <div class="img__container">
            <img src="views/img/products/Banner.png" alt="" class="exhibidor__img">
        </div>
        <div class="exhibidor__rightside">
            <h3 class="exhibidor__title">Entrega gratis, visualizar 3D, Cotizaciones sin compromiso.</h3>
            <p class="exhibidor__description">
                ¡Descubre nuestra increíble oferta! Con nosotros, obtienes entregas gratis en todos tus pedidos, la
                oportunidad de probar nuestros productos online sin cargo alguno para tomar decisiones informadas y un
                breve tiempo de producción que garantiza que recibirás tus productos rápidamente.
            </p>
        </div>
    </section>
    <footer>
        <?php
        include_once ('views/tools/footer.php');
        ?>
    </footer>
</body>
<script src="views/js/script.js"></script>

</html>