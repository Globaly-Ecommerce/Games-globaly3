<?php
// Start the session
session_start();
// Check if the user is logged in
if (isset($_SESSION['usuario_id'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: '."iniciarSesion.php");
    exit();
} else {
    echo "You are not logged in.";
}
?>