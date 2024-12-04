<?php
require_once '../models/config.php';

if (isset($_POST['confirmar_pedido'])) {
    if (isset($_SESSION['carrito']['productos'])) {
        $id_cliente = $_SESSION['id_cliente']; // Obtener el ID del cliente de la sesión
        $fecha_pedido = date('Y-m-d H:i:s');
        foreach ($_SESSION['carrito']['productos'] as $id_producto => $cantidad) {
            $sql = "SELECT precio FROM products WHERE id_product = :id_producto AND activo = 1";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $precio = $row['precio'];

            $sql = "INSERT INTO pedido (id_cliente, id_producto, cantidad, precio, fecha_pedido) VALUES (:id_cliente, :id_producto, :cantidad, :precio, :fecha_pedido)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_cliente', $_SESSION['user_id']);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':fecha_pedido', $fecha_pedido);
            $stmt->execute();
        }

        // Eliminar productos del carrito
        unset($_SESSION['carrito']['productos']);

        // Redirigir a una página de confirmación
        header('Location: ../views/pedido_confirmado.php');
        exit();
    } else {
        // No hay productos en el carrito
        echo "No hay productos en el carrito";
    }
} else {
    // El formulario no fue enviado correctamente
    echo "Error al confirmar el pedido";
}
?>
