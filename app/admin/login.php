<?php
session_start();

// Verificar si el usuario ya tiene una sesión iniciada
if (isset($_SESSION['usuario'])) {
    header("Location: /tianguis/app/admin/");
    exit();
}

// incluir constantes de la aplicacion
include('../../config/vars.php');
$sources = getSourcesVars();
$templateDetails = getTemplatesVars();

    // detalles de la pagina
    $current_page = "Inicio de Sesión";
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
?>

<!-- Login section-->
<section class="bg-light py-5">
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-circle"></i></div>
            <h2 class="fw-bolder">Inicio de Sesión</h2>
            <p class="lead mb-0">Ingresa a tu cuenta</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <!-- Login Form-->
                <form id="loginForm" method="POST" action="/tianguis/BE/admin/login.php">
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                        <label for="email">Dirección de Email</label>
                        <div class="invalid-feedback">Por favor, introduce tu email.</div>
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required />
                        <label for="password">Contraseña</label>
                        <div class="invalid-feedback">Por favor, introduce tu contraseña.</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid mb-3">
                        <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Iniciar Sesión</button>
                    </div>
                    <!-- Register Button-->
                    <div class="d-grid">
                        <a href="registro.php" class="btn btn-secondary btn-lg">¿Eres nuevo/a?</a>
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
    $('#loginForm input').on('change', function() {
        formModified = true;
    });

    // Mostrar mensaje de confirmación al intentar salir de la página
    window.onbeforeunload = function() {
        if (formModified && !formSubmitting) {
            return 'Tienes cambios sin guardar. ¿Estás seguro de que deseas salir de esta página?';
        }
    };

    // Manejar el envío del formulario
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        // Validaciones del formulario
        var email = $('#email').val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email) || email == '') {
            alert('Por favor, introduce un email válido');
            return false;
        }

        var password = $('#password').val();
        if (password.length < 8) {
            alert('La contraseña debe tener al menos 8 caracteres');
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