<?php
require_once './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cambia estas variables por tus credenciales de producción reales
$host = 'your_production_host';
$db   = 'your_production_db';
$user = 'your_production_user';
$pass = 'your_production_password';
$charset = 'utf8';

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
            // Usar bin2hex(random_bytes(32)) es más seguro para generar tokens
            $token = bin2hex(random_bytes(32));
            $expira = date("Y-m-d H:i:s", strtotime("+1 hour")); // El token expira en 1 hora

            $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = :reset_token, token_expira = :token_expira WHERE email = :email");
            $stmt->execute([
                ':reset_token' => $token,
                ':token_expira' => $expira,
                ':email' => $email
            ]);

            $mail = new PHPMailer(true);
            // Configuración de PHPMailer para usar tu servidor SMTP de producción
            $mail->isSMTP();
            $mail->Host = 'your_production_smtp_server';
            $mail->SMTPAuth = true;
            $mail->Username = 'your_production_smtp_username';
            $mail->Password = 'your_production_smtp_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // o PHPMailer::ENCRYPTION_SMTPS si tu servidor lo requiere
            $mail->Port = 587; // o el puerto que tu servidor SMTP de producción requiera
            $mail->CharSet = 'UTF-8';
            // Remitente y destinatario
            $mail->setFrom('support@yourdomain.com', 'Nombre de tu Aplicación');
            $mail->addAddress($email);
            // Contenido del email
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            // Asegúrate de que la URL apunte al dominio de producción y use HTTPS
            $urlDeReset = "https://yourdomain.com/reset_password.php?token=" . $token . "&email=" . urlencode($email);
            $mail->Body = "<p>Por favor, haz clic en el siguiente enlace para restablecer tu contraseña:</p><p><a href='{$urlDeReset}'>Restablecer Contraseña</a></p>";

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

