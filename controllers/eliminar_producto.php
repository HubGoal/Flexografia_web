<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "flexografia");
$conexion->set_charset("utf8");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id_product = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../views/dashboard.php");
    } else {
        echo "Error al eliminar el producto: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
