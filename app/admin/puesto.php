<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión
include('../../config/vars.php');        // incluir constantes de la aplicacion

$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

// detalles de la pagina
$current_page = "Actualizar Puesto";
$title = "Hola " . $_SESSION['usuario']['nombre'] . ", Actualiza la Información de tu Puesto";
$info = "Administra tu puesto en el Tianguis Estudiantil, sube tus productos y mantén tu información actualizada";

// contenido del modal del header
$modalBtnTitle = "¿Cómo funciona?";             // titulo del boton del modal
$modalTitle = "Mi Puesto";                               // titulo del modal
$modalContent = "
<p>En esta sección, puedes actualizar y personalizar la información principal de tu puesto para que los visitantes encuentren todos los detalles que necesitan de forma clara y accesible.</p>
<ul>
    <li><strong>Nombre del Puesto</strong>: Asegúrate de que el nombre de tu puesto sea claro y fácil de recordar para tus clientes.</li>
    <li><strong>Descripción Corta</strong>: Proporciona una breve descripción de tu puesto para que los visitantes sepan de qué se trata tu negocio.</li>
    <li><strong>Descripción Larga</strong>: Detalla la información de tu puesto, como los productos que ofreces, los servicios que proporcionas, y cualquier otra información relevante.</li>
    <li><strong>Imágenes del Puesto</strong>: Sube imágenes de tu puesto para que los visitantes puedan ver cómo es tu negocio y qué productos ofreces.</li>
    <li><strong>Horarios de Atención</strong>: Indica los días y horarios en los que tu puesto está abierto para que los clientes sepan cuándo pueden visitarte.</li>
    <li><strong>Métodos de Contacto</strong>: Proporciona enlaces a tus redes sociales, números de teléfono, direcciones de correo electrónico y otros métodos de contacto para que los visitantes puedan comunicarse contigo.</li>
</ul>
";                           // contenido del modal

// incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

// Obtener los datos del puesto
$id_vendedor = $_SESSION['usuario']['id'];
$sql = "
SELECT p.*, img.url AS img
FROM puesto p
LEFT JOIN imagenes_puesto img ON p.id = img.puesto_id
WHERE p.vendedor_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_vendedor);
$stmt->execute();
$result = $stmt->get_result();
$puesto = $result->fetch_assoc();

// Obtener todas las imágenes del puesto
$sql_imgs = "SELECT url FROM imagenes_puesto WHERE puesto_id = ?";
$stmt_imgs = $conn->prepare($sql_imgs);
$stmt_imgs->bind_param("i", $puesto['id']);
$stmt_imgs->execute();
$result_imgs = $stmt_imgs->get_result();
$imagenes = [];
while ($row = $result_imgs->fetch_assoc()) {
    $imagenes[] = $row['url'];
}

// Obtener todos los horarios del puesto
$sql_horarios = "SELECT * FROM horario_puesto WHERE puesto_id = ?";
$stmt_horarios = $conn->prepare($sql_horarios);
$stmt_horarios->bind_param("i", $puesto['id']);
$stmt_horarios->execute();
$result_horarios = $stmt_horarios->get_result();
$horarios = [];
while ($row = $result_horarios->fetch_assoc()) {
    $horarios[] = $row;
}

// Obtener todos los métodos de contacto del puesto
$sql_contactos = "SELECT * FROM contacto_puesto WHERE puesto_id = ?";
$stmt_contactos = $conn->prepare($sql_contactos);
$stmt_contactos->bind_param("i", $puesto['id']);
$stmt_contactos->execute();
$result_contactos = $stmt_contactos->get_result();
$contactos = [];
while ($row = $result_contactos->fetch_assoc()) {
    $contactos[] = $row;
}

?>

<!-- contenido de la pagina -->
<main class="flex-shrink-0">
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <!-- Card para actualizar información del puesto -->
                <div class="col-lg-8 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Actualizar Información del Puesto</h5>
                            <form id="actualizarPuestoForm">

                                <!-- ACTUALIZAR EL NOMBRE DEL PUESTO -->
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Puesto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $puesto['nombre']; ?>" required>
                                </div>

                                <!-- ACTUALIZAR LA DESCRIPCION CORTA -->
                                <div class="mb-3">
                                    <label for="descripcion_corta" class="form-label">Descripción Corta</label>
                                    <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" rows="2" required><?php echo $puesto['descripcion_corta']; ?></textarea>
                                </div>

                                <!-- ACTUALIZAR LA DESCRIPCION LARGA -->
                                <div class="mb-3">
                                    <label for="descripcion_larga" class="form-label">Descripción Larga</label>
                                    <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" rows="5" required><?php echo $puesto['descripcion_larga']; ?></textarea>
                                </div>

                                <!-- ACTUALIZAR LAS IMAGENES DEL PUESTO -->
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">URLs de las Imágenes del Puesto</label>
                                    <div id="imagenes">
                                        <?php foreach ($imagenes as $img): ?>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="imagenes[]" value="<?php echo $img; ?>">
                                                <button type="button" class="btn btn-danger btn-remove-img">Eliminar</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary" id="addImage">Agregar Imagen</button>
                                </div>

                                <!-- ACTUALIZAR LOS HORARIOS DE ATENCION -->
                                <div class="mb-3">
                                    <label for="horarios" class="form-label">Horarios del Puesto</label>
                                    <div id="horarios">
                                        <?php foreach ($horarios as $horario): ?>
                                            <div class="input-group mb-2">
                                                <select class="form-select" name="dias[]">
                                                    <option value="lunes" <?php echo $horario['dia'] == 'lunes' ? 'selected' : ''; ?>>Lunes</option>
                                                    <option value="martes" <?php echo $horario['dia'] == 'martes' ? 'selected' : ''; ?>>Martes</option>
                                                    <option value="miércoles" <?php echo $horario['dia'] == 'miércoles' ? 'selected' : ''; ?>>Miércoles</option>
                                                    <option value="jueves" <?php echo $horario['dia'] == 'jueves' ? 'selected' : ''; ?>>Jueves</option>
                                                    <option value="viernes" <?php echo $horario['dia'] == 'viernes' ? 'selected' : ''; ?>>Viernes</option>
                                                    <option value="sábado" <?php echo $horario['dia'] == 'sábado' ? 'selected' : ''; ?>>Sábado</option>
                                                    <option value="domingo" <?php echo $horario['dia'] == 'domingo' ? 'selected' : ''; ?>>Domingo</option>
                                                </select>
                                                <input type="time" class="form-control" name="hora_inicio[]" value="<?php echo $horario['hora_inicio']; ?>">
                                                <input type="time" class="form-control" name="hora_fin[]" value="<?php echo $horario['hora_fin']; ?>">
                                                <button type="button" class="btn btn-danger btn-remove-horario">Eliminar</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary" id="addHorario">Agregar Horario</button>
                                </div>
                                
                                <!-- ACTUALIZAR LOS BOTONES DE CONTACTO -->
                                <div class="mb-3">
                                    <label for="contactos" class="form-label">Métodos de Contacto</label>
                                    <div id="contactos">
                                        <?php foreach ($contactos as $contacto): ?>
                                            <div class="input-group mb-2">
                                                <select class="form-select" name="tipos[]">
                                                    <option value="facebook" <?php echo $contacto['tipo'] == 'facebook' ? 'selected' : ''; ?>>Facebook</option>
                                                    <option value="instagram" <?php echo $contacto['tipo'] == 'instagram' ? 'selected' : ''; ?>>Instagram</option>
                                                    <option value="whatsapp" <?php echo $contacto['tipo'] == 'whatsapp' ? 'selected' : ''; ?>>WhatsApp</option>
                                                    <option value="telefono" <?php echo $contacto['tipo'] == 'telefono' ? 'selected' : ''; ?>>Teléfono</option>
                                                    <option value="email" <?php echo $contacto['tipo'] == 'email' ? 'selected' : ''; ?>>Email</option>
                                                    <option value="pagina web" <?php echo $contacto['tipo'] == 'pagina web' ? 'selected' : ''; ?>>Página Web</option>
                                                </select>
                                                <input type="text" class="form-control" name="urls[]" value="<?php echo $contacto['url']; ?>">
                                                <button type="button" class="btn btn-danger btn-remove-contacto">Eliminar</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary" id="addContacto">Agregar Contacto</button>
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card para vista previa del puesto -->
                <div class="col-lg-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Vista Previa del Puesto</h5>
                            <div class="card">
                                <img id="preview_img" src="<?php echo $puesto['img']; ?>" class="card-img-top fixed-size-puesto" alt="Imagen del puesto">
                                <div class="card-body">
                                    <h5 class="card-title" id="preview_nombre"><?php echo $puesto['nombre']; ?></h5>
                                    <p class="card-text" id="preview_descripcion_corta"><?php echo $puesto['descripcion_corta']; ?></p>
                                    <p class="card-text" id="preview_descripcion_larga"><?php echo $puesto['descripcion_larga']; ?></p>
                                </div>
                            </div>
                        </div>
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
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/tianguis/BE/puesto/puesto.js"></script>

<?php
include($templateDetails['footer']);
include($templateDetails['end']);

?>