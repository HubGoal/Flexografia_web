<?php

require '../config/database.php';
require '../config/config.php';
require '../header.php';

if (!isset($_SESSION['user_type'])) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$sql = "SELECT id_product, nombre, descripcion, precio FROM products WHERE activo = 1";
$resultado = $con->query($sql);
$productos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <div class="container-fluid px-4">
        <h2 class="mt-2">Productos</h2>
        <a class="btn btn-primary" href="nuevo.php">Agregar</a>
        <table class="table table-hover my-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){ ?>
                    <tr>
                        <td><?php echo $producto['id_product']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <td><?php echo $producto['precio']; ?></td>

                        <td>
                            <a href="edita.php?id=<?php echo $producto['id_product']?>" class="btn btn-warning 
                            btn-sm">Editar</a>
                        </td>
                        <td><?php echo $producto['id_product']; ?></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</main>
