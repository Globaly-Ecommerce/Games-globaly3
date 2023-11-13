<?php
session_start(); // Iniciar la sesión
require "./DAL/conn.php";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if ($data !== null && isset($_SESSION['usuario_id'])) {
        $usuarios_id = $_SESSION['usuario_id']; // Usar el ID del usuario de la sesión
        $juego_id = $data['juego_id'];
        $puntuacion = $data['puntuacion'];

        // Verificar si ya existe un registro
        $stmt3 = $pdo->prepare("SELECT usuarios_id FROM scores WHERE usuarios_id = :usuarios_id AND juego_id = :juego_id;");
        $stmt3->execute(['usuarios_id' => $usuarios_id, 'juego_id' => $juego_id]);

        if ($stmt3->rowCount() > 0) {
            // Actualizar puntuación existente
            $stmt3 = $pdo->prepare("UPDATE scores SET score = :puntuacion WHERE usuarios_id = :usuarios_id AND juego_id = :juego_id;");
            $stmt3->execute(['puntuacion' => $puntuacion, 'usuarios_id' => $usuarios_id, 'juego_id' => $juego_id]);
        } else {
            // Insertar nueva puntuación
            $stmt3 = $pdo->prepare("INSERT INTO scores (usuarios_id, juego_id, score) VALUES (:usuarios_id, :juego_id, :puntuacion)");
            $stmt3->execute(['usuarios_id' => $usuarios_id, 'juego_id' => $juego_id, 'puntuacion' => $puntuacion]);
        }
    } else {
        echo "Error: Usuario no autenticado o datos faltantes.";
    }
} catch (PDOException $e) {
    // Manejar el error
    error_log("Error de conexión a la base de datos: " . $e->getMessage());
    echo "Error de conexión a la base de datos. Por favor, inténtelo de nuevo más tarde.";
}
?>