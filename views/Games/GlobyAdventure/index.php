<?php
session_start();
include '../../../DAL/conn.php'; // Asegúrate de que la ruta sea correcta

$stmt = $pdo->prepare("SELECT score AS highscore FROM scores WHERE usuarios_id = ? AND juego_id = 5;");
$stmt->execute([$_SESSION['usuario_id']]);
$userScore = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica si $userScore es un array antes de intentar mostrar la puntuación.
$highScore = $userScore ? $userScore['highscore'] : '0';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title> Globy Adventure</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="game-container mb-4">
            <canvas id="gameCanvas" class="game-canvas" width="800" height="600"></canvas>
        </div>
        <div class="username-container">
            <div class="button-container">
                <button id="restartButton" class="btn btn-danger mt-2 hide">Reiniciar</button>
                <button id="btnBack">Regresar</button>
            </div>
            <div class="high-score-text">
                <span class="high-score"><?php echo htmlspecialchars($highScore); ?></span>
            </div>
        </div>
    </div>
    <script src="script2.js"></script>
</body>
</html>

