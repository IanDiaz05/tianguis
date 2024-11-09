<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión

$id_vendedor = $_SESSION['usuario']['id'];
$producto_id = $_POST['producto_id'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$img = $_POST['img'] ?? null;
$precio = $_POST['precio'] ?? null;

// Construir la consulta de actualización dinámicamente
$updates = [];
$params = [];
$types = '';

if ($nombre) {
    $updates[] = 'nombre = ?';
    $params[] = $nombre;
    $types .= 's';
}
if ($descripcion) {
    $updates[] = 'descripcion = ?';
    $params[] = $descripcion;
    $types .= 's';
}
if ($img) {
    $updates[] = 'img = ?';
    $params[] = $img;
    $types .= 's';
}
if ($precio) {
    $updates[] = 'precio = ?';
    $params[] = $precio;
    $types .= 'd';
}

if (!empty($updates)) {
    $sql = "
    UPDATE producto
    SET " . implode(', ', $updates) . "
    WHERE id = ? AND puesto_id = (SELECT id FROM puesto WHERE vendedor_id = ?)
    ";
    $params[] = $producto_id;
    $params[] = $id_vendedor;
    $types .= 'ii';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "Producto actualizado correctamente";
    } else {
        echo "Error al actualizar el producto";
    }

    $stmt->close();
}

$conn->close();
?>