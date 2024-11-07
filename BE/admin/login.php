<?php
session_start();
include('../../config/connection.php');

// Verificar conexión a la base de datos
if (!$conn) {
    $_SESSION['message'] = "Error de conexión a la base de datos";
    header("Location: /tianguis/app/admin/login.php");
    die();
}

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
if (!$email || !$password) {
    $_SESSION['message'] = "Por favor, completa todos los campos";
    header("Location: /tianguis/app/admin/login.php");
    die();
}

// Sanitize email and password
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

$query = "
SELECT v.*
FROM vendedor v
WHERE email = ?
";
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    $_SESSION['message'] = "Error al preparar la consulta";
    header("Location: /tianguis/app/admin/login.php");
    die();
}

mysqli_stmt_bind_param($stmt, "s", $email);
if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID
        session_regenerate_id(true);
        // Store user data in session array
        $_SESSION['usuario'] = [
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'apellido' => $user['apellido'],
            'email' => $user['email'],
            'telefono' => $user['telefono'],
            'id_puesto' => $user['id_puesto'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'LAST_ACTIVITY' => time()
        ];
        $_SESSION['message'] = "Bienvenido, " . $_SESSION['usuario']['nombre'];
        header("Location: /tianguis/app/admin/panel.php");
    } else {
        $_SESSION['message'] = "Email o Contraseña incorrectos";
        header("Location: /tianguis/app/admin/login.php");
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Error al ejecutar la consulta";
    header("Location: /tianguis/app/admin/login.php");
}
mysqli_close($conn);
?>  