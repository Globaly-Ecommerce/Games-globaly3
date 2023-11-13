<?php
session_start();
include '../../../DAL/conn.php'; // Asegúrate de que la ruta sea correcta


$juego_id = "4";
$stmt = $pdo->prepare("SELECT DISTINCT c.contenido, c.fecha, u.nombre_usuario FROM comentarios AS c JOIN usuarios AS u ON u.usuarios_id = c.usuario_id WHERE c.juego_id = :juego_id ORDER BY c.fecha;");
$stmt->execute(['juego_id' => $juego_id]);
$comentarios = $stmt->fetchAll();

$stmt = $pdo->query("SELECT u.nombre_usuario, MAX(score) AS highscore FROM scores AS s JOIN usuarios AS u ON u.usuarios_id = s.usuarios_id WHERE s.juego_id = $juego_id GROUP BY s.usuarios_id ORDER BY highscore DESC;");
$ranking = $stmt->fetchAll();
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Games-globaly2-main/";

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
        <?php
        include '../../../includes/navbar.php';
        ?>
        
        <!-- Header Area Start -->
       
        
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
                                        <img src="<?php echo $baseUrl; ?>assets/media/videos/DinoRun.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="content">
                                        <h2 class="color-white mb-8">Dino Run</h2>
                                        <p class="color-gray mb-32">Este Juego conciste en un dinosario el cual debe ir
                                            esquivando diversos obstaculos para así poder conseguir la mejor puntuación
                                            para así lograr ser la puntuacion mas alta.</p>
                                            <?php if (isset($_SESSION['nombre_usuario'])): ?>
        <a href="<?php echo $baseUrl; ?>views/Games/DinoRun/" class="cus-btn filled">
            <i class="far fa-play"></i> Jugar
        </a>
    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-1">
                        <div class="about-list">
                            <!DOCTYPE html>
                            <html lang="es">

                            <head>
                                <meta charset="UTF-8">
                                <title>Tu Juego</title>
                                <!-- Aquí puedes incluir enlaces a CSS, etc. -->
                                <script>
                                    function Puntua(puntajeAlto) {
                                        fetch('guardar_puntaje.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'puntaje=' + puntajeAlto,
                                        })
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log(data.message);
                                            })
                                            .catch(error => console.error('Error:', error));
                                    }

                                </script>
                            </head>

                            <body>

                                <!-- Aquí el contenido de tu juego y otros elementos de la página -->

                                <!-- División para mostrar el ranking -->
                                <div class="ranking">
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
                                </div>
                              </body>
                            </html>
                        </div>
                    </div>
                </div>
                <div class="raiting-list st-2">
                    <ul class="unstyled">

                    </ul>
                </div>
            </div>
        </section>

        <!-- Main Content Start -->
        <div class="page-content">

            <!-- Comments & Reviews Area start -->
            <section class="p-80">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="comments mb-64 mb-xl-0">
                                    <h3 class="color-white mb-8">Comments</h3>
                                    <p class="color-gray mb-32 link-text">We hope you have a good time browsing the comment section! <br> Please read our <b class="color-primary">Comments Policy </b>before commenting.</p>
                                    <div class="comment-form mb-32">
                        <h4>Comments</h4>
                        <form id="comment-form">
                            <input type="hidden" id="juego_id" name="juego_id" value="ID_DEL_JUEGO">
                            <input type="hidden" id="usuario_id" name="usuario_id" value=<?php echo $_SESSION['nombre_usuario'];?>>
                            <div class="input-group">
                                <input type="text" class="form-control p-0 border-0" name="comentario" id="comentario" required placeholder="Write your comment">
                                <button type="submit">Post</button>
                            </div>
                        </form>
                    </div>

                    <!-- Aquí comienza la sección de mostrar comentarios -->
                    <div class="existing-comments">
                        <h4>Existing Comments</h4>
                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="comment">
                                <p><strong>User:</strong> <?php echo htmlspecialchars($comentario['nombre_usuario']); ?></p>
                                <p><?php echo htmlspecialchars($comentario['contenido']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Aquí termina la sección de mostrar comentarios -->

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $("#comment-form").submit(function(event) {
                                event.preventDefault();
                        
                                var juego_id = 4;
                                var comentario = $("#comentario").val();
                                var usuario_id = $("#usuario_id").val();

                                // Realiza una solicitud AJAX para enviar el comentario al servidor
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo $baseUrl; ?>guardar_comentario.php", // Asegúrate de que la URL sea correcta
                                    data: { juego_id: juego_id, comentario: comentario, usuario_id : usuario_id },
                                    success: function(response) {
                                    }
                                });
                            });
                        });
                    </script>

                </div>
                </section>
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
                            <p class="color-gray mb-lg-0 mb-32">All rights reserved by Visual ©2023.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end text-center">
                            <a href="" class="ps-0">
                                <p class="color-gray">Privacy Policy</p>
                            </a>
                            <a href="">
                                <p class="color-gray">Comments Policy</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer Area end -->
        <!-- modal-popup area start  -->
        <div class="modal fade" id="videoModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="top_bar">
                        <h4 class="modal-title">Demon Slayer Season 4</h4>
                        <button type="button" class="close" id="closeVideoModalButton" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i> <b>Close</b></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal-popup area end  -->
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