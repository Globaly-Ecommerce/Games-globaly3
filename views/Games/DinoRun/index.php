<?php
session_start();
include '../../../DAL/conn.php'; // Asegúrate de que la ruta sea correcta

$stmt = $pdo->prepare("SELECT score AS highscore FROM scores WHERE usuarios_id = ? AND juego_id = 4;");
$stmt->execute([$_SESSION['usuario_id']]); // Reemplaza $_SESSION['usuario_id'] con la variable correcta que almacena el ID del usuario.

$userScore = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DinoRun</title>
    <link rel="stylesheet" href="juego.css">
</head>
<body>
    <div class="contenedor">
        <div class="suelo"></div>
        <div class="dino dino-corriendo"></div>  
        <div class="score">0</div>
        <div class="high-score-text">
            <span class="high-score">High Score:</span>
            <span class="high-score high-score-val"><?php echo $userScore['highscore']; ?></span>
        </div>
        <div class="contenedor-botones">
           
        </div>
    </div>
    <div class="game-over">GAME OVER</div>
</body>
<script src="juego.js"></script>
</html>


    

