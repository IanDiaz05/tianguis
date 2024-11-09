<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión

$id_vendedor = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$img = $_POST['img'] ?? null;
$precio = $_POST['precio'] ?? null;

if ($nombre && $descripcion && $img && $precio) {
    $sql = "
    INSERT INTO producto (nombre, descripcion, img, precio, puesto_id)
    VALUES (?, ?, ?, ?, (SELECT id FROM puesto WHERE vendedor_id = ?))
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssdi', $nombre, $descripcion, $img, $precio, $id_vendedor);

    if ($stmt->execute()) {
        echo "Producto agregado correctamente";
    } else {
        echo "Error al agregar el producto";
    }

    $stmt->close();
}

$conn->close();
?>