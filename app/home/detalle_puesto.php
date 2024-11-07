<?php
    // incluir constantes de la aplicacion
    include('../../config/vars.php');
    $sources = getSourcesVars();
    $templateDetails = getTemplatesVars();

    // Conectar a la base de datos
    include('../../config/connection.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del puesto
    $sql = "
    SELECT
    p.*, img.url AS img
    FROM puesto p
    JOIN imagenes_puesto img ON p.id = img.id
    WHERE p.id = ".$_GET['id']."
    ";
    $result = $conn->query($sql);
    $datos = $result->fetch_assoc();

    // detalles de la pagina
    $current_page = $datos["nombre"];
    $title = "Bienvenid@ a " . $datos["nombre"];
    $info = $datos["descripcion_corta"];

    // conteindo del modal del header
    $modalBtnTitle = "¿Cómo Comprar?";
    $modalTitle = "¡Tu visita hace la diferencia!";
    $modalContent = '
    <p>Este sitio web es una plataforma informativa para publicitar los productos y puestos disponibles en el Tianguis del Mayab. Si estás interesado en adquirir algún producto, visita el tianguis ubicado en el estacionamiento de nuestra universidad los días martes y jueves, o comunícate directamente con el vendedor. Toda la información de contacto de cada puesto está disponible en esta página.</p>
    <p>¡Apoya a nuestros emprendedores universitarios!</p>
    ';

    //incluir contenido de la pagina (plantillas)
    include($templateDetails['top']);
    include($templateDetails['navbar']);
    include($templateDetails['header']);

    ?>


<!-- Detalles del puesto -->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-8 mb-5">
                <!-- Carrusel de img del puesto -->
                <div class="card h-100">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php
                            $sql_imagenes = "SELECT url FROM imagenes_puesto WHERE puesto_id = " . $_GET['id'];
                            $result_imagenes = $conn->query($sql_imagenes);
                            $active = 'active';
                            $index = 0;
                            while($imagen = $result_imagenes->fetch_assoc()) {
                                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($index + 1) . '"></button>';
                                $active = '';
                                $index++;
                            }
                            ?>
                        </div>
                        <div class="carousel-inner">
                            <?php
                            $result_imagenes->data_seek(0); // Reset result set pointer
                            $active = 'active';
                            while($imagen = $result_imagenes->fetch_assoc()) {
                                echo '<div class="carousel-item ' . $active . '">';
                                echo '<img src="' . $imagen['url'] . '" class="d-block w-100 fixed-size-puesto" alt="Imagen del puesto">';
                                echo '</div>';
                                $active = '';
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $datos['nombre']; ?></h5>
                        <p class="card-text"><?php echo $datos['descripcion_larga']; ?></p>
                    </div>
                </div>
            </div>
            
            <!-- mantener tamano de imagenes de puesto -->
            <style>
                .fixed-size-puesto {
                    height: 45vh; /* Ajusta la altura según tus necesidades */
                    object-fit: cover;
                }
            </style>

            <!-- Detalles de contacto -->
            <div class="col-lg-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                    <!-- codigo para recuperar los horarios del puesto -->
                    <h5>Horario de Venta:</h5>
                    <?php
                    $sql_horarios = "SELECT dia, TIME_FORMAT(hora_inicio, '%H:%i') AS hora_inicio, TIME_FORMAT(hora_fin, '%H:%i') AS hora_fin FROM horario_puesto WHERE puesto_id = " . $_GET['id'];
                    $result_horarios = $conn->query($sql_horarios);
                    if ($result_horarios->num_rows > 0) {
                        echo '<table class="table table-sm">';
                        echo '<thead><tr><th>Día</th><th>Hora Inicio</th><th>Hora Fin</th></tr></thead>';
                        echo '<tbody>';
                        while($horario = $result_horarios->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . ucfirst($horario['dia']) . '</td>';
                            echo '<td>' . $horario['hora_inicio'] . '</td>';
                            echo '<td>' . $horario['hora_fin'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>No hay horarios disponibles.</p>';
                    }
                    ?>

                        <hr>
                        <h5 class="card-title">Información de Contacto</h5>
                        <?php
                        $sql_contacto = "SELECT tipo, url FROM contacto_puesto WHERE puesto_id = " . $_GET['id'];
                        $result_contacto = $conn->query($sql_contacto);
                        if ($result_contacto->num_rows > 0) {
                            echo '<div class="row row-cols-1 row-cols-md-2 g-2">';
                            while($contacto = $result_contacto->fetch_assoc()) {
                                $icon = '';
                                switch ($contacto['tipo']) {
                                    case 'telefono':
                                        $icon = 'bi bi-telephone-fill';
                                        break;
                                    case 'email':
                                        $icon = 'bi bi-envelope-fill';
                                        break;
                                    case 'pagina web':
                                        $icon = 'bi bi-link-45deg';
                                        break;
                                    default:
                                        // si no se encuentra el tipo, se muestra un icono de información
                                        if (empty($contacto['tipo'])) {
                                            $icon = 'bi bi-info-circle-fill';
                                        }
                                        else{
                                            $icon = 'bi bi-'.$contacto['tipo']; // si se encuentra el tipo, se muestra el icono correspondiente
                                        }
                                        break;
                                }
                                echo '<div class="col">';
                                echo '<a href="' . $contacto['url'] . '" class="btn btn-primary w-100" target="_blank"><i class="' . $icon . '"></i> ' . ucfirst($contacto['tipo']) . '</a>';
                                echo '</div>';
                                echo "bi bi-".$contacto['tipo'];
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No hay información de contacto disponible.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles de los productos -->
        <div class="row gx-5">
            <div class="col-12 mb-5">
                <h3>Productos</h3>
            </div>
            <?php
            $sql_productos = "SELECT * FROM producto WHERE puesto_id = " . $_GET['id'];
            $result_productos = $conn->query($sql_productos);
            if ($result_productos->num_rows > 0) {
                while($producto = $result_productos->fetch_assoc()) {
                    echo '<div class="col-lg-4 mb-5">';
                    echo '<div class="card h-100">';
                    echo '<img src="' . $producto['img'] . '" class="card-img-top fixed-size-product" alt="Imagen de ' . $producto['nombre'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $producto['nombre'] . '</h5>';
                    echo '<p class="card-text">' . $producto['descripcion'] . '</p>';
                    if (!empty($producto['precio'])) {
                        echo '<p class="card-text"><strong>Precio:</strong> $' . $producto['precio'] . '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay productos disponibles.</p>';
            }
            ?>
        </div>
        
        <!-- mantener tamano de imagenes de producto -->
        <style>
            .fixed-size-product {
                height: 25vh;
                object-fit: cover;
            }
        </style>




    </div>
</section>

<?php 
include($templateDetails['footer']);
include($templateDetails['end']);
?>