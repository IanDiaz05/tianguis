<?php
// variables de recursos generales
define('CSS_PATH', '../../sources/css/styles.css');
define('FAVICON_PATH', '../../sources/img/ucaribe_icon.png');
define('BOOTSTRAP_ICONS', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
define('BOOTSTRAP_JS', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js');

// ruta a plantillas de la aplicacion
define('TOP_PATH', '../plantillas/top.php');
define('NAVBAR_PATH', '../plantillas/navbar.php');
define('HEADER_PATH', '../plantillas/header.php');
define('FOOTER_PATH', '../plantillas/footer.php');
define('END_PATH', '../plantillas/end.php');

// funciones
function getSourcesVars() {
    return [
        'css' => CSS_PATH,
        'favicon' => FAVICON_PATH,
        'bootstrap_icons' => BOOTSTRAP_ICONS,
        'bootstrap_js' => BOOTSTRAP_JS // Corregido el typo
    ];
}

function getTemplatesVars() {
    return [
        'top' => TOP_PATH,
        'navbar' => NAVBAR_PATH,
        'header' => HEADER_PATH,
        'footer' => FOOTER_PATH,
        'end' => END_PATH
    ];
}

?>