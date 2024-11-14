# Tianguis Estudiantil

Bienvenido al sitio web del **Tianguis Estudiantil**. Este proyecto es una plataforma para publicitar y brindar visibilidad a los puestos o emprendimientos de nuestra comunidad unicaribe de manera sencilla e intuitiva.

## Instalación

### Requisitos

- Un servidor local como [XAMPP](https://www.apachefriends.org/index.html), [WAMP](http://www.wampserver.com/en/), [MAMP](https://www.mamp.info/en/), etc.
- Opcional: Un manejador de bases de datos como phpMyAdmin o Dbeaver.

### Pasos para la Instalación (*Entorno Local*)

1. **Descargar e Instalar un Servidor Local**
   - Descarga e instala un servidor local de tu preferencia. Por ejemplo, [XAMPP](https://www.apachefriends.org/index.html).

2. **Configurar el Servidor Local**
   - Asegúrate de que el servidor web (Apache) y el servidor de bases de datos (MySQL) estén corriendo.

3. **Mover los Archivos del Proyecto**
   - Descarga o clona el repositorio del proyecto.
   - Mueve la carpeta raíz del proyecto (`tianguis/`) al directorio del servidor web. Por ejemplo, si usas XAMPP, mueve la carpeta a `htdocs`.

4. **Configurar la Base de Datos**
   - Abre tu manejador de base de datos y realiza la conexion a tu servidor local (por ejemplo, phpMyAdmin en XAMPP).
   - Ejecuta el script `tianguis.sql` proporcionado en el proyecto para crear las tablas necesarias.

5. **Acceder al Proyecto**
   - Abre tu navegador web y navega a `http://localhost/tianguis/`.

## Uso

- Para usar el sitio del **Tianguis Estudiantil** como usuario o cliente, no es necesario crear una cuenta ni registrarse, unicamente hacer clic en el boton `Visitar Puesto` de cualquier negocio que te llame la atencion.

- Para comenzar a usar el sitio del **Tianguis Estudiantil** como vendedor, es necesario registrarte como un vendedor creando una cuenta haciendo click en el boton `Mi Puesto`.

- Debes ingresar tus datos como tu nombre, e-mail, telefono y crear una contraseña de al menos 8 digitos.

- Al iniciar sesion, se mostrara un mensaje indicando que no tienes un puesto como vendedor registrado, deberas ingresar el nombre, descripcion larga y corta de tu puesto.

- Al registrar tu puesto, se actualizara tu panel con 2 botones, `Mi Puesto` y `Mis Productos`. Para que tu puesto se muestre en el area principal del sitio, deberas hacer clic en el boton `Mi Puesto` e ingresar una o mas imagenes del puesto. (no de los productos).

## Documentación

Para más detalles sobre la configuración y uso del proyecto, visita nuestra [Wiki](https://github.com/IanDiaz05/tianguis/wiki#tianguis-estudiantil---panel-de-vendedor).
