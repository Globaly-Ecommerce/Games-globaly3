 <?php
session_start();
include '../../../DAL/conn.php'; // Asegúrate de que la ruta sea correcta

$stmt = $pdo->prepare("SELECT score AS highscore FROM scores WHERE usuarios_id = ? AND juego_id = 3;");
$stmt->execute([$_SESSION['usuario_id']]);
$userScore = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica si $userScore es un array antes de intentar mostrar la puntuación.
$highScore = $userScore ? $userScore['highscore'] : '0';
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #070707;
    }

    canvas {
      border: 2px solid #000;
      background-image: url("stone.jpg");
      background-size: cover;
    }

    #startButton {
      background-color: #4caf50;
      color: white;
      padding: 12px 28px;
      font-size: 28px;
      border: none;
      cursor: pointer;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
    }

    #startButton:hover {
      background-color: #45a049;
      box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
    }

    #startButton:active {
      background-color: #3d8b3d;
      transform: scale(0.95);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    h1.title {
      text-align: center;
      margin-bottom: 20px;
      text-transform: uppercase;
      font-size: 48px;
      font-family: "Impact", sans-serif;
      letter-spacing: 3px;
      color: #2ecc71;
      position: relative;
      animation: pulse 2s infinite alternate;
    }

    @keyframes pulse {
      from {
        transform: scale(1);
        text-shadow: 2px 2px 4px black;
      }

      to {
        transform: scale(1.1);
        text-shadow: 4px 4px 6px black;
      }
    }

    h1.title::before {
      content: attr(data-title);
      position: absolute;
      top: -2px;
      left: -2px;
      z-index: -1;
      font-size: 48px;
      font-family: "Impact", sans-serif;
      letter-spacing: 3px;
      color: #27ae60;
    }

    @media (max-width: 768px) {
      h1.title {
        font-size: 36px;
      }

      h1.title::before {
        font-size: 36px;
      }
    }

    #globyChar {
      position: absolute;
      top: 0%;
      left: 50%;
      transform: translateY(-0%);
      transform: translateX(-50%);
    }
    /* Estilos para pantallas de tamaño mediano (tablets) */
@media screen and (max-width: 768px) {
    #gameCanvas {
        width: 100%;
        height: auto;
    }
}

/* Estilos para pantallas pequeñas (teléfonos móviles) */
@media screen and (max-width: 480px) {
    #gameCanvas {
        width: 100%;
        height: auto;
    }
}

  </style>
  <title>Creep Annihilator</title>
</head>

<body>
  <canvas id="gameCanvas" width="800" height="600"></canvas>

  <input type="hidden" name="highscore" id="highscore" value="<?php echo $highScore ?>">

  <div id="globyChar">
    <img src="../../../assets/media/globyChar.png" height="96px" alt="globy malo" />
  </div>

  <div id="gameOverScreen" style="
        display: none;
        position: absolute;
        top: 38%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
      ">
    <h1 class="title" data-title="Creep Annihilator">Creep Annihilator</h1>
    <button id="startButton" style="
          background-color: green;
          color: white;
          padding: 10px 20px;
          font-size: 24px;
        ">
      Start
    </button>
    <audio id="creepAudio" src="creep.mp3" preload="auto"></audio>
  </div>
  '

  <script>
   

    function enviarPuntuacion(puntaje) {
      highScore = document.querySelector("#highscore").value;
      console.log("HIGHSCORE: " + highScore)
      if (puntaje > highScore) {
        // Datos que deseas enviar en la solicitud POST
        const data = {
          juego_id: "3",
          puntuacion: puntaje,
        };

        // URL a la que deseas enviar la solicitud POST (Replace with the actual URL)
        const url = "../../../guardar_puntuacion.php";

        // Configurar la solicitud POST
        const requestOptions = {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        };

        // Realizar la solicitud POST
        fetch(url, requestOptions)
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "La solicitud no pudo completarse correctamente."
              );
            }
            // Check if the response has content
            if (response.headers.get("content-length") === "0") {
              throw new Error("La respuesta del servidor está vacía.");
            }
            return response.json(); // Parse the JSON response
          })
          .then((responseData) => {
            // Check if the response data is empty or not valid JSON
            if (!responseData) {
              throw new Error(
                "La respuesta del servidor no contiene datos JSON válidos."
              );
            }
            // Handle the response data from the server if needed
            console.log("Respuesta del servidor:", responseData);
          })
          .catch((error) => {
            console.error("Error al realizar la solicitud POST:", error);
          });
      }
    }

    // ... Resto de tu script de juego ...

    let highScore = 0;
    let lastTapTime = 0;

    const canvas = document.getElementById("gameCanvas");
    const ctx = canvas.getContext("2d");
    const startButton = document.getElementById("startButton");
    const creepAudio = document.getElementById("creepAudio");

    function playCreepAudio() {
      creepAudio.volume = 0.5;
      creepAudio.play();
    }

    function stopCreepAudio() {
      creepAudio.pause();
      creepAudio.currentTime = 0;
    }
    function setBackgroundImage() {
      const backgroundImages = ["stone.jpg", "grass.jpg"];
      const randomBackground =
        backgroundImages[Math.floor(Math.random() * backgroundImages.length)];
      const backgroundImage = new Image();
      backgroundImage.src = randomBackground;
      backgroundImage.onload = () => {
        canvas.style.backgroundImage = `url('${randomBackground}')`;
      };
    }

    setBackgroundImage();

    startButton.addEventListener("click", () => {
      resetGame();
      startNextLevel();
      draw();
      document.getElementById("gameOverScreen").style.display = "none";
      playCreepAudio();
    });

    class Player {
      constructor(x, y, width, height) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.armX = this.x + this.width / 2;
        this.armY = this.y;
        this.handRadius = 25;
        this.fingerWidth = 4;
        this.fingerHeight = 25;
        this.fingerSpacing = 6;
        this.isShooting = false;
        this.arrows = [];
      }

      draw() {
        ctx.fillStyle = "#444";
        ctx.fillRect(this.x, this.y, this.width, this.height);

        ctx.strokeStyle = "#777";
        ctx.lineWidth = 8;
        ctx.lineCap = "round";
        ctx.beginPath();
        ctx.moveTo(this.x + this.width / 2, this.y);
        ctx.lineTo(this.armX, this.armY);
        ctx.stroke();
        ctx.closePath();

        const armBaseX = this.x + this.width / 2;
        const armBaseY = this.y;
        const handX = armBaseX;
        const handY = armBaseY;

        ctx.beginPath();
        ctx.arc(handX, handY, this.handRadius, 0, Math.PI * 2);
        ctx.fillStyle = "#777";
        ctx.fill();
        ctx.lineWidth = 6;
        ctx.strokeStyle = "#999";
        ctx.stroke();
        ctx.closePath();

        const fingerPositions = [-2, -1, 0, 1, 2];
        for (const fingerPos of fingerPositions) {
          const fingerX =
            handX + fingerPos * (this.fingerWidth + this.fingerSpacing);
          const fingerY = handY - this.handRadius * 2;

          ctx.fillStyle = "#555";
          ctx.fillRect(
            fingerX,
            fingerY + this.fingerHeight - 8,
            this.fingerWidth,
            8
          );

          ctx.fillStyle = "#777";
          ctx.fillRect(fingerX, fingerY, this.fingerWidth, this.fingerHeight);

          ctx.beginPath();
          ctx.arc(
            fingerX + this.fingerWidth / 2,
            fingerY + this.fingerHeight,
            this.fingerWidth / 2,
            0,
            Math.PI
          );
          ctx.fillStyle = "#777";
          ctx.fill();
          ctx.lineWidth = 3;
          ctx.strokeStyle = "#999";
          ctx.stroke();

          ctx.fillStyle = "#888";
          ctx.fillRect(
            fingerX + 2,
            fingerY + this.fingerHeight - 8,
            this.fingerWidth - 4,
            4
          );
        }

        if (this.isShooting) {
          this.shootArrow();
        }

        this.arrows.forEach((arrow, index) => {
          arrow.draw();
          arrow.move();
          if (arrow.y < 0) {
            this.arrows.splice(index, 1);
          }
        });
      }

      shootArrow() {
        const arrowX = this.armX;
        const arrowY = this.armY - this.handRadius - 10;
        this.arrows.push(new Arrow(arrowX, arrowY));
      }
    }
    class Arrow {
      constructor(x, y) {
        this.x = x;
        this.y = y;
        this.width = 8;
        this.height = 50;
        this.speed = 3;
      }

      draw() {
        const shaftExtension = 10;
        const woodenGradient = ctx.createLinearGradient(
          this.x,
          this.y,
          this.x,
          this.y + this.height - 20 + shaftExtension
        );
        woodenGradient.addColorStop(0, "#8B4513");
        woodenGradient.addColorStop(1, "#D2691E");
        ctx.fillStyle = woodenGradient;
        ctx.beginPath();
        ctx.moveTo(this.x + this.width / 2, this.y);
        ctx.lineTo(
          this.x + this.width / 2,
          this.y + this.height - 20 + shaftExtension
        );
        ctx.lineTo(this.x, this.y + this.height - 20 + shaftExtension);
        ctx.lineTo(
          this.x + this.width,
          this.y + this.height - 20 + shaftExtension
        );
        ctx.closePath();
        ctx.fill();

        ctx.fillStyle = "#808080";
        ctx.beginPath();
        ctx.moveTo(this.x, this.y);
        ctx.lineTo(this.x + this.width / 2, this.y - 15);
        ctx.lineTo(this.x + this.width, this.y);
        ctx.closePath();
        ctx.fill();
      }

      move() {
        this.y -= this.speed;
      }

      hitCreeper(creeper) {
        if (!creeper.isHit) {
          if (creeper.size > 30) {
            creeper.isHit = true;
            score += 100;
            return true;
          } else if (creeper.size > 20) {
            creeper.isHit = true;
            score += 100;
            creeper.size -= 10;
            return true;
          }
        }
        return false;
      }
    }

    class Creeper {
      constructor(x, y, size) {
        this.x = x;
        this.y = y;
        this.size = size;
        this.isHit = false;
      }

      update() {
        this.y += 7;
      }

      draw() {
        if (this.size > 10) {
          ctx.fillStyle = "#00ff00";
          ctx.fillRect(
            this.x,
            this.y + this.size * 0.2,
            this.size,
            this.size * 0.6
          );
          ctx.fillStyle = "#00cc00";
          ctx.fillRect(
            this.x + this.size * 0.15,
            this.y,
            this.size * 0.7,
            this.size * 0.3
          );
          ctx.fillRect(
            this.x + this.size * 0.1,
            this.y + this.size * 0.3,
            this.size * 0.8,
            this.size * 0.3
          );

          ctx.fillStyle = "#000";
          ctx.fillRect(
            this.x + this.size * 0.25,
            this.y + this.size * 0.1,
            this.size * 0.1,
            this.size * 0.1
          );
          ctx.fillRect(
            this.x + this.size * 0.65,
            this.y + this.size * 0.1,
            this.size * 0.1,
            this.size * 0.1
          );
          ctx.fillRect(
            this.x + this.size * 0.4,
            this.y + this.size * 0.3,
            this.size * 0.2,
            this.size * 0.1
          );
          ctx.fillRect(
            this.x + this.size * 0.3,
            this.y + this.size * 0.45,
            this.size * 0.1,
            this.size * 0.1
          );
          ctx.fillRect(
            this.x + this.size * 0.6,
            this.y + this.size * 0.45,
            this.size * 0.1,
            this.size * 0.1
          );

          ctx.fillStyle = "#00ff00";
          ctx.fillRect(
            this.x + this.size * 0.1,
            this.y + this.size * 0.6,
            this.size * 0.8,
            this.size * 0.25
          );
          ctx.fillRect(
            this.x + this.size * 0.05,
            this.y + this.size * 0.85,
            this.size * 0.9,
            this.size * 0.15
          );
        }
      }

      update() {
        this.y += 6;
      }
    }

    const player = new Player(
      canvas.width / 2 - 25,
      canvas.height - 75,
      50,
      50
    );
    const arrows = [];
    const creepers = [];
    let score = 0;
    let level = 0;
    let lives = 6;
    let canShoot = true;
    let isShooting = false;
    let gameOver = false;
    let gameWon = false;

    document.addEventListener("keydown", (event) => {
      if (event.key === " " && canShoot) {
        isShooting = true;
        shootArrow();
        canShoot = false;
      }
    });

    document.addEventListener("keyup", (event) => {
      if (event.key === " ") {
        isShooting = false;
        canShoot = true;
      }
    });

    function drawHearts() {
      const heartSize = 30;
      const padding = 10;

      const heartbeatScale = 1 + 0.1 * Math.sin(Date.now() * 0.005);

      for (let i = 0; i < lives; i++) {
        let heartX = canvas.width - 35 * (i + 1);
        let heartY = padding;

        const animatedHeartSize = heartSize * heartbeatScale;

        ctx.save();

        const gradient = ctx.createRadialGradient(
          heartX + animatedHeartSize / 2,
          heartY + animatedHeartSize / 2,
          animatedHeartSize / 8,
          heartX + animatedHeartSize / 2,
          heartY + animatedHeartSize / 2,
          animatedHeartSize / 2
        );
        gradient.addColorStop(0, "pink");
        gradient.addColorStop(1, "red");

        ctx.fillStyle = gradient;
        ctx.strokeStyle = "red";
        ctx.lineWidth = 2;

        ctx.beginPath();
        ctx.moveTo(heartX, heartY + animatedHeartSize / 4);
        ctx.quadraticCurveTo(
          heartX,
          heartY,
          heartX + animatedHeartSize / 4,
          heartY
        );
        ctx.quadraticCurveTo(
          heartX + animatedHeartSize / 2,
          heartY,
          heartX + animatedHeartSize / 2,
          heartY + animatedHeartSize / 4
        );
        ctx.quadraticCurveTo(
          heartX + animatedHeartSize / 2,
          heartY,
          heartX + (animatedHeartSize * 3) / 4,
          heartY
        );
        ctx.quadraticCurveTo(
          heartX + animatedHeartSize,
          heartY,
          heartX + animatedHeartSize,
          heartY + animatedHeartSize / 4
        );
        ctx.quadraticCurveTo(
          heartX + animatedHeartSize,
          heartY + animatedHeartSize / 2,
          heartX + animatedHeartSize / 2,
          heartY + (animatedHeartSize * 3) / 4
        );
        ctx.quadraticCurveTo(
          heartX,
          heartY + animatedHeartSize / 2,
          heartX,
          heartY + animatedHeartSize / 4
        );
        ctx.closePath();

        ctx.shadowColor = "rgba(0, 0, 0, 0.3)";
        ctx.shadowBlur = 5;
        ctx.shadowOffsetX = 3;
        ctx.shadowOffsetY = 3;

        ctx.fill();
        ctx.stroke();

        ctx.restore();
      }
    }

    function checkCollisions() {
      creepers.forEach((creeper, creeperIndex) => {
        if (!creeper.isHit && isCollision(player, creeper)) {
          creeper.isHit = true;
          lives--;
        }

        arrows.forEach((arrow, arrowIndex) => {
          if (!creeper.isHit && isCollision(arrow, creeper)) {
            if (arrow.hitCreeper(creeper)) {
              creepers.splice(creeperIndex, 1);
            }
            arrows.splice(arrowIndex, 1);
          }
        });

        if (creeper.y + creeper.size > canvas.height) {
          creeper.isHit = true;
          lives--;
        }
      });
    }

    function draw() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      player.draw();

      if (isShooting) {
        shootArrow();
      }

      arrows.forEach((arrow, arrowIndex) => {
        arrow.draw();
        arrow.move();

        if (arrow.y < 0) {
          arrows.splice(arrowIndex, 1);
        }
      });

      creepers.forEach((creeper, creeperIndex) => {
        creeper.draw();
        creeper.update();

        if (!creeper.isHit && isCollision(player, creeper)) {
          creeper.isHit = true;
          lives--;
        }

        arrows.forEach((arrow, arrowIndex) => {
          if (!creeper.isHit && isCollision(arrow, creeper)) {
            if (arrow.hitCreeper(creeper)) {
              creepers.splice(creeperIndex, 1);
            }
            arrows.splice(arrowIndex, 1);
          }
        });

        if (creeper.y + creeper.size > canvas.height) {
          creeper.isHit = true;
          lives--;
        }
      });

      drawHearts();

      ctx.fillStyle = "rgba(0, 0, 0, 0.7)";
      ctx.fillRect(10, 10, 150, 60);
      ctx.fillStyle = "#fff";
      ctx.font = "18px Arial";
      ctx.fillText("Score: " + score, 50, 35);
      ctx.fillText("Level: " + level, 50, 60);

      if (level >= 50) {
        ctx.fillStyle = "#000";
        ctx.font = "48px Arial";
        console.log("Fin del juego   score: " + score);
        ctx.fillText("You Win!", canvas.width / 2 - 120, canvas.height / 2);
        document.getElementById("gameOverScreen").style.display = "block";
        //aqui va la validacion del highscore
        enviarPuntuacion(score);
        endGame();
        return;
      } else if (lives <= 0) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = "#2ecc71";
        ctx.font = "48px 'Impact', sans-serif";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        const text = "Game Over";
        ctx.strokeStyle = "#000";
        ctx.lineWidth = 5;
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        // UpdateAndSaveHighScore(score);
        enviarPuntuacion(score);

        for (let i = -ctx.lineWidth; i <= ctx.lineWidth; i++) {
          for (let j = -ctx.lineWidth; j <= ctx.lineWidth; j++) {
            ctx.strokeText(text, centerX + i, centerY + j);
          }
        }
        console.log("fin del juego   score: " + highScore);

        ctx.fillText(text, centerX, centerY);
        document.getElementById("gameOverScreen").style.display = "block";
        return;
      }

      requestAnimationFrame(draw);
    }

    function endGame() {
      if (level >= 50) {
        // Resto del código de finalización del juego...
        // UpdateAndSaveHighScore(score);
        // Llama a la función para guardar el highscore
        // enviarPuntuacion(highscore);
      }
    }

    function isCollision(a, b) {
      return (
        a.x < b.x + b.size &&
        a.x + a.width > b.x &&
        a.y < b.y + b.size &&
        a.y + a.height > b.y
      );
    }

    function shootArrow() {
      if (canShoot) {
        const arrowX = player.x + player.width / 2 - 2;
        const arrowY = player.y;
        arrows.push(new Arrow(arrowX, arrowY));
        canShoot = false; // rapid shot? set to true to make multiple arrows
      }
    }

    function spawnCreeper() {
      const size = Math.random() * 40 + 20;
      const x = Math.random() * (canvas.width - size);

      let overlap = false;
      for (const creeper of creepers) {
        if (Math.abs(x - creeper.x) < size + 20) {
          overlap = true;
          break;
        }
      }

      if (!overlap) {
        creepers.push(new Creeper(x, 0, size));
      }
    }

    function resetGame() {
      player.x = canvas.width / 2 - 25;
      player.y = canvas.height - 75;
      arrows.length = 0;
      creepers.length = 0;
      score = 0;
      level = 0;
      lives = 6;
      canShoot = true;
      isShooting = false;
    }

    function startNextLevel() {
      level++;

      if (level >= 50) {
        ctx.fillStyle = "#000";
        ctx.font = "48px Arial";
        ctx.fillText(
          "Has Ganado!",
          canvas.width / 2 - 120,
          canvas.height / 2
        );
        document.getElementById("gameOverScreen").style.display = "block";
        return;
      }

      creepers.length = 0;
      for (let i = 0; i < level * 2; i++) {
        spawnCreeper();
      }
      setTimeout(startNextLevel, 1500);
    }

    canvas.addEventListener("mousemove", (event) => {
      player.x =
        event.clientX -
        canvas.getBoundingClientRect().left -
        player.width / 2;
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === " ") {
        isShooting = true;
        shootArrow();
      }
    });

    document.addEventListener("keyup", (event) => {
      if (event.key === " ") {
        isShooting = false;
      }
    });

    setInterval(spawnCreeper, 1500);

    window.onload = () => {
  adjustCanvasSize();
  resetGame();
  document.getElementById("gameOverScreen").style.display = "block";
};

window.addEventListener('resize', adjustCanvasSize);

function adjustCanvasSize() {
  const maxWidth = window.innerWidth;
  const maxHeight = window.innerHeight;
  const aspectRatio = 4 / 3; // Adjust based on your game's aspect ratio

  if (maxWidth / maxHeight < aspectRatio) {
    canvas.width = maxWidth;
    canvas.height = maxWidth / aspectRatio;
  } else {
    canvas.height = maxHeight;
    canvas.width = maxHeight * aspectRatio;
  }
}

let shootingInterval;
function preventDefaultTouchActions(event) {
  if (event.touches.length > 1 || (event.type === "touchend" && event.touches.length > 0)) {
    return; // Permitir gestos multitoque para zoom y otros controles
  }
  event.preventDefault();
}

document.addEventListener("touchstart", preventDefaultTouchActions, { passive: false });
document.addEventListener("touchmove", preventDefaultTouchActions, { passive: false });
document.addEventListener("touchend", preventDefaultTouchActions, { passive: false });
document.addEventListener("touchcancel", preventDefaultTouchActions, { passive: false });

document.addEventListener("touchstart", (event) => {
  // Ignorar el evento si se origina en el botón de inicio
  if (event.target === startButton) {
    return;
  }

  const touchX = event.touches[0].clientX;
  const canvasRect = canvas.getBoundingClientRect();
  const midPoint = canvasRect.left + canvasRect.width / 2;

  if (touchX < midPoint) {
    // Tocar a la izquierda, mueve el personaje a la izquierda
    movePlayerLeft();
  } else {
    // Tocar a la derecha, mueve el personaje a la derecha
    movePlayerRight();
  }
});

function movePlayerLeft() {
  // Mueve el personaje a la izquierda
  player.x -= 10; // Ajusta este valor según sea necesario
  if (player.x < 0) player.x = 0; // Evita que el personaje salga del canvas
}

function movePlayerRight() {
  // Mueve el personaje a la derecha
  player.x += 10; // Ajusta este valor según sea necesario
  if (player.x + player.width > canvas.width) {
    player.x = canvas.width - player.width; // Evita que el personaje salga del canvas
  }
}

startButton.addEventListener("touchstart", (event) => {
  event.preventDefault(); // Para evitar comportamientos predeterminados
  startButton.click(); // Activa el evento click del botón
});

function shootArrow() {
  if (canShoot) {
    const arrowX = player.x + player.width / 2 - 2;
    const arrowY = player.y;
    arrows.push(new Arrow(arrowX, arrowY));
    // Restablecer canShoot inmediatamente para permitir disparos rápidos
    canShoot = true;
  }
}
canvas.addEventListener("touchmove", (event) => {
  event.preventDefault(); // Prevenir comportamientos predeterminados como el desplazamiento de la página

  const touch = event.touches[0];
  let newX = touch.clientX - canvas.getBoundingClientRect().left - player.width / 2;

  // Restringir el movimiento dentro de los límites del canvas
  const maxRight = canvas.width - player.width;
  if (newX < 0) {
    newX = 0;
  } else if (newX > canvas.width - player.width) {
    newX = canvas.width - player.width;
  }

  player.x = newX; // Actualiza la posición del jugador
});




  </script>
</body>

</html>