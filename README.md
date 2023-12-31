# Globaly Gaming Score

## Descripción

Globaly Gaming Score es una plataforma de juegos en línea que permite a los usuarios jugar, competir por puntuaciones altas y comentar en rankings. Está diseñada para proporcionar una experiencia de juego interactiva y comunitaria.

## Estructura del Proyecto

- `JUEGOS`: Carpeta donde se almacenan los juegos.
- `DAL`: Contiene los archivos relacionados con la capa de acceso a datos, incluyendo `conn.php` para la conexión con la base de datos.
- `includes`: Archivos PHP que se incluyen en otros scripts, como `navbar.php` para la barra de navegación del sitio.
- `vendor`: Librerías de terceros manejadas por Composer, incluyendo PHPMailer y Google API.
- `views`: Archivos relacionados con la presentación y la interfaz de usuario del proyecto.
- `assets`: Recursos estáticos como imágenes, CSS y JavaScript.
- `.env`: Archivo para configurar las variables de entorno (excluido del repositorio de control de versiones).
- `composer.json` y `composer.lock`: Configuración y bloqueo de dependencias de Composer.

## Requisitos Previos

- PHP versión 7.4.33 o superior.
- Servidor mySQL.

## Instalación

1. Clona el repositorio en tu servidor local o de hosting.
2. Ejecuta `composer install` para instalar las dependencias del proyecto.
3. Configura tu servidor web para apuntar al directorio raíz del proyecto.

## Configuración de la Base de Datos

1. Crea una base de datos en tu servidor MySQL.
2. Configura las credenciales de conexión en `DAL/conn.php`:
   ```php
   <?php
   // Configuración de la conexión a la base de datos
   $host = 'localhost'; // Host de la base de datos
   $db = 'juegosscoresdb'; // Nombre de la base de datos
   $user = 'root'; // Usuario de la base de datos
   $pass = ''; // Contraseña del usuario de la base de datos
   $charset = 'utf8'; // Codificación de caracteres

## Uso

Después de completar la instalación y configuración, puedes comenzar a utilizar las características principales de la aplicación. Ten en cuenta que debes estar autenticado (logueado) para acceder a la mayoría de las funcionalidades.

### Iniciar Sesión

Para usar la aplicación, debes iniciar sesión:

1. Navega a `http://localhost/applications/juegos/`. esta ruta es la ruta en el disco local C en la carpeta de xampp y htdocs: con una carpeta llamada applicatios y dentro de esa otra llamada juegos
2. Ingresa tu nombre de usuario y contraseña en los campos correspondientes.
3. Haz clic en el botón "Iniciar sesión" para acceder a tu cuenta.

Si aún no tienes una cuenta, sigue los pasos en la sección "Registro de Usuario" para crear una.

### Registro de Usuario

Crea una cuenta para poder jugar y comentar:

1. Ve a el boton de registrarse y crea una cuenta.
2. Completa el formulario de registro con los detalles requeridos.
3. Haz clic en "Registrar" para crear tu cuenta.
4. Una vez registrada tu cuenta, puedes iniciar sesión siguiendo los pasos de la sección "Iniciar Sesión".

### Jugar

Para jugar:

1. Después de iniciar sesión, selecciona el juego al que deseas jugar desde la lista de juegos disponibles.
2. Cada juego tendrá su propio conjunto de instrucciones o controles que se mostrarán antes de comenzar.

### Comentar en los Rankings

Para dejar un comentario en los rankings de un juego:

1. Navega hasta la página de rankings del juego en cuestión.
2. En la sección de comentarios, escribe tu opinión o reacción.
3. Presiona "Enviar" para publicar tu comentario.

Recuerda que tu sesión debe estar activa para jugar y comentar. Si tu sesión expira o te desconectas, necesitarás volver a iniciar sesión.

### Cerrar Sesión

Para mantener la seguridad de tu cuenta, asegúrate de cerrar sesión una vez que hayas terminado de usar la aplicación:

1. Haz clic en tu nombre de usuario o en el botón de perfil en la esquina superior de la pantalla.
2. Selecciona "Cerrar sesión" del menú desplegable.

Siguiendo estas instrucciones, podrás disfrutar de todas las características y funcionalidades que Globaly Gaming Score tiene para ofrecer.


## Contribuir

Instrucciones sobre cómo otros desarrolladores pueden contribuir a tu proyecto.
1. Realiza un fork del repositorio.
2. Crea una nueva rama para tus cambios.
3. Envía un pull request con tus modificaciones para revisión.

## Licencia

Información sobre la licencia bajo la cual se distribuye el proyecto.

## Contacto

Información sobre cómo ponerse en contacto contigo o con el equipo del proyecto para preguntas o contribuciones.


### Additional Notes:
- **Licencia**: Debes incluir el tipo de licencia bajo la cual se distribuye el proyecto. Si aún no has decidido, puedes considerar opciones como MIT, GPL, etc.
- **Contacto**: Proporciona un correo electrónico o un enlace para que los usuarios puedan ponerse en contacto contigo o con el equipo de desarrollo.
- **Personalización**: Asegúrate de personalizar las secciones como "Descripción" y "Contribuir" para reflejar los detalles específicos y las políticas de tu proyecto.

