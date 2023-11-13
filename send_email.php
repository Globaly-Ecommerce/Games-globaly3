<?php
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    // Configuración del servidor
    $mail->isSMTP(); // Utilizar SMTP
    $mail->Host = 'sandbox.smtp.mailtrap.io'; // Servidor SMTP de Mailtrap
    $mail->SMTPAuth = true; // Habilitar autenticación SMTP
    $mail->Username = 'a22296fdf6883c'; // Usuario SMTP de Mailtrap
    $mail->Password = '1a084bcf43c066'; // Contraseña SMTP de Mailtrap
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar encriptación TLS; `PHPMailer::ENCRYPTION_SMTPS` también es aceptado
    $mail->Port = 587; // Puerto TCP para conectarse

    // Destinatarios
    $mail->setFrom('prueba@globaly.com', 'Globaly');  // Quien envía el correo
    $mail->addAddress('666@gmail.com', 'Joe User'); // A quién se envía

    // Contenido
    $mail->isHTML(true); // Establecer el formato de correo electrónico a HTML
    // Crear el enlace de restablecimiento de contraseña
    $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/applications/juegos/";    // Asegúrate de que esta es la URL base correcta de tu proyecto local
   $urlDeReset = $baseUrl . "reset_password.php?token=" . $token;
    $mail->Subject = 'Test';
    $mail->Body = 'Por favor, haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $urlDeReset . '">Restablecer Contraseña</a>';
    $mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo no HTML';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se pudo enviar. Error de PHPMailer: ', $mail->ErrorInfo;
}
