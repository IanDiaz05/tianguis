<?php
session_start();

// Función para redirigir al login
function redirectToLogin() {
    header("Location: /tianguis/app/admin/login.php");
    exit();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    redirectToLogin();
}

// Verificar si la IP es la misma
if ($_SESSION['usuario']['ip'] != $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    redirectToLogin();
}

// Verificar si la sesión ha expirado
if (isset($_SESSION['usuario']['LAST_ACTIVITY']) && (time() - $_SESSION['usuario']['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    redirectToLogin();
}

// Actualizar el tiempo de la última actividad
$_SESSION['usuario']['LAST_ACTIVITY'] = time();
?>