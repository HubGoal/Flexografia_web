<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "flexografia");
$conexion->set_charset("utf8");

$id = null;
$nombre = $_POST['nombre_producto'];
$precio = $_POST['precio_producto'];
$desc = $_POST['desc_producto'];

$sql = "INSERT INTO products (id_product, nombre, descripcion, precio) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("issd", $id, $nombre, $desc, $precio);

if ($stmt->execute()) {
    header("Location: ../views/dashboard.php");
} else {
    echo "Error al insertar el producto: " . $stmt->error;
}
$stmt->close();
$conexion->close();
?>
