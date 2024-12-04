<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "flexografia");
$conexion->set_charset("utf8");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id_product = $id";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
    }

    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flexografia</title>
</head>
<body>
                        <h2>Insertar nuevo producto</h2>
                    <form action="../controllers/insertar_producto.php" class="dashboard__form" method="post">
                        <label for="nombre_producto">Nombre:</label>
                        <input type="text" id="nombre_producto" name="nombre_producto">

                        <label for="precio_producto">Precio:</label>
                        <input type="text" id="precio_producto" name="precio_producto">

                        <label for="desc_producto">Descripcion:</label>
                        <textarea name="desc_producto" id="desc_producto" cols="25" rows="6"></textarea>

                        <input type="submit" value="Agregar">
                    </form>
    
</body>
</html>