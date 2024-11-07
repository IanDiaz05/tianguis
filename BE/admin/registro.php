<?php
session_start();
include('../../config/connection.php');
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST['password'];

if (!$nombre || !$apellido || !$email || !$telefono || !$password) {
    $_SESSION['message'] = "Por favor, completa los campos que hacen falta";
    header("Location: /tianguis/app/admin/registro.php");
    die();
}

// Check if email and phone number already exist
$query = "SELECT * FROM vendedor WHERE email = ? OR telefono = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $email, $telefono);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['message'] = "Ya existe un usuario registrado con estos datos";
    header("Location: /tianguis/app/admin/registro.php");
    die();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);  // contrasena protegida

$query = "INSERT INTO vendedor (nombre, apellido, email, telefono, password) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $telefono, $hashed_password);
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['message'] = $nombre .", te has registrado correctamente";
    header("Location: /tianguis/app/admin/login.php");
    mysqli_close($conn);
    die();
} else {
    $_SESSION['message'] = "Error al registrar usuario";
    header("Location: /tianguis/app/admin/registro.php");
    mysqli_close($conn);
    die();
}

mysqli_close($conn);
?>