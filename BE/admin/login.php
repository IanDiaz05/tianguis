<?php
session_start();
include('../../config/connection.php');

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
if (!$email || !$password) {
    $_SESSION['message'] = "Por favor, completa todos los campos";
    header("Location: /tianguis/app/admin/login.php");
    die();
}

// Sanitize email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

$query = "
SELECT v.*
FROM vendedor v
WHERE v.email = ?
";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);

if (mysqli_stmt_execute($stmt)) {                                       // ejecutar la consulta
    $result = mysqli_stmt_get_result($stmt);                       // obtener el resultado
    $user = mysqli_fetch_assoc($result);                       // guardar los resultados en array $usuario

    if ($user && password_verify($password, $user['password'])) {   // si la contraseña coincide con la de la BD
        // Regenerate session ID
        session_regenerate_id(true);

        $_SESSION['usuario'] = [                    // guardar los datos del usuario en la sesión
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'apellido' => $user['apellido'],
            'email' => $user['email'],
            'telefono' => $user['telefono'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'LAST_ACTIVITY' => time()
        ];

        header("Location: /tianguis/app/admin/");   // redirigir a la página de inicio

    } else {                                                        // si las contraseñas no coinciden
        $_SESSION['message'] = "Email o Contraseña incorrectos ";        // mensaje de error
        header("Location: /tianguis/app/admin/login.php");          // redirigir a la página de login
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Error al ejecutar la consulta";
    header("Location: /tianguis/app/admin/login.php");
}
mysqli_close($conn);
?>  