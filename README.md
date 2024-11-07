# Tianguis del Mayab
repo del sitio del tianguis del mayab

## Guia para instalar o desplegar la aplicacion _entorno local_
- primero se debe tener instalado un servidor local (xampp por ejemplo) y algun manejador de BD (PHPMyAdmin ya viene instalado con xampp)
- habilitar los servicios **APACHE** y **MySQL**
- colocar la carpeta 'tianguis' dentro de: */xampp/htdocs/
- en un editor de texto/codigo (VS Code, bloc de notas, etc), abrir el archivo: '*/tianguis/config/connection.php' y configurar las credenciales de acceso a la BD (de ser necesario)
- ubicar el archivo '*/tianguis/tianguis.sql', en el manejador de BD importar y ejecutar el script
  - **OPCIONAL:** si se quire insertar registros de prueba, ubicar el archivo '*/tianguis/insertar.sql' y ejecutarlo
- ingresar en cualquier navegador la siguiente url: 'http://localhost/tianguis/app/home/' para el sitio de visitantes.

## _aqui se agregaran las instrucciones para el panel de vendedores_
