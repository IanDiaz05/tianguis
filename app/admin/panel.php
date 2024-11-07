<?php
    // incluir constantes de la aplicacion
    include('../../config/vars.php');
    $sources = getSourcesVars();
    $templateDetails = getTemplatesVars();

    // detalles de la pagina
    $current_page = "Inicio";
    $title = "Hola, Bienvenid@ al Tianguis del Mayab";
    $info = "Descubre, Conecta y Apoya a los Emprendedores Universitarios";

    // conteindo del modal del header
    $modalBtnTitle = "¿Cómo funciona?";
    $modalTitle = "¡Tu visita hace la diferencia!";
    $modalContent = '
    <p>¡Hola! Bienvenid@ a nuestro sitio web. En el Tianguis del Mayab, nos esforzamos por conectar a los emprendedores universitarios con la comunidad, para que puedan dar a conocer sus productos y servicios.</p>
    <p>Aquí podrás conocer los increíbles productos que ofrecen nuestros estudiantes en el Tianguis del Mayab, un espacio lleno de creatividad y talento. Explora los puestos, descubre una variedad de artículos únicos, desde deliciosos platillos hasta artesanías y accesorios, ¡y entérate de cuándo y dónde encontrar a tus favoritos!</p>
    <p>Si tienes alguna duda o sugerencia, no dudes en contactarnos. ¡Gracias por tu visita!</p>
    ';

    //incluir contenido de la pagina (plantillas)
    include($templateDetails['top']);
    include($templateDetails['navbar']);
    include($templateDetails['header']);

    // Conectar a la base de datos
    include('../../config/connection.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del puesto
    $id_puesto = $_SESSION['usuario']['id_puesto'];
    $sql = "
    SELECT * FROM puesto WHERE id = ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_puesto);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

?>

<!-- HTML DE LA SECCION -->
<h1> sexo</h1>
<p>estos son los detalles del puesto:</p>
<?php
    // Mostrar los datos del puesto
    if (mysqli_num_rows($result) > 0) {
        $puesto = mysqli_fetch_assoc($result);
        echo "<p>Nombre del puesto: " . $puesto['nombre'] . "</p>";
        echo "<p>Descripción corta: " . $puesto['descripcion_corta'] . "</p>";
        echo "<p>Descripcion larga: " . $puesto['descripcion_larga'] . "</p>";
    } else {
        echo "<p>No se encontraron datos del puesto</p>";
    }
?>

<?php
// mensajes
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '")</script>';
    unset($_SESSION['message']);
}
include($templateDetails['footer']);
include($templateDetails['end']);
?>