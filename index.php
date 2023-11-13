<?php
session_start();

// Verifica si el usuario está autenticado (por ejemplo, a través de la sesión)
if (isset($_SESSION['nombre_usuario'])) {
    $nombreUsuario = $_SESSION['nombre_usuario'];
} else {
    // Si el usuario no está autenticado, puedes asignar un valor por defecto o realizar una acción de manejo de error.
    $nombreUsuario = "Invitado"; // Ejemplo de un valor por defecto
}

$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Games-globaly2-main/";

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Visuals HTML5 Template">

        <title>Goblaly Gamig Score</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUrl; ?>assets/media/user-img/Globy.png">

        <!-- All CSS files -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/slick.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/font-awesome.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/vendor/slick-theme.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/app.css">
    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="spinner-container">
                <div class="spinner"><div class="spinner"><div class="spinner"><div class="spinner"><div class="spinner"><div class="spinner"></div></div></div></div></div></div>
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
            include './includes/navbar.php';
            ?>

            <!-- Header Area end -->

            <!-- Hero Area start -->
            <section class="hero-banner-1 variable-width">   
                <div class="item sm-active sm-dnone">
                    <img src="./assets/media/videos/TETRIS.jpg" class="slider-image" alt="">
                    <div class="content">
                        <a href="Tetris.html"><h2 class="color-white mb-32">Tetris</h2></a>
                        <ul class="card-tag unstyled">
                            <li><h5 class="color-primary">Nuevo</h5></li>
                         
                        </ul>

                        <div>
                            <a href="<?php echo $baseUrl; ?>views/Games/Tetris/" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                            <a href="<?php echo $baseUrl; ?>views/Rankings/Tetris/" class="cus-btn bordered ms-16"><i class="fal fa-info-circle"></i> Ranking</a>
                        </div>
                    </div>
                </div>
                <div class="item sm-active sm-dnone">
                    <img src="./assets/media/videos/red vs blue.jpg" class="slider-image" alt="">
                    <div class="content">
                        <a href="red vs blue.html"><h2 class="color-white mb-32">Red vs blue</h2></a>
                        <ul class="card-tag unstyled">
                            <li><h5 class="color-primary">Nuevo</h5></li>
                        </ul>

                    <div>
                        <a href="<?php echo $baseUrl; ?>views/Games/RedVsBlue"  class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                        <a href="<?php echo $baseUrl; ?>views/Rankings/RedVsBlue" class="cus-btn bordered ms-16"><i class="fal fa-info-circle"></i> Ranking</a>
                    </div>
                    </div>
                </div>
                <div class="item sm-active sm-dnone">
                    <img src="./assets/media/videos/globy villano.png" class="slider-image" alt="">
                    <div class="content">
                        <a href="Creeper.html"><h2 class="color-white mb-32">Creeper Annihilator</h2></a>
                        <ul class="card-tag unstyled">
                            <li><h5 class="color-primary">Nuevo</h5></li>
                           
                        </ul>
                       
                        <div>
                            <a href="<?php echo $baseUrl; ?>views/Games/Creeper/Creeper.php"  class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                            <a href="<?php echo $baseUrl; ?>views/Rankings/Creeper" class="cus-btn bordered ms-16"><i class="fal fa-info-circle"></i> Ranking</a>
                        </div>
                    </div>
                </div>
                <div class="item sm-active active">
                    <img src="assets/media/videos/dino ori.PNG" class="slider-image" alt="">
                    <div class="content">
                        <a href="juego/globy.html"><h2 class="color-white mb-32">Dino Run</h2></a>
                        <ul class="card-tag unstyled">
                            <li><h5 class="color-primary">Nuevo</h5></li>
                        </ul>
                        <div>
                            <a href="<?php echo $baseUrl; ?>views/Games/DinoRun/" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                            <a href="<?php echo $baseUrl; ?>views/Rankings/DinoRun/" class="cus-btn bordered ms-16"><i class="fal fa-info-circle"></i> Ranking</a>
                        </div>
                    </div>
                </div>
                <div class="item sm-active">
                    <img src="<?php echo $baseUrl; ?>views/Games/GlobyAdventure/portada.png" class="slider-image" alt="">
                    <div class="content">
                        <a href="anime-detail.html"><h2 class="color-white mb-32">Flappy Globy</h2></a>
                        <ul class="card-tag unstyled">
                            <li><h5 class="color-primary">Nuevo</h5></li>
                        </ul>
                        <div class="time mb-32">

                        </div>
                        <div>
                        <a href="<?php echo $baseUrl; ?>views/Games/GlobyAdventure/" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                        <a href="<?php echo $baseUrl; ?>views/Rankings/GlobyAdventure/" class="cus-btn bordered ms-16"><i class="fal fa-info-circle"></i> Ranking</a>
                        </div>
                    </div>
                </div>
          
                </div>
            </section>
            <!-- Hero Area end -->
            
            <!-- Main Content Start -->
            <div class="page-content">
                <!-- trending Area start -->
                <section class="trending p-80">
                    <div class="container-fluid">
                        <h2 class="color-white mb-48">Nuestros Juegos</h2>
                        <div class="scrolling">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="trend-block">
                                        <div class="row">
                                            <div class="col-sm-6 pe-lg-0">
                                                <div class="text">
                                                    <h4>Tetris</h4>
                                                    <h2>01</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ps-lg-0">
                                                <div class="img-block">
                                                    <img src="./assets/media/videos/TETRIS.jpg" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="btn-block">
                                                        <a href="<?php echo $baseUrl; ?>views/Games/Tetris/" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="trend-block">
                                        <div class="row">
                                            <div class="col-sm-6 pe-lg-0">
                                                <div class="text st-2">
                                                    <h4>Red vs Blue</h4>
                                                    <h2>02</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ps-lg-0">
                                                <div class="img-block">
                                                    <img src="./assets/media/videos/red vs blue.jpg" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="btn-block">
                                                        <a href="<?php echo $baseUrl; ?>views/Games/RedVsBlue" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="trend-block">
                                        <div class="row">
                                            <div class="col-sm-6 pe-lg-0">
                                                <div class="text st-3">
                                                    <h4>Creeper Annihilator</h4>
                                                    <h2>03</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ps-lg-0">
                                                <div class="img-block">
                                                    <img src="./assets/media/videos/globy villano3.png" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="btn-block">
                                                        <a href="<?php echo $baseUrl; ?>views/Games/Creeper/" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="trend-block">
                                        <div class="row">
                                            <div class="col-sm-6 pe-lg-0">
                                                <div class="text st-4">
                                                    <h4>DinoRun</h4>
                                                    <h2>04</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ps-lg-0">
                                                <div class="img-block">
                                                    <img src="./assets/media/videos/Dinooorun.PNG" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="btn-block">
                                                        <a href="<?php echo $baseUrl; ?>views/Games/DinoRun" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="trend-block">
                                        <div class="row">
                                            <div class="col-sm-6 pe-lg-0">
                                                <div class="text st-5">
                                                    <h4>Globy Adventure</h4>
                                                    <h2>05</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ps-lg-0">
                                                <div class="img-block">
                                                    <img src="<?php echo $baseUrl; ?>views/Games/GlobyAdventure/portada.png" alt="">
                                                    <div class="overlay"></div>
                                                    <div class="btn-block">
                                                        <a href="<?php echo $baseUrl; ?>views/Games/GlobyAdventure" class="cus-btn filled"><i class="far fa-play"></i> Jugar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                               
                    </div>
                </section>
                <!-- trending Area end -->
            
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
                                <p class="color-gray mb-lg-0 mb-32">All rights reserved by Globaly ©2023.</p>
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

            <!-- modal-popup area start  -->
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