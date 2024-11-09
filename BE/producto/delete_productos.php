<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión

$id_vendedor = $_SESSION['usuario']['id'];
$producto_id = $_POST['producto_id'] ?? null;

if ($producto_id) {
    $sql = "
    DELETE FROM producto
    WHERE id = ? AND puesto_id = (SELECT id FROM puesto WHERE vendedor_id = ?)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $producto_id, $id_vendedor);

    if ($stmt->execute()) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto";
    }

    $stmt->close();
}

$conn->close();
?>