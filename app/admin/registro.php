<?php
session_start();

// incluir constantes de la aplicacion
include('../../config/vars.php');
$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

    // detalles de la pagina
    $current_page = "Registro";
    $title = "Hola, Bienvenid@ al Tianguis Estudiantil";
    $info = "Descubre, Conecta y Apoya a los Emprendedores Universitarios";

    // conteindo del modal del header
    $modalBtnTitle = "¿Cómo funciona?";
    $modalTitle = "¡Tu visita hace la diferencia!";
    $modalContent = "
    <p>Regístrate para comenzar a publicar los productos de tu negocio en el Tianguis Estudiantil:</p>
    <p>Si eres nuevo/a, puedes crear una cuenta para acceder a tu panel de administración y comenzar a publicar tus productos en el Tianguis Estudiantil.</p>
    <p>Completa el formulario de registro para unirte al Tianguis Estudiantil y comenzar a publicitar tus productos. Proporciona tus datos básicos, como tu nombre, apellido, correo electrónico, teléfono y crea una contraseña segura. Una vez registrado, podrás acceder al panel de administración de tu puesto, donde tendrás la posibilidad de personalizar tu perfil, agregar productos y compartir tus horarios y métodos de contacto.</p>
    ";
    

//incluir contenido de la pagina (plantillas)
include($templateDetails['top']);
include($templateDetails['navbar']);
include($templateDetails['header']);
?>

<!-- Registro section-->
<section class="bg-light py-5">
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <div class="feature bg-custom-primary text-white rounded-3 mb-3"><i class="bi bi-person-circle"></i></div>
            <h2 class="fw-bolder">Registro</h2>
            <p class="lead mb-0">Crea una cuenta para comenzar a publicar los productos de tu negocio en el <b>Tianguis Estudiantil</b></p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <!-- Registro Form-->
                <form id="registroForm" method="POST" action="/tianguis/BE/admin/registro.php">
                    <div class="form-floating mb-3">
                        <div class="input-group input-group-lg">
                            <!-- Nombre input -->
                            <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre(s)" required />
                            <!-- Apellido input -->
                            <input class="form-control" id="apellido" name="apellido" type="text" placeholder="Apellido(s)" required />
                        </div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                        <label for="email">Dirección de Email</label>
                        <div class="invalid-feedback">Por favor, introduce tu email.</div>
                    </div>
                    <!-- Telefono input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="Teléfono" required />
                        <label for="telefono">Teléfono</label>
                        <div class="invalid-feedback">Por favor, introduce tu número de teléfono.</div>
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required />
                        <label for="password">Contraseña</label>
                        <div class="invalid-feedback">Por favor, introduce tu contraseña.</div>
                    </div>

                    <!-- Submit Button-->
                    <div class="d-grid mb-3">
                        <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Registrarse</button>
                    </div>
                    <!-- Login Button-->
                    <div class="d-grid">
                        <a href="/tianguis/app/admin/login.php" class="btn btn-secondary btn-lg">Iniciar Sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var formModified = false;
    var formSubmitting = false;

    // Detectar cambios en el formulario
    $('#registroForm input').on('change', function() {
        formModified = true;
    });

    // Mostrar mensaje de confirmación al intentar salir de la página
    window.onbeforeunload = function() {
        if (formModified && !formSubmitting) {
            return 'Tienes cambios sin guardar. ¿Estás seguro de que deseas salir de esta página?';
        }
    };

    // Manejar el envío del formulario
    $('#registroForm').on('submit', function(e) {
        e.preventDefault();

        // Validaciones del formulario
        var nombre = $('#nombre').val();
        if (nombre.length < 3 || nombre.length > 100) {
            alert('El nombre debe tener entre 3 y 100 caracteres');
            return false;
        }

        var apellido = $('#apellido').val();
        if (apellido.length < 3 || apellido.length > 100) {
            alert('El apellido debe tener entre 3 y 100 caracteres');
            return false;
        }

        var email = $('#email').val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email) || email == '') {
            alert('Por favor, introduce un email válido');
            return false;
        }

        var telefono = $('#telefono').val();
        var telReg = /^[0-9]{10}$/;
        if (!telReg.test(telefono)) {
            alert('Por favor, introduce un número de teléfono válido');
            return false;
        }

        var password = $('#password').val();
        if (password.length < 8) {
            alert('La contraseña debe tener al menos 8 caracteres');
            return false;
        }

        // Confirmación de datos
        var mensaje = 'Reconozco que mis datos son correctos, ya que no podré modificarlos después de registrarme. ¿Deseas corregir los datos?';
        if (!confirm(mensaje)) {
            // Si el usuario hace clic en "Cancelar", se cancela el envío del formulario
            return false;
        }

        // Si todas las validaciones pasan, permitir el envío del formulario
        formSubmitting = true; // Evitar el mensaje de confirmación al enviar el formulario
        formModified = false; // Resetear el estado de modificación del formulario
        this.submit();
    });

    // Manejar clic en los botones de navegación
    $('a, button').on('click', function(e) {
        // Si el botón clicado es el de submit, no mostrar la alerta
        if ($(this).attr('type') === 'submit') {
            return;
        }

        if (formModified && !formSubmitting) {
            var mensaje = 'Tienes cambios sin guardar. ¿Estás seguro de que deseas salir de esta página?';
            if (!confirm(mensaje)) {
                e.preventDefault();
            }
        }
    });
});
</script>

<?php 
include($templateDetails['footer']);
include($templateDetails['end']);
?>