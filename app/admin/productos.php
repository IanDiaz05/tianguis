<?php
include('../../BE/admin/checklogin.php');   // verificar si el usuario esta logueado
include('../../config/connection.php'); // incluir archivo de conexión
include('../../config/vars.php');        // incluir constantes de la aplicacion

$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

// detalles de la pagina
$current_page = "Administrar Productos";
$title = "Hola " . $_SESSION['usuario']['nombre'] . ", Administra tus Productos";
$info = "Administra tus productos en el Tianguis del Mayab, sube nuevos productos y mantén tu información actualizada";

// contenido del modal del header
$modalBtnTitle = "¿Cómo funciona?";             // titulo del boton del modal
$modalTitle = "Administrar Mis Productos";                               // titulo del modal
$modalContent = "
<p>En esta sección, puedes gestionar toda la información de tus productos para optimizar su visibilidad en el Tianguis del Mayab.</p>
<ul>
    <li><strong>Vista Previa del Producto</strong>: Aquí puedes ver cómo se verá tu producto en la página principal del Tianguis del Mayab.</li>
    <li><strong>Modificar Producto</strong>: Puedes actualizar el nombre, la descripción, el precio y la imagen de tu producto. Asegúrate de que la imagen sea atractiva y de alta calidad para atraer a más clientes.</li>
    <li><strong>Eliminar Producto</strong>: Si un producto ya no está disponible, puedes eliminarlo de tu inventario para mantener tu lista de productos actualizada.</li>
</ul>
";                           // contenido del modal

// incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);

// Obtener los datos del puesto
$id_vendedor = $_SESSION['usuario']['id'];
$sql = "
SELECT prod.id AS prod_id, prod.nombre AS prod_nombre, prod.descripcion AS prod_descripcion, prod.img AS prod_img, prod.precio AS prod_precio
FROM producto prod
JOIN puesto p ON p.id = prod.puesto_id
WHERE p.vendedor_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_vendedor);
$stmt->execute();
$result = $stmt->get_result();
$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

?>

<!-- contenido de la pagina -->
<main class="flex-shrink-0">
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <!-- Card para vista previa y formulario de modificación del producto -->
                <div class="col-lg-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Vista Previa del Producto</h5>
                            <div class="card">
                                <img id="preview_img" src="" class="card-img-top fixed-size-producto" alt="Imagen del producto">
                                <div class="card-body">
                                    <h5 class="card-title" id="preview_nombre"></h5>
                                    <p class="card-text" id="preview_descripcion"></p>
                                    <p class="card-text" id="preview_precio"></p>
                                </div>
                            </div>
                            <h5 class="card-title mt-4">Modificar Producto</h5>
                            <form id="modificarProductoForm">
                                <input type="hidden" id="producto_id" name="producto_id">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">URL de la Imagen</label>
                                    <input type="text" class="form-control" id="img" name="img" required>
                                </div>
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                                </div>
                                <!-- Btn actualizar producto -->
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <!-- Btn eliminar producto -->
                                <button type="button" class="btn btn-secondary" id="addProducto">Agregar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card para mostrar todos los productos -->
                <div class="col-lg-8 mb-5">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <?php foreach ($productos as $producto): ?>
                            <div class="col mb-5 h-100">
                                <div class="card h-100">
                                    <img src="<?php echo $producto['prod_img']; ?>" class="card-img-top fixed-size-producto" alt="Imagen del producto">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $producto['prod_nombre']; ?></h5>
                                        <p class="card-text"><?php echo $producto['prod_descripcion']; ?></p>
                                        <p class="card-text">$<?php echo $producto['prod_precio']; ?></p>
                                        <button type="button" class="btn btn-secondary btn-administrar" data-id="<?php echo $producto['prod_id']; ?>" data-nombre="<?php echo $producto['prod_nombre']; ?>" data-descripcion="<?php echo $producto['prod_descripcion']; ?>" data-img="<?php echo $producto['prod_img']; ?>" data-precio="<?php echo $producto['prod_precio']; ?>">Administrar</button>
                                        <button type="button" class="btn btn-danger btn-eliminar" data-id="<?php echo $producto['prod_id']; ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Modal de confirmación de eliminación -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este producto?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- mantener tamano de imagenes de producto -->
            <style>
                .fixed-size-producto {
                    height: 20vh; /* Ajusta la altura según tus necesidades */
                    object-fit: cover;
                }
            </style>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/tianguis/BE/producto/producto.js"></script>

<?php
include($templateDetails['footer']);
include($templateDetails['end']);
?>