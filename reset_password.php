<?php
// reset_password.php
$error = '';
include './DAL/conn.php'; // Asegúrate de que este archivo contiene la conexión PDO correcta.

// Verificar si el token y el email están presentes en la URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Verificar el token y su tiempo de caducidad
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND reset_token = :token AND token_expira > NOW()");
    $stmt->execute(['email' => $email, 'token' => $token]);
    $user = $stmt->fetch();

    if ($user) {
        // Token válido, mostrar formulario para nueva contraseña
        // Elimina la necesidad de verificar el OTP nuevamente
    } else {
        echo "El enlace no es válido o ha expirado.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    // Verificar que las contraseñas coincidan
    if ($_POST['new_password'] == $_POST['confirm_password']) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $token = $_POST['token'];
        $email = $_POST['email'];

        // Verificar el token nuevamente por seguridad y actualizar la contraseña
        $stmt = $pdo->prepare("UPDATE usuarios SET clave = :new_password, reset_token = NULL, token_expira = NULL WHERE email = :email AND reset_token = :token");
        $stmt->execute(['new_password' => $new_password, 'email' => $email, 'token' => $token]);

        echo "Contraseña actualizada con éxito.";
        // Redirigir al usuario a la página de inicio de sesión
        header("Location: iniciarSesion.php");
        exit;
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="./assets/css/recuperar.css">
</head>
<body>
    <?php if (isset($user)): ?>
        <form action="reset_password.php" method="post">
            <h2>Restablecer Contraseña</h2>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" name="new_password" required>
            <label for="confirm_password">Confirmar Nueva Contraseña:</label>
            <input type="password" name="confirm_password" required>
            <input type="submit" value="Cambiar Contraseña">
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p> <!-- Muestra el mensaje de error -->
            <?php endif; ?>
            <!-- Botón de regresar usando PHP -->
        </form>
    <?php endif; ?>
</body>
</html>
