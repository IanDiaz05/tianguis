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

// contenido del modal del header
$modalBtnTitle = "¿Cómo funciona?";
$modalTitle = "Panel de Administración";
$modalContent = "En esta sección podrás administrar tu puesto en el Tianguis del Mayab, subir tus productos y mantener tu información actualizada.";

// incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

// verificar si el usuario tiene un puesto registrado
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
        $puesto_existe = 1;
        $_SESSION['puesto'] = [                    // guardar los datos del puesto en la sesión
            'id' => $puesto['id'],
            'nombre' => $puesto['nombre'],
            'descripcion_corta' => $puesto['descripcion_corta'],
            'descripcion_larga' => $puesto['descripcion_larga'],
            'vendedor_id' => $puesto['vendedor_id']
        ];
    } else {                                                        // si el puesto no existe
        $puesto_existe = 0;
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Error al ejecutar la consulta";
}
mysqli_close($conn);
?>

<!-- contenido de la pagina -->

<main class="flex-shrink-0">
        <section class="py-5" id="features">

        <?php if ($puesto_existe == 1) { ?>
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">Gestiona los servicios de manera sencilla.</h2></div>
                    <div class="col-lg-8">
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <a href="../solicitado/" style="text-decoration: none; color: inherit;"><div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-list-check"></i></div></a>
                                <h2 class="h5">Servicios Solicitados</h2>
                                <p class="mb-0">Lleva un control de los servicios que se acaban de solicitar, asigna un chofer y confirma que se haya efectuado el pago</p>
                            </div>
                            <div class="col mb-5 h-100">
                                <a href="../en_proceso/" style="text-decoration: none; color: inherit;"><div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-hourglass-split"></i></div></a>
                                <h2 class="h5">Servicios en Proceso</h2>
                                <p class="mb-0">Debes administrar y marcar todos los servicios que se han completado para finalizar el proceso y contarlo como venta</p>
                            </div>
                            <div class="col mb-5 mb-md-0 h-100">
                                <a href="../clientes/" style="text-decoration: none; color: inherit;"><div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-vcard"></i></div></a>
                                <h2 class="h5">Clientes</h2>
                                <p class="mb-0">Datos basicos de todos los clientes registrados</p>
                            </div>
                            <!-- <div class="col h-100">
                                <a href="../ventasTotales/" style="text-decoration: none; color: inherit;"><div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-clipboard2-check-fill"></i></div></a>
                                <h2 class="h5">Ventas Totales</h2>
                                <p class="mb-0">En este apartado podras ver y exportar en un archivo Excel todos los servicios que se han completado, asi como todos sus detalles</p>   -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {?>

            <div class="container px-5 my-5">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">¡Espera, aún no tienes un puesto registrado!</h4>
                    <p>Para comenzar a vender en el Tianguis del Mayab, necesitas registrar tu puesto.</p>
                    <hr>
                    <p class="mb-0">Haz clic en el botón para registrar tu puesto.</p>
                    <a href="../registrar_puesto/" class="btn btn-primary mt-3">Registrar Puesto</a>
                </div>
            </div>
        <?php } ?>

        </section>
        
</main>


<?php
include($templateDetails['footer']);
include($templateDetails['end']);

// mensajes
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '")</script>';
    unset($_SESSION['message']);
}
?>