<?php
require_once '..\\models\config.php';
$db = new Database();
$con = $db->conectar();

$id = isset ($_GET['id']) ? $_GET['id'] : '';
$token = isset ($_GET['token']) ? $_GET['token'] : '';
if ($id == '' || $token == '') {
    echo 'Error al procesar la peticion';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
    if ($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id_product) FROM products WHERE id_product=? AND activo =1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) {
            $sql = $con->prepare("SELECT nombre,descripcion,img_url FROM products WHERE id_product=? AND activo=1 ");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $titulo = $row['nombre'];
            $descripcion = $row['descripcion'];
            $dir_images = '..//views/img/products/' . $id . '/';

            $img_url = $row['img_url'];
            $rutaImg = $dir_images . 'principal.png';
            if (!file_exists($rutaImg)) {
                $rutaImg = '..//views/img/noImageSelected.jpg';
            }
            $imagenes = array();
            $dir = dir($dir_images);
            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                    $imagenes = $dir_images . $archivo;
                }
            }
            $dir->close();
        }
    } else {
        echo 'Error al procesar la peticion';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="images/x-icon" href="img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/style.css">
</head>

<body>
    <header>
        <?php
        include_once ('../views/tools/header.php');
        ?>
    </header>

    <main class="contenedor">
        <div class="pasos_container">
            <div class="pasos_container_steps">
                <ul>
                    <li class="step active">Paso 1</li>
                    <li class="step">Paso 2</li>
                    <li class="step">Paso 3</li>
                    <li class="step">Paso 4</li>
                </ul>
            </div>
        </div>

        <div class="main__product contenedor">
            <div class="main__product__info">
                <div>
                    <h1 class="main__product__title">
                        <?php echo $titulo ?>
                    </h1>
                    <p class="main__product__description">
                        <?php echo $descripcion ?>
                    </p>
                </div>
                <img src="<?php echo $rutaImg; ?>">
                <!-- <img src="..//views/img/products/stickerPreview.png" alt="" class="product__img"> -->
                <!--Si se quiere hacer cambiar la imagen por una dinamica agregar un echo
                    dentro del src con la variable rutaImg, ya funciona    
            -->
            </div>

            <div id="overlay" class="overlay">
                <div class="overlay-content">
                    <p id="overlay-message"></p>
                    <button id="overlay-button">Aceptar</button>
                </div>
            </div>


            <div class="main__product__options">
                <div class="pasos_container">
                    <form action="" method="">
                        <div class="form-one step-form active">
                            <p>Tamaño</p>
                            <div>
                                <!-- <form action="size-select" method="post"> -->
                                <select name="size-select" id="size-select" onchange="getSize()">
                                    <option value="none" disabled>Selecciona una opcion</option>
                                    <option value="25x25">25mm x 25mm</option>
                                    <option value="50x50">50mm x 50mm</option>
                                    <option value="75x75">75mm x 75mm</option>
                                    <option value="100x100">100mm x 100mm</option>
                                </select>
                                <!-- </form> -->
                            </div>

                        </div>
                        <div class="form-two step-form">
                            <p>Cantidad</p>
                            <div>
                                <!-- <form action="" class="size-select" method="post"> -->
                                <select name="quantity-select" id="quantity-select" onchange=getCantidad()>
                                    <option value="none" disabled>Selecciona una opcion</option>
                                    <option value="50">50 piezas</option>
                                    <option value="100">100 piezas</option>
                                    <option value="200">200 piezas</option>
                                    <option value="300">300 piezas</option>
                                    <option value="1000">1,000 piezas</option>
                                    <option value="2000">2,000 piezas</option>
                                    <option value="3000">3,000 piezas</option>
                                    <option value="4000">4,000 piezas</option>
                                    <option value="5000">5,000 piezas</option>
                                </select>
                                <!-- </form> -->

                            </div>
                        </div>
                        <div class="form-three step-form">
                            <p>Sube tu archivo</p>
                            <div>
                                <label for="fileInput" class="input__label">
                                    <img src="img/products/subida.png" alt="Seleccionar Archivo">
                                </label>
                                <!-- Input file oculto -->
                                <input type="file" id="fileInput" accept="image/*"
                                    onchange="previewImage(event, '#user_preview')">
                            </div>
                        </div>
                        <div class="form-four step-form">
                            <p>Confirmar selecciones</p>
                            <div class="confirmacion">
                                <div>
                                    <div class="confirmacion__labels-objects">
                                        <p>Tamaño:</p>
                                        <label id="size__label-show">N/A</label>
                                    </div>

                                    <div class="confirmacion__labels-objects">
                                        <p>Cantidad:</p>
                                        <label id="quantity__label-show">N/A</label>
                                    </div>

                                    <p>Vista previa:</p>
                                    <img class="" id="user_preview">
                                    <a href="3Dvisualizer.php" target="_blank">
                                        <input type="button" value="Previsualizar 3D" href="3Dvisualizer.php"
                                            class="DvisualButton">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="asdasd">
                    <button class="extra__button" id="addcartButton" disabled
                        onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp ?>',ammount,size)">
                        Añadir al carrito
                    </button>

                    <button class="primary__button" id="nextButton">
                        Siguiente
                    </button>

                    <button class="secondary__button" id="backButton" disabled>
                        Atras
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div class="contenedor">
        <h1 class="grid__title">Otros Productos</h1>
        <div class="grid__container">
            <?php
            include_once ('..\\controllers\mostar_productos.php');
            ?>
        </div>
    </div>
    <footer>
        <?php
        include_once ('../views/tools/footer.php');
        ?>
    </footer>
</body>
<script src="js/script.js"></script>
<script src="js/product.js"></script>
<script>
    function addProducto(id, token, cantidad, tamano) {
        let url = '/controllers/carrito.php';
        let formData = new FormData();
        formData.append('id', id)
        formData.append('token', token)
        formData.append('cantidad', cantidad)
        formData.append('tamano', tamano)
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    console.log("clickeo")
                    let elemento = document.getElementById("num_cart");
                    elemento.innerHTML = data.numero;
                }
            })

    }

    let ammount = 0
    let size = ""
    function getCantidad() {
        var e = document.getElementById("quantity-select")
        if (e.value > 1) {
            ammount = e.value
        } else {
            console.log("No selecciono nada")
        }
    }
    function getSize() {
        let e = document.getElementById("size-select")
        size = e.value
        console.log(size)
    }
</script>

</html>