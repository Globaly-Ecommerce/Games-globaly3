<?php
// Conexión a la base de datos
require "./DAL/conn.php";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}


try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
        $clave = $_POST["clave"];

        // Solo selecciona al usuario por su email
        $stmt = $pdo->prepare("SELECT usuarios_id, nombre_usuario, email, clave FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            die("No se encontró el usuario con el correo proporcionaaado.");
        }

        // Usa password_verify() para comparar la clave ingresada con la clave hasheada
        if (password_verify($clave, $usuario['clave'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['usuarios_id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            header('Location: '."index.php");
        } else {
            echo "Credenciales incorrectas. Por favor, inténtalo nuevamente.";
        }
    }
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
