<?php
session_start();
include '../.../../../../DAL/conn.php'; // Asegúrate de que la ruta sea correcta

$juego_id = "5";
$stmt = $pdo->prepare("SELECT DISTINCT c.contenido, c.fecha, u.nombre_usuario FROM comentarios AS c JOIN usuarios AS u ON u.usuarios_id = c.usuario_id WHERE c.juego_id = :juego_id ORDER BY c.fecha;");
$stmt->execute(['juego_id' => $juego_id]);
$comentarios = $stmt->fetchAll();

$stmt = $pdo->query("SELECT u.nombre_usuario, MAX(score) AS highscore FROM scores AS s JOIN usuarios AS u ON u.usuarios_id = s.usuarios_id WHERE s.juego_id = $juego_id GROUP BY s.usuarios_id ORDER BY highscore DESC;");
$ranking = $stmt->fetchAll();

$baseUrl = "https://" . $_SERVER['HTTP_HOST'] . "/applications/juegos/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
    <meta name="description" content="Visuals HTML5 Template">

    <title>Globaly Gaming Score</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUrl; ?>assets/media/favicon-light.png">

    <!-- All CSS files -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/slick.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/app.css">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-container">
            <div class="spinner">
                <div class="spinner">
                    <div class="spinner">
                        <div class="spinner">
                            <div class="spinner">
                                <div class="spinner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back To Top Start -->
    <a href="#main-wrapper" id="backto-top" class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Main Wrapper Start -->
    <div id="main-wrapper" class="main-wrapper overflow-hidden">

        <!-- Header Area Start -->

        <?php
        include '../../../includes/navbar.php';
        ?>

        <!-- Header Area end -->

        <!-- Anime detail banner Area start -->
        <section class="movie-detail-banner detail pt-80">
            <div class="container-fluid">
                <div class="row mb-32">
                    <div class="col-xl-8">
                        <div class="trailer mb-32">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="trailer-box">
                                        <img src="<?php echo $baseUrl; ?>views/Games/GlobyAdventure/portada.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="content">
                                        <h2 class="color-white mb-8">Globy Adventure</h2>
                                        <p class="color-gray mb-32">En "Globy Adventure", te adentras en el vasto espacio exterior, guiando a Globy, a través de un peligroso campo de columnas de fuego A medida que viajas, el desafío aumenta, las columnas se vuelven más frecuentes y la velocidad del juego se acelera.</p>

                                        <?php if (isset($_SESSION['nombre_usuario'])): ?>
        <a href="<?php echo $baseUrl; ?>views/Games/GlobyAdventure/" class="cus-btn filled">
            <i class="far fa-play"></i> Jugar
        </a>
    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!DOCTYPE html>
                    <html lang="es">

                    <head>
                        <meta charset="UTF-8">
                        <title>Tu Título de Página</title>
                        <!-- Aquí puedes incluir enlaces a CSS, etc. -->
                    </head>

                    <body>

                        <!-- Resto del contenido de tu página -->

                        <div class="col-xl-3 offset-xl-1">
                            <div class="about-list">
                                <h3 class="color-white mb-16">Ranking</h3>
                                <ul class="unstyled">
                                    <?php foreach ($ranking as $fila): ?>
                                        <li>
                                            <h6>Usuario:</h6>
                                            <h6 class="color-primary">
                                                <?php echo htmlspecialchars($fila['nombre_usuario']); ?>
                                            </h6>
                                            <h6>Puntos:</h6>
                                            <h6 class="color-primary">
                                                <?php echo htmlspecialchars($fila['highscore']); ?>
                                            </h6>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </body>

                    </html>
               <!-- Resto del contenido de tu página -->
</body>
</html>
<div class="raiting-list st-2">
    <ul class="unstyled">
    </ul>
</div>
</div>
</section>
<!-- Anime detail Area end -->

<!-- Main Content Start -->
<div class="page-content">

    <!-- Complete Collection Area start -->
    <section class="p-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8">
                    <div class="comments mb-64 mb-xl-0">
                        <h2 class="color-white mb-8">Deja un comentario</h2>
                        <p class="color-gray mb-32 link-text">
                            <br> Favor escribe un comentario<b class="color-primary">Comments Policy.
                        </p>
                        <!-- mensaje de enviado con exito -->
                        <div id="mensaje-exito" style="display: none; color: green; ">Enviado con éxito</div>
                        <div class="comment-form mb-32">
                                <h4>Comentarios</h4>
                                <form id="comment-form">
                                    <input type="hidden" id="juego_id" name="juego_id" value="<?php echo $juego_id; ?>">
                                    <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>">

                                    <!-- Textarea for writing comments -->
                                    <div class="input-group">
                                        <textarea class="form-control p-0 border-0" name="comentario" id="comentario" rows="4" required placeholder="Añade tu comentario aquí"></textarea>
                                        <button type="submit">Publicar</button>
                                    </div>
                                </form>
                            </div>


                        <!-- Aquí comienza la sección de mostrar comentarios -->
                        <div class="existing-comments">
                        <h4>Comentarios de Globy Adventure</h4>
                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="comment">
                                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($comentario['nombre_usuario']); ?></p>
                                <p><?php echo htmlspecialchars($comentario['contenido']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                        <!-- Aquí termina la sección de mostrar comentarios -->

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                function mostrarMensajeExito() {
                                        $("#mensaje-exito").fadeIn().delay(2000).fadeOut(); // Mostrar durante 2 segundos y luego ocultar
                                    }
                            // Función para cargar comentarios existentes
                            function cargarComentarios() {
                                $.ajax({
                                    type: "GET", // Cambia a GET para obtener comentarios
                                    data: { juego_id: 5 }, // Cambia el juego_id según sea necesario
                                    success: function(response) {
                                        // Actualiza la lista de comentarios con los comentarios obtenidos
                                        $("#comentarios-container").html(response);
                                    }
                                });
                            }

                            // Carga los comentarios existentes cuando la página se carga inicialmente
                            cargarComentarios();

                            // Establece un intervalo para cargar comentarios periódicamente (cada 10 segundos en este ejemplo)
                            setInterval(cargarComentarios, 1000); // 10000 milisegundos = 10 segundos

                            $("#comment-form").submit(function(event) {
                                event.preventDefault();
                            
                                var juego_id = 5;
                                var comentario = $("#comentario").val();
                                var usuario_id = $("#usuario_id").val();

                                // Realiza una solicitud AJAX para enviar el comentario al servidor
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo $baseUrl; ?>guardar_comentario.php", // Asegúrate de que la URL sea correcta
                                    data: { juego_id: juego_id, comentario: comentario, usuario_id: usuario_id },
                                    success: function(response) {
                                        // Limpia el campo de comentario después de enviarlo
                                        mostrarMensajeExito();

                                        $("#comentario").val("");
                                        // Carga los comentarios nuevamente después de agregar uno nuevo
                                        cargarComentarios();
                                    }
                                });
                            });
                        });
                    </script>


                    </div>
                    <!-- Main Content End -->

                    <!-- footer Area start -->
                    <footer class="footer pt-80">
                <div class="container-fluid">
                    <ul class="social-icon unstyled mb-32">
                        <li> <a href=""><img src="<?php echo $baseUrl; ?>assets/media/icons/instagram.png" alt=""></a></li>
                        <li> <a href=""><img src="<?php echo $baseUrl; ?>assets/media/icons/facebook.png" alt=""></a></li>
                        <li> <a href=""><img src="<?php echo $baseUrl; ?>assets/media/icons/twitter.png" alt=""></a></li>
                    </ul>
                    <div class="copyright-text">
                        <div class="row">
                            <div class="col-lg-4 offset-lg-4">
                                <p class="color-gray mb-lg-0 mb-32">Derechos reservados Globaly ©2023.</p>
                            </div>
                            <div class="col-lg-4 text-lg-end text-center">
                                <a href="" class="ps-0"><p class="color-gray">Privacy Policy</p></a>
                                <a href=""><p class="color-gray">Comments Policy</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
                    <!-- footer Area end -->
                </div>
                <!-- Jquery Js -->
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/jquery-3.6.3.min.js"></script>
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/bootstrap.min.js"></script>
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/jquery.countdown.min.js"></script>
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/slick.min.js"></script>
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/jquery-appear.js"></script>
                <script src="<?php echo $baseUrl; ?>assets/js/vendor/jquery-validator.js"></script>
                <!-- Site Scripts -->
                <script src="<?php echo $baseUrl; ?>assets/js/app.js"></script>
                </body>

                </html>