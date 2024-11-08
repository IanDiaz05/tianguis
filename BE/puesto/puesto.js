$(document).ready(function() {
    // Guardar los valores originales
    var originalValues = {
        nombre: $('#nombre').val(),
        descripcion_corta: $('#descripcion_corta').val(),
        descripcion_larga: $('#descripcion_larga').val(),
        imagenes: $('input[name="imagenes[]"]').map(function() { return $(this).val(); }).get(),
        horarios: $('select[name="dias[]"]').map(function(index) {
            return {
                dia: $(this).val(),
                hora_inicio: $('input[name="hora_inicio[]"]').eq(index).val(),
                hora_fin: $('input[name="hora_fin[]"]').eq(index).val()
            };
        }).get(),
        contactos: $('select[name="tipos[]"]').map(function(index) {
            return {
                tipo: $(this).val(),
                url: $('input[name="urls[]"]').eq(index).val()
            };
        }).get()
    };

    // Agregar nueva imagen
    $('#addImage').on('click', function() {
        $('#imagenes').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="imagenes[]" value="">
                <button type="button" class="btn btn-danger btn-remove-img">Eliminar</button>
            </div>
        `);
    });

    // Eliminar imagen
    $(document).on('click', '.btn-remove-img', function() {
        $(this).closest('.input-group').remove();
    });

    // Agregar nuevo horario
    $('#addHorario').on('click', function() {
        $('#horarios').append(`
            <div class="input-group mb-2">
                <select class="form-select" name="dias[]">
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miércoles">Miércoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                    <option value="sábado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
                <input type="time" class="form-control" name="hora_inicio[]" value="">
                <input type="time" class="form-control" name="hora_fin[]" value="">
                <button type="button" class="btn btn-danger btn-remove-horario">Eliminar</button>
            </div>
        `);
    });

    // Eliminar horario
    $(document).on('click', '.btn-remove-horario', function() {
        $(this).closest('.input-group').remove();
    });

    // Agregar nuevo contacto
    $('#addContacto').on('click', function() {
        $('#contactos').append(`
            <div class="input-group mb-2">
                <select class="form-select" name="tipos[]">
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="telefono">Teléfono</option>
                    <option value="email">Email</option>
                    <option value="pagina web">Página Web</option>
                </select>
                <input type="text" class="form-control" name="urls[]" value="">
                <button type="button" class="btn btn-danger btn-remove-contacto">Eliminar</button>
            </div>
        `);
    });

    // Eliminar contacto
    $(document).on('click', '.btn-remove-contacto', function() {
        $(this).closest('.input-group').remove();
    });

    $('#actualizarPuestoForm').on('submit', function(e) {
        e.preventDefault();

        // Crear un objeto con los datos modificados
        var updatedValues = {};
        if ($('#nombre').val() !== originalValues.nombre) {
            updatedValues.nombre = $('#nombre').val();
        }
        if ($('#descripcion_corta').val() !== originalValues.descripcion_corta) {
            updatedValues.descripcion_corta = $('#descripcion_corta').val();
        }
        if ($('#descripcion_larga').val() !== originalValues.descripcion_larga) {
            updatedValues.descripcion_larga = $('#descripcion_larga').val();
        }

        var imagenes = $('input[name="imagenes[]"]').map(function() { return $(this).val(); }).get();
        if (JSON.stringify(imagenes) !== JSON.stringify(originalValues.imagenes)) {
            updatedValues.imagenes = imagenes;
        }

        var horarios = $('select[name="dias[]"]').map(function(index) {
            return {
                dia: $(this).val(),
                hora_inicio: $('input[name="hora_inicio[]"]').eq(index).val(),
                hora_fin: $('input[name="hora_fin[]"]').eq(index).val()
            };
        }).get();
        if (JSON.stringify(horarios) !== JSON.stringify(originalValues.horarios)) {
            updatedValues.horarios = horarios;
        }

        var contactos = $('select[name="tipos[]"]').map(function(index) {
            return {
                tipo: $(this).val(),
                url: $('input[name="urls[]"]').eq(index).val()
            };
        }).get();
        if (JSON.stringify(contactos) !== JSON.stringify(originalValues.contactos)) {
            updatedValues.contactos = contactos;
        }

        // Enviar solo los datos modificados
        $.ajax({
            url: '/tianguis/BE/puesto/actualizar_puesto.php',
            type: 'POST',
            data: updatedValues,
            success: function(response) {
                alert('Puesto actualizado correctamente');
                // Actualizar la vista previa
                if (updatedValues.nombre) {
                    $('#preview_nombre').text(updatedValues.nombre);
                    originalValues.nombre = updatedValues.nombre;
                }
                if (updatedValues.descripcion_corta) {
                    $('#preview_descripcion_corta').text(updatedValues.descripcion_corta);
                    originalValues.descripcion_corta = updatedValues.descripcion_corta;
                }
                if (updatedValues.descripcion_larga) {
                    $('#preview_descripcion_larga').text(updatedValues.descripcion_larga);
                    originalValues.descripcion_larga = updatedValues.descripcion_larga;
                }
                if (updatedValues.imagenes) {
                    $('#preview_img').attr('src', updatedValues.imagenes[0]);
                    originalValues.imagenes = updatedValues.imagenes;
                }
                if (updatedValues.horarios) {
                    var horariosHtml = '';
                    updatedValues.horarios.forEach(function(horario) {
                        horariosHtml += `<li>${horario.dia}: ${horario.hora_inicio} - ${horario.hora_fin}</li>`;
                    });
                    $('#preview_horarios').html(horariosHtml);
                    originalValues.horarios = updatedValues.horarios;
                }
                if (updatedValues.contactos) {
                    var contactosHtml = '';
                    updatedValues.contactos.forEach(function(contacto) {
                        contactosHtml += `<li>${contacto.tipo}: ${contacto.url}</li>`;
                    });
                    $('#preview_contactos').html(contactosHtml);
                    originalValues.contactos = updatedValues.contactos;
                }
            },
            error: function() {
                alert('Error al actualizar el puesto');
            }
        });
    });
});