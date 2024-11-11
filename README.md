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

---
## Instrucciones para el panel de vendedores

- para ingresar al panel de vendedores, se debe colocar la sig. url en el navegador: 'http://localhost/tianguis/app/admin/'

el mismo sistema identificara si se inicio sesion anteriormente y dejara ingresar al panel de administrador. de lo contrario, automaticamente se redirigira a la pantalla de _login_, en donde si aun no se tiene una cuenta de vendedor, se podra registrar para poder acceder al panel.

- dentro del panel se encuentran algunos botones:
  - **Puesto**: aqui se puede adminsitrar la informacion del pueso como el nombre, descripcion (corta y larga) e imagenes.

    **IMPORTANTE** las imagenes que se suben del puesto deben estar en formato de URL, para esto es necesario subirlas anteriormente a una plataforma o servidor de imagenes.
    
    Otro punto importante es la seccion de informacion de contacto, el vendedor puede colocar todos sus links a redes sociales o sitio web sin ningun problema, los cuales estaran en un facil acceso a los clientes.

    Tambien se puede subir informacion de los horarios de atencion o de ventas de los vendedores, en donde elegiran un dia de la semana, asi como la hora de 'inicio' de la venta, y la hora de 'final' de la venta en un formato de **24 hrs**
  - **Productos**: Esta seccion es parecida a la de 'puesto', se puede administrar la informacion de los productos como el precio, descripcion, nombre e imagenes (por el momento es 1 imagen por producto) y tambien se sube en formato URL.
  Tambien es posible subir y eliminar productos.
  - **Cerrar Sesion**: Este boton no tiene mucha ciencia, unicamente termina la sesion del usuario, redirigiendo a la pagina de login y si se desea volver al panel de administracion del negocio se debe volver a ingresar el email y contrasena.

---
# Subir Imagenes al Panel | Guia
Las imagenes de los productos no se almacenan en el servidor ya que estas ocupan demasiado espacio y seria caro de mantener, es por esto que optamos por usar _url's_ de estas mismas imagenes pero alojadas en servidores externos especializados en el almacenamiento de imagenes, como por ejemplo **Postimage**.

Para poder subir tus imagenes a postimage y despues, al **Panel de Vendedor del Tianguis del Mayab**, debes seguir estos sencillos pasos si nunca has usado alguna plataforma de alojamiento de imagenes.

1. Debes visitar el sitio de [Postimage](https://postimages.org/es/) (o cualquier otro servidor de imagenes de tu preferencia).
2. **Opcional pero altamente recomendable**: Debes crear una cuenta haciendo click en el boton de [Registrarse](https://postimages.org/es/signup) para tener el control y los _url's_ de todas las imagenes que has subido. Este punto es opcional ya que puedes subir imagenes sin tener una cuenta, pero el enlace a estas solo lo tendras una vez (a menos que lo guardes en algun lugar), aunque las imagenes pueden estar alojadas por tiempo indeterminado, el acceso a estas sera mas complicado, cosa que puede arreglarse con solo registrarte con tu e-mail.
3. Una vez iniciado sesion, veras una pantalla parecida a esta, en donde puedes modificar los parametros antes de subir una imagen, sin embargo es **IMPORTANTE** que la tercera opcion se marque como "**Sin caducidad**", asi los enlaces de las imagenes que subas siempre estaran disponibles.
   
   [![pantalla-postimage.png](https://i.postimg.cc/wTByjhv8/pantalla-postimage.png)](https://postimg.cc/vDpHPxf3)
5. Teniendo en cuenta lo anterior, hacer click en el boton "**Elige las Imagenes**" en donde se desplegara el explorador de archivos de tu dispositivo, aqui seleccionaras la o las imagenes que deseas subir (tambien es posible seleccionar carpetas), y confirmar la subida de estas.
6. Una vez se haya completado la subida de tus imagenes, deberas ver una pantalla como esta, en donde debes copiar al portapapeles el contenido de la segunda opcion "_**Enlace directo**_", esta es la url de la imagen que deberas colocar en el "**Panel de Vendedor del Tianguis del Mayab**".
   [![img-subida.png](https://i.postimg.cc/L6sDFgFh/img-subida.png)](https://postimg.cc/3WPmgRRH)

7. Por ultimo, debes confirmar los cambios en la seccion que estes editando, "**Mi Puesto**" o "**Mis Productos**" y una vez hecho esto, tus imagenes seran visibles en todo el sitio. 😄🎉
