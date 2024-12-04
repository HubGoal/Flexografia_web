<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "flexografia");
$conexion->set_charset("utf8");

$sql = "SELECT * FROM pedido";
$result = $conexion->query($sql);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad - Pedidos</title>
    <link rel="icon" type="../views/images/x-icon" href="../../views/img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/style.css">
</head>

<body>
    <header>
        <?php
            include_once('../views/tools/header.php');
        ?>
    </header>
    <main class="dashboard__maincontainer">
    <div>
        <h2>Pedidos</h2>
        <div class="dashboard__grid-container">
            <div class="dashboard__right-column">
                <h2>Pedidos registrados</h2>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>id_pedido</th>
                                <th>id_cliente</th>
                                <th>cantidad</th>
                                <th>precio</th>
                                <th>fecha_pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id_pedido"] . "</td>";
                                echo "<td>" . $row["id_cliente"] . "</td>";
                                echo "<td>" . $row["cantidad"] . "</td>";
                                echo "<td>" . $row["precio"] . "</td>";
                                echo "<td>" . $row["fecha_pedido"] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
        <?php
        include_once ('..//views/tools/footer.php');
        ?>
    </footer>
</body>
<script src="../../views/js/script.js"></script>
</html>
