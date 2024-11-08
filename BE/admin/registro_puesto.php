<?php
session_start();
include('../../config/connection.php'); // incluir archivo de conexión

$id_vendedor = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'];
$descripcion_corta = $_POST['descripcion_corta'];
$descripcion_larga = $_POST['descripcion_larga'];

// Insertar los datos del nuevo puesto
$sql = "INSERT INTO puesto (nombre, descripcion_corta, descripcion_larga, vendedor_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nombre, $descripcion_corta, $descripcion_larga, $id_vendedor);

if ($stmt->execute()) {
    echo "Puesto registrado correctamente";
} else {
    http_response_code(500);
    echo "Error al registrar el puesto";
}

$stmt->close();
$conn->close();
?>