<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión
include('../../config/vars.php');        // incluir constantes de la aplicacion

$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

// detalles de la pagina
$current_page = "Inicio";
$title = "Hola " . $_SESSION['usuario']['nombre'] . ", Bienvenid@ al Panel de Administración";
$info = "Administra tu puesto en el Tianguis del Mayab, sube tus productos y mantén tu información actualizada";

// contenido del modal del header
$modalBtnTitle = "¿Cómo funciona?";             // titulo del boton del modal
$modalTitle = "";                               // titulo del modal
$modalContent = "";                           // contenido del modal

// incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

/*

EN ESTA ZONA SE COLOCA MAS LOGIA
PUEDE SER ALGUN QUERY, ALGUNA FUNCION, ETC

*/

?>

<!-- contenido de la pagina -->

<main class="flex-shrink-0">
    <section class="py-5">

    <h1>hola</h1>

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