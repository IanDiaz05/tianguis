$(document).ready(function() {
    $('#registroPuestoForm').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            nombre: $('#nombre').val(),
            descripcion_corta: $('#descripcion_corta').val(),
            descripcion_larga: $('#descripcion_larga').val()
        };

        $.ajax({
            url: '/tianguis/BE/admin/registro_puesto.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Puesto registrado correctamente');
                location.reload(); // Recargar la página para reflejar los cambios
            },
            error: function() {
                alert('Error al registrar el puesto');
            }
        });
    });
});