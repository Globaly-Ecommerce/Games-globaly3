<?php
session_start();

// Verifica si el usuario está autenticado (por ejemplo, a través de la sesión)
if (isset($_SESSION['nombre_usuario'])) {
    $nombreUsuario = $_SESSION['nombre_usuario'];
} else {
    // Si el usuario no está autenticado, puedes asignar un valor por defecto o realizar una acción de manejo de error.
    $nombreUsuario = "Invitado"; // Ejemplo de un valor por defecto
}
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
        <link rel="shortcut icon" type="image/x-icon"
            href="assets/media/user-img/Globy.png">

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
            <header>
                <div class="container-fluid">
                    <div class="d-xl-block d-none">
                        <nav class="navbar navbar-expand-xl p-0">
                            <a class="navbar-brand dark-logo d-xl-none" href="index.php"><img alt=""
                                    src="./assets/media/videos/preuba2-PhotoRoom.png-PhotoRoom.png"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mynavbar">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="mynavbar">
                                <div class="col-xl-5">
                                    <ul class="navbar-nav mainmenu m-0">
                                        <li class="menu-item-has-children">
                                            <a href="index.php">Home</a>
                                        </li>
    
                                    </ul>
                                </div>
                                <div class="col-xl-2 text-center xl-logo">
                                    <a class="navbar-brand m-0 p-0" href="index.php"><img alt=""
                                            src="./assets/media/videos/preuba2-PhotoRoom.png-PhotoRoom.png"></a>
                                </div>
                                <div class="col-xl-5 text-end">
                                    <ul class="right-nav navbar-nav mainmenu align-items-center justify-content-end m-0">
                                        <li class="menu-item-has-children m-0 st-2">
                                            <a href="javascript:void(0);"><img src="./assets/media/user-img/Globy.png"
                                                    class="me-2" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Header Area end -->

            <!-- signup Area Start  -->
            <section class="signup text-center">
                <div class="container-fluid">
                    <div class="signup-block">
                        <h1 class="color-white mb-32">Registro</h1>
                        <form action="registro.php" method="post">
                            <div class="mb-32">
                                <input type="email" name="email" class="form-control mb-32" placeholder="Correo Electrónico">
                            </div>
                            <div class="mb-32">
                                <input type="text" name="nombre" class="form-control mb-32" placeholder="Nombre">
                            </div>
                            <div class="mb-32">
                                <input type="password" name="clave" class="form-control mb-32" placeholder="Contraseña">
                            </div>
                            <div class="text-center">
                                <button   class="cus-btn filled mb-32 w-100">Registrarse</button>
                                
                            </div>
                        </form>
                        <div class="text-center">
                            <h6>Ya tienes cuenta? <a href="<?php echo $baseUrl; ?>iniciarSesion.php" class="color-primary">Iniciar Sesión</a></h6>

                        </div>
                    </div>
                </div>
            </section>

            <!-- footer Area start -->
            <footer class="footer pt-80">
                <div class="container-fluid">
                    <ul class="social-icon unstyled mb-32">
                        <li> <a href=""><img src="assets/media/icons/instagram.png" alt=""></a></li>
                        <li> <a href="https://www.facebook.com/globaly1/about"><img src="assets/media/icons/facebook.png" alt=""></a></li>
                        <li> <a href=""><img src="assets/media/icons/twitter.png" alt=""></a></li>
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