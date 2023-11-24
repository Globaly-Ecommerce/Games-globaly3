<?php
require_once './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Credenciales de producción reales
$host = 'production_host';
$db   = 'production_db';
$user = 'production_user';
$pass = 'production_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = $_POST["email"];
        $stmt = $pdo->prepare("SELECT usuarios_id FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expira = date("Y-m-d H:i:s", strtotime("+1 hour")); 

            $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = :reset_token, token_expira = :token_expira WHERE email = :email");
            $stmt->execute([
                ':reset_token' => $token,
                ':token_expira' => $expira,
                ':email' => $email
            ]);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.productionserver.com'; // Servidor SMTP de producción
            $mail->SMTPAuth = true;
            $mail->Username = 'smtp_production_username';
            $mail->Password = 'smtp_production_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('noreply@globaly.com', 'Globaly Gaming Score');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            
            // URL absoluta para entorno de producción
            $urlDeReset = "https://www.yourdomain.com/reset_password.php?token=" . $token . "&email=" . urlencode($email);

            // Asegúrate de que esta URL es accesible públicamente y apunta a la imagen correcta
            $imageUrl = 'https://www.yourdomain.com/assets/media/videos/modelosa.png';

            $mail->Body = "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Password Reset</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                        color:white;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #434343;
                        border: 1px solid #ddd;
                        border-radius:5px;
                    }
                    .header {
                        text-align: center;
                        padding-bottom: 20px;
                    }
                    .content {
                        text-align: left;
                    }
                    .footer {
                        text-align: center;
                        padding-top: 20px;
                        font-size: 0.8em;
                        color: #fffffff;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <img src='{$imageUrl}' alt='Recovery Image' width='200'>
                    </div>
                    <div class='content'>
                        <h1>Restauración de Contraseña</h1>
                        <p>Por favor, haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                        <p><a href='{$urlDeReset}'>Restablecer Contraseña</a></p>
                    </div>
                    <div class='footer'>
                        &copy; 2023 Globaly Gaming Score. All rights reserved.
                    </div>
                </div>
            </body>
            </html>";
            
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } else {
            echo "El correo electrónico no está registrado.";
        }
    }
} catch (PDOException $e) {
    echo 'Error de conexión a la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'El mensaje no se pudo enviar. Error de PHPMailer: ' . $mail->ErrorInfo;
}
?>
