<?php 
    require '..//config/database.php';
    require '..//config/config.php';
    require '..//header.php';

    if(!isset($_SESSION['user_type'])){
        header('Location: ../index.php');
        exit;
    }
    if($_SESSION['user_type'] != 'admin'){
        header('Location: ../../index.php');
        exit;
    }
    $db = new Database();
    $con= $db->conectar();

    $sql = 'SELECT * FROM pedido';
    $result = $con->query($sql);
    $pedido = $result ->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pedidos</h1>
        <div
            class="table-responsive"
        >
            <table
                class="table table-hover"
            >
                <thead>
                    <tr>
                        <th scope="col">ID pedido</th>
                        <th scope="col">ID cliente</th>
                        <th scope="col">Cantidad de articulos</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Fecha de pedido</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($pedido as $row): ?>
    <tr>
        <td><?php echo $row['id_pedido']; ?></td>
        <td><?php echo $row['id_cliente']; ?></td>
        <td><?php echo $row['cantidad']; ?></td>
        <td><?php echo $row['precio']; ?></td>
        <td><?php echo $row['fecha_pedido']; ?></td>

    </tr>
<?php endforeach; ?>
</tbody>

            </table>
        </div>
    </div>
</main>




<?php
    require_once '..//footer.php';


?>