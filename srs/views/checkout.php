<?php
require_once '..//models/database.php';
require_once '..//models/config.php';

$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id_product, nombre, img_url FROM products WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
$total = 0;

$productos = isset ($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
#print_r($_SESSION);
//session_destroy();

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("SELECT id_product, nombre,descripcion, img_url,precio, $cantidad AS cantidad FROM products WHERE id_product= ? AND activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

// print_r($_SESSION);
// session_destroy();

//  if(empty($_SESSION["id"]) ){
//      header("location:indexcopy.php");
//  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="views/images/x-icon" href="views/img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <?php
        include_once ('../views/tools/header.php');
        ?>
    </header>
    <div class="carrito">
        <div class="contenedor">
            <table>
                <thead>
                    <tr>
                        <th colspan="8">
                            Productos
                            <hr>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lista_carrito == null) {
                        $_total = 0;
                        echo '<tr>
                                            <td colspan="4"> <b>Lista Vacia</b></td>
                                        </tr>';
                    } else {
                        $_total = 0;
                        foreach ($lista_carrito as $producto) {
                            $_id = $producto['id_product'];
                            $_nombre = $producto['nombre'];
                            $_descripcion = $producto['descripcion'];
                            $_precio = $producto['precio'];
                            $_cantidad = $producto['cantidad'];
                            $_subtotal = $_cantidad * $_precio;
                            $_total += $_subtotal;
                            $limitedDescription = (strlen($_descripcion) > 70) ? substr($_descripcion, 0, 70) . '...' : $_descripcion;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $_nombre ?>
                                </td>
                                <td style="font-size: 16px;">
                                    Cantindad: <input type="number" min="1" value="<?php echo $_cantidad; ?>" size="5"
                                        id="cantidad_<?php echo $_id; ?>"
                                        onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)"> </input>
                                </td>
                                <td style="display: none;">
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                                        <?php echo MONEDA . number_format($_subtotal, 2, '.', ','); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php echo MONEDA . number_format($_precio, 2, '.', ','); ?>
                                </td>
                                <td style="text-align: right;">
                                    <a href="#" id="eliminar" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal"
                                        data-bs-target="#eliminaModal" style="font-size: 16px;">Eliminar</a>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="font-weight: 400;">
                                    <?php echo $limitedDescription ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <hr>
                                </td>
                            </tr>


                        <?php } ?>
                    </tbody>
                <?php } ?>

            </table>
        </div>
        <div class="main_container_mobile">
            <table>
                <thead>
                    <tr>
                        <th colspan="8">
                            Productos
                            <hr>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lista_carrito == null) {
                        $_total = 0;
                        echo '<tr>
                                            <td colspan="4"> <b>Lista Vacia</b></td>
                                        </tr>';
                    } else {
                        $_total = 0;
                        foreach ($lista_carrito as $producto) {
                            $_id = $producto['id_product'];
                            $_nombre = $producto['nombre'];
                            $_descripcion = $producto['descripcion'];
                            $_precio = $producto['precio'];
                            $_cantidad = $producto['cantidad'];
                            $_subtotal = $_cantidad * $_precio;
                            $_total += $_subtotal;

                            $limitedDescription = (strlen($_descripcion) > 30) ? substr($_descripcion, 0, 30) . '...' : $_descripcion;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $_nombre ?>
                                </td>
                                <td colspan="3">
                                    <?php echo $limitedDescription; ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size: 16px;">
                                    <input type="number" min="1" value="<?php echo $_cantidad; ?>" size="5"
                                        id="cantidad_<?php echo $_id; ?>"
                                        onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)"> </input>
                                </td>
                                <td style="display:none">
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                                        <?php echo MONEDA . number_format($_subtotal, 2, '.', ','); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php echo MONEDA . number_format($_precio, 2, '.', ','); ?>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    <a href="#" id="eliminar" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal"
                                        data-bs-target="#eliminaModal" style="font-size: 16px;">Eliminar</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <hr>
                                </td>

                            </tr>


                        <?php } ?>
                    </tbody>
                <?php } ?>

            </table>
        </div>

        <div class="right_container">
            <table>
                <thead>
                    <tr>
                        <th>
                            Resumen de compra
                            <hr>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total de la compra:</td>

                    </tr>
                    <tr>

                        <td style="text-align: center; font-size: 16px;">
                            <p id=total><?php echo MONEDA . number_format($_total, 2, '.', ','); ?></p>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="1">
                            <a href="pedido_confirmado.php">
                                <form action="../controllers/confirmar_pedido.php" method="post">
                                    <!-- Contenido del carrito -->
                                    <button class="confirm-button" name="confirmar_pedido" type="submit">Confirmar
                                        pedido</button>
                                </form>

                            </a>
                        </td>
                    </tr>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="masProductos">
        <h1>Otros Productos</h1>
    </div>


    <div class="grid__container">
        <?php
        include_once ('../controllers/mostar_productos.php');
        ?>
    </div>



    <div class="modal" tabindex="-1" id="eliminaModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cuidado!!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que desea Borrar el elemento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-eliminar" type="button" class="btn btn-danger"
                        onclick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>



    <footer>
        <?php
        include_once ('..//views/tools/footer.php');
        ?>
    </footer>
</body>
<script>
    let eliminaModal = document.getElementById("eliminaModal");
    eliminaModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-eliminar')
        buttonElimina.value = id
    })

    function actualizarCantidad(cantidad, id) {
        let url = '/controllers/actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('id', id);
        formData.append('cantidad', cantidad);
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    let divsubtotal = document.getElementById('subtotal_' + id)
                    divsubtotal.innerHTML = data.sub

                    let total = 0.00
                    let lista = document.getElementsByName('subtotal[]')
                    for (let i = 0; i < lista.length; i++) {
                        total += parseFloat(lista[i].innerHTML.replace(/[$,]/g, ''))
                    }
                    total = Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2
                    }).format(total)

                    document.getElementById('total').innerHTML = '<?php echo '$'; ?>' + total

                }
            })
    }

    function eliminar() {
        let botonElimina = document.getElementById('btn-eliminar')
        let id = botonElimina.value

        let url = '/controllers/actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'eliminar');
        formData.append('id', id);

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    location.reload()


                }
            })
    }
</script>
<script src="js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>