<?php
session_start();
include '../../../DAL/conn.php'; // Verifica que la ruta sea correcta

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Redirigir al usuario a la página de login si no está logueado
    header('Location: /login.php'); // Ajusta esta ruta según sea necesario
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT score AS highscore FROM scores WHERE usuarios_id = ? AND juego_id = 4 ORDER BY score DESC LIMIT 1;");
$stmt->execute([$usuario_id]);

$userScore = $stmt->fetch(PDO::FETCH_ASSOC);
$highscore = $userScore ? $userScore['highscore'] : 0;
?>
<!DOCTYPE html>
<html lang="es"> <!-- Cambiado a "es" si tu audiencia principal habla español -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>DinoRun</title>
    <link rel="stylesheet" href="juego.css">
</head>
<body>
    <div class="contenedor" id="myGameCanvas">
        <div class="suelo"></div>
        <div class="dino dino-corriendo"></div>  
        <div class="score">0</div>
        <div class="high-score-text">
            <span class="high-score">Puntaje Máximo:</span>
            <span class="high-score-val"><?php echo $highscore; ?></span>
        </div>
        <div class="game-over" style="display:none;">GAME OVER</div>
        <div class="game-over-controls" style="display:none;">
            <button id="btnRestart">Reiniciar</button>
            <button id="btnBack">Regresar</button>
        </div>
    </div>
    <script src="juego.js"></script>
</body>
</html>
