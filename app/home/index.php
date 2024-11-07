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

    // Obtener los datos de los puestos
    $sql = "
    SELECT
    p.*, img.url AS img
    FROM puesto p
    JOIN imagenes_puesto img ON p.id = img.id
    ";
    $result = $conn->query($sql);

    ?>


<!-- Cards section-->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <?php
            if ($result->num_rows > 0) {
                while($dato = $result->fetch_assoc()) {
                    echo '<div class="col-lg-4 mb-5">';
                    echo '<div class="card h-100">';
                    echo '<img src="'. $dato["img"] .'" class="card-img-top fixed-size-img" alt="Imagen de ' . $dato["nombre"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $dato["nombre"] . '</h5>';
                    echo '<p class="card-text">' . $dato["descripcion_corta"] . '</p>';
                    echo '<a href="detalle_puesto.php?id='.$dato["id"].'" class="btn btn-primary">Visitar Puesto</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay puestos disponibles.</p>';
            }
            $conn->close();
            ?>
        </div>

        <style>
            .fixed-size-img {
                height: 28vh;
                object-fit: cover;
            }
        </style>
    </div>
</section>

<?php 
include($templateDetails['footer']);
include($templateDetails['end']);
?>