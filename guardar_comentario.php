<?php
include './DAL/conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO($dsn, $user, $pass, $options);
    session_start();
    
    if (!isset($_SESSION['usuario_id'])) {
        echo "Debes iniciar sesión para dejar un comentario.";
        exit;
    }

    $juego_id = $_POST["juego_id"];
    $contenido = $_POST["comentario"];
    $usuario_id = $_SESSION['usuario_id'];
    $fecha = date("Y-m-d H:i:s"); // Obtiene la fecha y hora actual

    // Realiza una inserción en la tabla de comentarios
    $stmt = $pdo->prepare("INSERT INTO comentarios (juego_id, usuario_id, contenido, fecha) VALUES (:juego_id, :usuario_id, :contenido, :fecha)");
    $stmt->execute(['juego_id' => $juego_id, 'usuario_id' => $usuario_id, 'contenido' => $contenido, 'fecha' => $fecha]);

    // // Obtiene el nombre del usuario
    // $stmt = $pdo->prepare("SELECT nombre_usuario FROM usuarios WHERE usuario_id = :usuario_id");
    // $stmt->execute(['usuario_id' => $usuario_id]);
    // $user = $stmt->fetch();
    // $nombreUsuario = $user['nombre_usuario'];

    // echo json_encode(['nombre_usuario' => $nombreUsuario, 'fecha' => $fecha]);
}







