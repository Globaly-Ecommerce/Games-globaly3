<?php
if (isset($_SESSION['usuario_id'])) {
    $username = $_SESSION['nombre_usuario'];
} else {
    $username = "Invitado";
}

$baseUrl = "https://" . $_SERVER['HTTP_HOST'] . "/applications/juegos/";
?>

<header>
    <div class="container-fluid">
        <div class="d-xl-block d-none">
            <nav class="navbar navbar-expand-xl p-0">
                <a class="navbar-brand dark-logo d-xl-none" href="index.php"><img alt="Logo Globaly"
                        src="<?php echo $baseUrl; ?>assets/media/videos/logomobile.png"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <div class="col-xl-5">
                        <ul class="navbar-nav mainmenu m-0">
                            <li class="menu-item-has-children">
                                <a href="<?php echo $baseUrl; ?>index.php">Home</a>
                                <ul class="submenu">
                                    <li><a href="<?php echo $baseUrl; ?>index.php">Home</a></li>
                                </ul>
                            <li class="menu-item-has-children ">
                                <a href="javascript:void(0);" class="active">Ranking</a>
                                <ul class="submenu">
                                    <li><a href="<?php echo $baseUrl; ?>views/Rankings/Tetris/" class="active">Tetris</a></li>
                                    <li><a href="<?php echo $baseUrl; ?>views/Rankings/Creeper/" class="active">Creep Annihilator</a></li>
                                    <li><a href="<?php echo $baseUrl; ?>views/Rankings/RedVsBlue/" class="active">Red vs Blue</a></li>
                                    <li><a href="<?php echo $baseUrl; ?>views/Rankings/DinoRun/" class="active">DinoRun</a></li>
                                    <li><a href="<?php echo $baseUrl; ?>views/Rankings/GlobyAdventure/" class="active">GlobyAdventure</a></li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children ">
                                <a href="javascript:void(0);" class="active"></a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-xl-2 d-flex justify-content-center align-items-center xl-logo">
                        <a class="navbar-brand m-0 p-0" href="<?php echo $baseUrl; ?>index.php">
                            <img alt="" src="<?php echo $baseUrl; ?>assets/media/videos/logo.png" >
                        </a>
                    </div>
                    <div class="col-xl-5 text-end">
                        <ul class="right-nav navbar-nav mainmenu align-items-center justify-content-end m-0">
                            <li class="menu-item-has-children m-0 st-2 me-4">
                                <?php
                                if (isset($_SESSION['usuario_id'])) {
                                    echo '<h5>' . htmlspecialchars($username) . '</h5>';
                                } else {
                                    echo '<h5>' . htmlspecialchars($username) . '</h5>';
                                }
                                ?>
                            </li>


                            <li class="menu-item-has-children m-0 st-2">
                                <a href="javascript:void(0);"><img
                                        src="<?php echo $baseUrl; ?>assets/media/user-img/Globy.png" class="me-4"
                                        alt=""><i class="far fa-angle-down "></i></a>
                                <ul class="submenu">
                                    <?php
                                    if (isset($_SESSION['usuario_id'])) {
                                        echo '<li><a href="' . $baseUrl . 'logout.php" class="mb-1 cus-btn filled color-dark">Log Out</a></li>';
                                    } else {
                                        echo '<li><a href="' . $baseUrl . 'iniciarSesion.php" class="mb-1 cus-btn filled color-dark">Log In</a></li>';
                                    }

                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<header class="st-2">
    <div class="container-fluid">
        <div class="mobile-menu">
            <div class="hamburger-menu">
                <div class="bar"></div>
            </div>
        </div>
        <nav class="mobile-navar d-xl-none">
            <ul>
                <li class="has-children active">Home <span class="icon-arrow"></span>
                    <ul class="children">
                        <li><a href="./index.php">Home</a></li>

                    </ul>
                </li>
                <li class="has-children">Ranking <span class="icon-arrow"></span>
                    <ul class="children">
                        <li><a href="<?php echo $baseUrl; ?>views/Rankings/Tetris/" class="active">Tetris</a></li>
                        <li><a href="<?php echo $baseUrl; ?>views/Rankings/Creeper/" class="active">Creep Annihilator</a></li>
                        <li><a href="<?php echo $baseUrl; ?>views/Rankings/RedVsBlue/" class="active">Red vs Blue</a></li>
                        <li><a href="<?php echo $baseUrl; ?>views/Rankings/DinoRun/" class="active">DinoRun</a></li>
                        <li><a href="<?php echo $baseUrl; ?>views/Rankings/GlobyAdventure/" class="active">GlobyAdventure</a></li>
                    </ul>
                </li>
                <li class="has-children">Log in <span class="icon-arrow"></span>
                    <ul class="children">
                        <li><a href="<?php echo $baseUrl; ?>iniciarSesion.php" class="active">Log in</a></li>
                    </ul>
                </li>
                
            </ul>
        </nav>
    </div>
</header>