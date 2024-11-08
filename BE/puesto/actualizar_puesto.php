<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión

$id_vendedor = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? null;
$descripcion_corta = $_POST['descripcion_corta'] ?? null;
$descripcion_larga = $_POST['descripcion_larga'] ?? null;
$imagenes = $_POST['imagenes'] ?? [];
$horarios = $_POST['horarios'] ?? [];
$contactos = $_POST['contactos'] ?? [];

// Construir la consulta de actualización dinámicamente
$updates = [];
$params = [];
$types = '';

if ($nombre) {
    $updates[] = 'nombre = ?';
    $params[] = $nombre;
    $types .= 's';
}
if ($descripcion_corta) {
    $updates[] = 'descripcion_corta = ?';
    $params[] = $descripcion_corta;
    $types .= 's';
}
if ($descripcion_larga) {
    $updates[] = 'descripcion_larga = ?';
    $params[] = $descripcion_larga;
    $types .= 's';
}

if (!empty($updates)) {
    $sql = "
    UPDATE puesto
    SET " . implode(', ', $updates) . "
    WHERE vendedor_id = ?
    ";
    $params[] = $id_vendedor;
    $types .= 'i';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "Puesto actualizado correctamente";
    } else {
        echo "Error al actualizar el puesto";
    }

    $stmt->close();
}

// Obtener el ID del puesto
$sql_puesto_id = "SELECT id FROM puesto WHERE vendedor_id = ?";
$stmt_puesto_id = $conn->prepare($sql_puesto_id);
$stmt_puesto_id->bind_param("i", $id_vendedor);
$stmt_puesto_id->execute();
$result_puesto_id = $stmt_puesto_id->get_result();
$puesto_id = $result_puesto_id->fetch_assoc()['id'];
$stmt_puesto_id->close();

// Actualizar imágenes
if (!empty($imagenes)) {
    $conn->query("DELETE FROM imagenes_puesto WHERE puesto_id = $puesto_id");
    $stmt_img = $conn->prepare("INSERT INTO imagenes_puesto (url, puesto_id) VALUES (?, ?)");
    foreach ($imagenes as $img) {
        $stmt_img->bind_param("si", $img, $puesto_id);
        $stmt_img->execute();
    }
    $stmt_img->close();
}

// Actualizar horarios
if (!empty($horarios)) {
    $conn->query("DELETE FROM horario_puesto WHERE puesto_id = $puesto_id");
    $stmt_horario = $conn->prepare("INSERT INTO horario_puesto (dia, hora_inicio, hora_fin, puesto_id) VALUES (?, ?, ?, ?)");
    foreach ($horarios as $horario) {
        $stmt_horario->bind_param("sssi", $horario['dia'], $horario['hora_inicio'], $horario['hora_fin'], $puesto_id);
        $stmt_horario->execute();
    }
    $stmt_horario->close();
}

// Actualizar métodos de contacto
if (!empty($contactos)) {
    $conn->query("DELETE FROM contacto_puesto WHERE puesto_id = $puesto_id");
    $stmt_contacto = $conn->prepare("INSERT INTO contacto_puesto (tipo, url, puesto_id) VALUES (?, ?, ?)");
    foreach ($contactos as $contacto) {
        $stmt_contacto->bind_param("ssi", $contacto['tipo'], $contacto['url'], $puesto_id);
        $stmt_contacto->execute();
    }
    $stmt_contacto->close();
}

$conn->close();
?>