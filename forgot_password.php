<!-- forgot_password.php -->
<?php
session_start();
$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['message'], $_SESSION['error']);
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/applications/juegos/";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="./assets/css/recuperar.css">
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="success">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="password_recovery.php" method="post">
        <h2>Recuperar Contraseña</h2>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <input type="submit" value="Enviar Solicitud">
        <a href="iniciarSesion.php" class="button">Regresar</a>
    </form>
</body>
</html>
