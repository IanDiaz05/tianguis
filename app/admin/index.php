<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión
include('../../config/vars.php');        // incluir constantes de la aplicacion

$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

// detalles de la pagina
$current_page = "Inicio";
$title = "Hola " . $_SESSION['usuario']['nombre'] . ", Bienvenid@ al Panel de Administración";
$info = "Administra tu puesto en el Tianguis Estudiantil, sube tus productos y mantén tu información actualizada";

// contenido del modal del header
$modalBtnTitle = "¿Cómo funciona?";
$modalTitle = "Panel de Administración";
$modalContent = "
<p>En esta sección, puedes gestionar toda la información de tu puesto y de tus productos para optimizar su visibilidad en el Tianguis Estudiantil.</p>
<ul>
    <li><strong>Mi Puesto</strong>: Aquí puedes actualizar la información de tu negocio, como el nombre, descripciones, horarios de atención, y enlaces de contacto (WhatsApp, redes sociales, correo, etc.). Esto permite a tus clientes saber cuándo y cómo pueden contactarte para conocer más sobre tus productos.</li>
    <li><strong>Mis Productos</strong>: Agrega, modifica o elimina productos de tu inventario. Puedes actualizar el nombre, la descripción, el precio y agregar imágenes de cada artículo.</li>
</ul>
<p>Usa nuestro enlace a la guía de imágenes para aprender a alojarlas externamente en plataformas como PostImage, asegurando que tus productos tengan una presentación visual atractiva.</p>
";

// verificar si el usuario tiene un puesto registrado
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

        // detalles de la pagina
        $current_page = $puesto['nombre'];
        $title = "Hola " . $_SESSION['usuario']['nombre'] . ", Bienvenid@ al Panel de " . $puesto['nombre'];

        $_SESSION['puesto'] = [                    // guardar los datos del puesto en la sesión
            'id' => $puesto['id'],
            'nombre' => $puesto['nombre'],
            'descripcion_corta' => $puesto['descripcion_corta'],
            'descripcion_larga' => $puesto['descripcion_larga'],
            'vendedor_id' => $puesto['vendedor_id']
        ];
    } else {                                                        // si el puesto no existe
        $puesto_existe = 0;

        // detalles de la pagina
        $current_page = "Administrar Puesto";
        $title = "Hola " . $_SESSION['usuario']['nombre'] . ", Bienvenid@ al Panel de Administración";
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Error al ejecutar la consulta";
}
mysqli_close($conn);


// incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

?>

<!-- contenido de la pagina -->

<main class="flex-shrink-0">
        <section class="py-5" id="features">

        <?php if ($puesto_existe == 1) { ?>
            
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h2 class="fw-bolder mb-0">Administra tu puesto de manera sencilla.</h2>
                        <!-- link para cerrar la sesion -->
                        <a href="../../BE/admin/logout.php" class="btn btn-secondary mt-3">Cerrar Sesión</a>
                        <!-- link a la guia de subir imagenes -->
                        <a href="https://github.com/IanDiaz05/tianguis/wiki/Subir-Im%C3%A1genes-al-Panel-%7C-Gu%C3%ADa" target="_blank" class="btn btn-link mt-3">¿Cómo subir imágenes?</a>
                    </div>
                    <!-- seccion de botones -->
                    <div class="col-lg-8">
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <a href="puesto.php"><div class="feature bg-custom-primary text-white rounded-3 mb-3"><i class="bi bi-shop-window"></i></div></a>
                                <h2 class="h5">Mi Puesto</h2>
                                <p class="mb-0">Administra y actualiza toda la información de tu puesto, así como el horario en el que puedes atender a los clientes.</p>
                            </div>
                            <div class="col mb-5 h-100">
                                <a href="productos.php"><div class="feature bg-custom-primary text-white rounded-3 mb-3"><i class="bi bi-basket"></i></div></a>
                                <h2 class="h5">Mis Productos</h2>
                                <p class="mb-0">Sube y administra todos tus productos, actualiza su descripción, precio y sube una imagen llamativa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php } else {?>

            <div class="container px-5 my-5">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">¡Espera, aún no tienes un puesto registrado!</h4>
                    <p>Para comenzar a vender en el Tianguis Estudiantil, necesitas registrar tu puesto.</p>
                    <hr>
                    <form id="registroPuestoForm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Puesto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_corta" class="form-label">Descripción Corta</label>
                            <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_larga" class="form-label">Descripción Larga</label>
                            <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Registrar Puesto</button>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="/tianguis/BE/admin/registro_puesto.js"></script>
            </div>

        <?php } ?>

        </section>
        
</main>


<?php
include($templateDetails['footer']);
include($templateDetails['end']);
?>