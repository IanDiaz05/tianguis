$(document).ready(function() {
    // Guardar los valores originales
    var originalValues = {
        nombre: $('#nombre').val(),
        descripcion: $('#descripcion').val(),
        img: $('#img').val(),
        precio: $('#precio').val()
    };

    // Llenar el formulario de modificación con los datos del producto seleccionado
    $('.btn-administrar').click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var descripcion = $(this).data('descripcion');
        var img = $(this).data('img');
        var precio = $(this).data('precio');

        $('#producto_id').val(id);
        $('#nombre').val(nombre);
        $('#descripcion').val(descripcion);
        $('#img').val(img);
        $('#precio').val(precio);

        $('#preview_img').attr('src', img);
        $('#preview_nombre').text(nombre);
        $('#preview_descripcion').text(descripcion);
        $('#preview_precio').text('$' + precio);

        // Actualizar los valores originales
        originalValues = {
            nombre: nombre,
            descripcion: descripcion,
            img: img,
            precio: precio
        };
    });

    $('#modificarProductoForm').on('submit', function(e) {
        e.preventDefault();

        // Crear un objeto con los datos modificados
        var updatedValues = {};
        if ($('#nombre').val() !== originalValues.nombre) {
            updatedValues.nombre = $('#nombre').val();
        }
        if ($('#descripcion').val() !== originalValues.descripcion) {
            updatedValues.descripcion = $('#descripcion').val();
        }
        if ($('#img').val() !== originalValues.img) {
            updatedValues.img = $('#img').val();
        }
        if ($('#precio').val() !== originalValues.precio) {
            updatedValues.precio = $('#precio').val();
        }

        // Enviar solo los datos modificados
        $.ajax({
            url: '/tianguis/BE/producto/update_productos.php',
            type: 'POST',
            data: {
                producto_id: $('#producto_id').val(),
                ...updatedValues
            },
            success: function(response) {
                alert('Producto actualizado correctamente');
                location.reload();
            },
            error: function() {
                alert('Error al actualizar el producto');
            }
        });
    });

    $('#addProducto').click(function() {
        // Crear un objeto con los datos del nuevo producto
        var newProduct = {
            nombre: $('#nombre').val(),
            descripcion: $('#descripcion').val(),
            img: $('#img').val(),
            precio: $('#precio').val()
        };

        // Enviar los datos del nuevo producto
        $.ajax({
            url: '/tianguis/BE/producto/insert_productos.php',
            type: 'POST',
            data: newProduct,
            success: function(response) {
                alert('Producto agregado correctamente');
                // Restablecer el formulario
                $('#modificarProductoForm')[0].reset();
                // Restablecer la vista previa
                $('#preview_img').attr('src', '');
                $('#preview_nombre').text('');
                $('#preview_descripcion').text('');
                $('#preview_precio').text('');
                location.reload();
            },
            error: function() {
                alert('Error al agregar el producto');
            }
        });
    });

    var productoIdToDelete = null;

    // Manejar el clic en el botón de eliminar
    $('.btn-eliminar').click(function() {
        productoIdToDelete = $(this).data('id');
    });

    // Manejar la confirmación de eliminación
    $('#confirmDeleteBtn').click(function() {
        if (productoIdToDelete) {
            $.ajax({
                url: '/tianguis/BE/producto/delete_productos.php',
                type: 'POST',
                data: { producto_id: productoIdToDelete },
                success: function(response) {
                    alert('Producto eliminado correctamente');
                    // restablecer formulario y vista previa
                    $('#modificarProductoForm')[0].reset();
                    $('#preview_img').attr('src', '');
                    $('#preview_nombre').text('');
                    $('#preview_descripcion').text('');
                    $('#preview_precio').text('');
                    
                    location.reload();
                },
                error: function() {
                    alert('Error al eliminar el producto');
                }
            });
        }
    });
});