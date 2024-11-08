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

## Instrucciones para el panel de vendedores

- para ingresar al panel de vendedores, se debe colocar la sig. url en el navegador: 'http://localhost/tianguis/app/admin/'

el mismo sistema identificara si se inicio sesion anteriormente y dejara ingresar al panel de administrador. de lo contrario, automaticamente se redirigira a la pantalla de _login_, en donde si aun no se tiene una cuenta de vendedor, se podra registrar para poder acceder al panel.

- dentro del panel se encuentran algunos botones:
  - **Puesto**: aqui se puede adminsitrar la informacion del pueso como el nombre, descripcion (corta y larga) e imagenes.

    **IMPORTANTE** las imagenes que se suben del puesto deben estar en formato de URL, para esto es necesario subirlas anteriormente a una plataforma o servidor de imagenes (por ejemplo 'https://postimages.org/es/', es necesario que se seleccione la opcion de '_nunca expira_', tambien es recomendable crear una cuenta para acceder en cualquier momento a las url de las imagenes)
    
    Otro punto importante es la seccion de informacion de contacto, el vendedor puede colocar todos sus links a redes sociales o sitio web sin ningun problema, los cuales estaran en un facil acceso a los clientes.

    Tambien se puede subir informacion de los horarios de atencion o de ventas de los vendedores, en donde elegiran un dia de la semana, asi como la hora de 'inicio' de la venta, y la hora de 'final' de la venta en un formato de **24 hrs**
  - **Productos**: Esta seccion es parecida a la de 'puesto', se puede administrar la informacion de los productos como el precio, descripcion, nombre e imagenes (por el momento es 1 imagen por producto) y tambien se sube en formato URL.
  Tambien es posible subir y eliminar productos.