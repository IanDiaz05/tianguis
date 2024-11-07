<?php
session_start();
// incluir constantes de la aplicacion
include('../../config/vars.php');
$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

// detalles de la pagina
$current_page = "Inicio";
$title = "Hola, " . $_SESSION['usuario']['nombre'] . " Bienvenid@ al Panel de Administración";
$info = "Administra tu puesto en el Tianguis del Mayab, sube tus productos y mantén tu información actualizada";

// conteindo del modal del header
$modalBtnTitle = "¿Cómo funciona?";
$modalTitle = "Panel de Administración";
$modalContent = "En esta sección podrás administrar tu puesto en el Tianguis del Mayab, subir tus productos y mantener tu información actualizada.";

//incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

?>

<!-- verificar si existe un puesto de este vendedor -->
<?php
include('../../config/connection.php'); // incluir archivo de conexión
$query = "
SELECT p.*
FROM puesto p
WHERE p.vendedor_id = ?
";
$stmt = mysqli_prepare($conn, $query);      // preparar la consulta
mysqli_stmt_bind_param($stmt, "i", $_SESSION['usuario']['id']);

if (mysqli_stmt_execute($stmt)) {                                       // ejecutar la consulta
    $result = mysqli_stmt_get_result($stmt);                       // obtener el resultado
    $puesto = mysqli_fetch_assoc($result);                       // guardar los resultados en array $puesto

    if ($puesto) {                                 // si el puesto existe
        $_SESSION['puesto'] = [                    // guardar los datos del puesto en la sesión
            'id' => $puesto['id'],
            'nombre' => $puesto['nombre'],
            'descripcion_corta' => $puesto['descripcion_corta'],
            'descripcion_larga' => $puesto['descripcion_larga'],
            'vendedor_id' => $puesto['vendedor_id']
        ];
    } else {                                                        // si el puesto no existe
        $_SESSION['message'] = "No tienes un puesto registrado";        // mensaje de error
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Error al ejecutar la consulta";
}
?>





<?php
include($templateDetails['footer']);
include($templateDetails['end']);
// mensajes
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '")</script>';
    unset($_SESSION['message']);
}
?>