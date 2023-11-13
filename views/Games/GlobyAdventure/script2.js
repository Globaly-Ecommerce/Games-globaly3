// Referencias a elementos del DOM
const canvas = document.getElementById('gameCanvas');   // Referencia al canvas del juego
const ctx = canvas.getContext('2d');                    // Contexto 2D para dibujar en el canvas
const btnGameOver = document.getElementById("restartButton");    // Botón para reiniciar el juego

// Variables de estado para controlar el juego
let gameStarted = false;    // Indica si el juego ha comenzado
let gameOver = false;       // Indica si el juego ha terminado
let score = 0;              // Puntuación del jugador
let frames = 0;             // Contador de frames (útil para controlar tiempos y animaciones)
// Variables para la cuenta regresiva
let countdown = 3;
let countdownActive = false;
let speedModifier = 1;  // Inicialmente la velocidad es normal (1x)

// Variables para la gravedad y la aceleración
let gravity = 0.5;  // Puedes ajustar este valor para cambiar la fuerza de la gravedad
let acceleration = 0.5;  // Puedes ajustar este valor para cambiar la rapidez con la que Globy acelera hacia abajo


const baseInterval = 200;
let pipeCreationInterval = baseInterval;
let nextSpeedIncreaseScore = 10;
// canvas.width = window.innerWidth;
// canvas.height = window.innerHeight;
// Carga de imágenes
const backgroundImg = new Image(); 
backgroundImg.src = './img/9.png';

const newBackgroundImg = new Image();
newBackgroundImg.src = './img/8.png';

const globyImg = new Image();
globyImg.src = './img/Globy.png';

const pipeTopImg = new Image();
pipeTopImg.src = './img/tx3.png';

const pipeBottomImg = new Image();
pipeBottomImg.src = './img/tx3.png';

const coinImg = new Image();
coinImg.src = './img/coin.png';
 
// Propiedades del personaje principal (Globy)
const globy = {
  x: 50,                           // Posición horizontal inicial
  y: canvas.height / 2,            // Posición vertical inicial (centro del canvas)
  width: 55,                       // Ancho
  height: 70,                      // Alto
  velocity: -10,                   // Velocidad vertical inicial
  gravity: 1,                      // Gravedad (fuerza que tira hacia abajo)
  jump: 20,                        // Fuerza del salto
  
};

// Propiedades de los tubos (obstáculos)
const pipeWidth = 50;
const pipeGap = 250;  
// const pipeTop = 100;              // Espacio entre los tubos superior e inferior
const pipes = [];                  // Array para almacenar los tubos

// Propiedades de las monedas
const coins = [];
const coinWidth = 30;
const coinHeight = 30;

// Event listeners para controlar interacciones del usuario
canvas.addEventListener('click', handleTap);              // Saltar al hacer click
canvas.addEventListener('touchstart', handleTap);         // Saltar al tocar la pantalla (móviles)
document.addEventListener('keydown', function(event) {    // Saltar con tecla espacio o Tab
    if (event.keyCode === 32 || event.keyCode === 9) {   // 32 es espacio y 9 es Tab
      event.preventDefault();                             // Evita el comportamiento por defecto de Tab
      handleTap();
    }
});
btnGameOver.addEventListener('click', resetGame);         // Reiniciar el juego

// Función que maneja el salto de Globy
function handleTap() {
  if (!gameStarted) {
    startGame();
    return;
  }
  if (!gameOver) globy.velocity = -globy.jump * 0.50; // Si el juego no ha terminado, Globy salta
}
// Función que maneja la cuenta regresiva
function handleCountdown() {
  countdown--;
  if (countdown <= 0) {
    countdownActive = false;
    globy.y = canvas.height / 3;
    gameLoop();
  } else {
    setTimeout(handleCountdown, 1000);
    draw();    
  }
}

// Función para iniciar el juego
function startGame() {
  if (!gameStarted) {
    gameStarted = true;
    btnGameOver.classList.add("hide"); 
    resetGame();
  }
}

// Función para reiniciar el juego
function resetGame() {
  btnGameOver.classList.add("hide"); 

  countdown = 3;
  countdownActive = true;
  speedModifier = 1;  // Resetea el modificador de velocidad
  setTimeout(handleCountdown, 1000);
  globy.y = canvas.height / 2;
  globy.velocity = -10;
  pipes.length = 0;
  coins.length = 0;
  score = 0;
  gameOver = false;

}
// Evento para detectar la barra espaciadora
document.addEventListener('keydown', function(event) {
  if (event.code === 'Space') {
    if (gameOver) {
      resetGame();
    } else {
      // Lógica para hacer saltar a Globy
      globy.velocity = -10; // Puedes ajustar este valor según la altura del salto que desees
    }
  }
});

// Función para dibujar el fondo del juego
function drawBackground() {
  const bg = score < 60    ? backgroundImg : newBackgroundImg; // Cambia el fondo según la puntuación
  ctx.drawImage(bg, 0, 0, canvas.width, canvas.height);
}

function checkCollision(pipeX, pipeTop, pipeBottom) {
  const collisionMargin = 8;  // Ajusta este valor según lo necesario 
  if (globy.x + globy.width - collisionMargin > pipeX && globy.x + collisionMargin < pipeX + pipeWidth && 
      (globy.y + collisionMargin < pipeTop || globy.y + globy.height - collisionMargin > pipeTop + pipeGap)) {
    gameOver = true;                                        // Establece el estado del juego a "terminado"
    // btnGameOver.classList.remove("hide");                  // Muestra el botón de reinicio
  }
}

// Función para comprobar colisiones con las monedas
function checkCoinCollision() {
  for (let coin of coins) {
    // Verifica si Globy recoge una moneda
    if (!coin.collected && globy.x + globy.width > coin.x && globy.x < coin.x + coinWidth &&
        globy.y + globy.height > coin.y && globy.y < coin.y + coinHeight) {
      coin.collected = true;
      score += 3;// Aumenta la puntuación
    }
  }
}

function update() {
  if (gameOver) return;
  
  globy.velocity += globy.gravity;                          // Aplica la gravedad a Globy
  globy.y += globy.velocity;

  // A medida que la velocidad aumenta, disminuye el intervalo de creación de tubos
  pipeCreationInterval = baseInterval / (1 + 1.5 * speedModifier); // Ajusta el divisor de forma más pronunciada
  if (pipeCreationInterval < 20) pipeCreationInterval = 20; // Establece un mínimo para el intervalo

  // Genera tubos en intervalos que dependen de la velocidad
  if (frames % Math.round(pipeCreationInterval) === 0) {
    const minPipeHeight = 50; // Altura mínima del tubo
    const maxPipeHeight = canvas.height - 2*minPipeHeight - pipeGap;  // Altura máxima del tubo tomando en cuenta el pipeGap
    const randomHeight = Math.floor(Math.random() * (maxPipeHeight - minPipeHeight + 1)) + minPipeHeight;
    
    pipes.push({ x: canvas.width, top: randomHeight });
}
  
  if (frames % (Math.round(pipeCreationInterval) + 30) === 0 && pipes.length > 0) {
    const lastPipe = pipes[pipes.length - 1]; // Referencia al último tubo generado
    const coinY = lastPipe.top + (pipeGap / 2) - (coinHeight / 2); // Centro del gap del tubo
    
    coins.push({ x: lastPipe.x + Math.random() * 500, y: coinY, width: coinWidth, height: coinHeight, collected: false });
  }
  
  for (let pipe of pipes) {
    pipe.x -= 3 * speedModifier;                                          // Mueve los tubos hacia la izquierda

    // Verifica si Globy ha pasado el tubo y sumar un punto al marcador.
    if (pipe.x + pipeWidth < globy.x && !pipe.scored) {
        score += 1;                                         // Suma un punto al marcador.
        pipe.scored = true;                                 // Marca el tubo como contabilizado para no sumar puntos adicionales.
    }
    // Elimina los tubos que salen del canvas
    if (pipe.x + pipeWidth < 0) pipes.shift();

    checkCollision(pipe.x, pipe.top, pipe.top + pipeGap);
  }

  // Comprueba si Globy ha caído al suelo o se ha salido del canvas por arriba
  if (globy.y + globy.height > canvas.height || globy.y < 0) {
    gameOver = true;
    btnGameOver.classList.remove("hide");                   // Muestra el botón de reinicio
  }
  if (globy.y + globy.height > canvas.height || globy.y < 0) {
    gameOver = true;
    setTimeout(() => {
        // btnGameOver.classList.remove("hide");  // Muestra el botón de reinicio con un retraso
    }, 2000);
  }
  
  // Actualiza la posición de las monedas y verifica colisiones
  for (let coin of coins) {
    coin.x -= 3   * speedModifier; // Ajusta este valor para controlar la velocidad de las monedas.
    if (coin.x + coin.width < 0) coins.shift();             // Elimina las monedas que salen del canvas
  }

  // Ajuste para incrementar la velocidad
  if (score >= nextSpeedIncreaseScore) { 
    speedModifier += 0.1; // Aumenta la velocidad en un 3%
    nextSpeedIncreaseScore += 10; // Configura el siguiente objetivo para incrementar la velocidad
}

  checkCoinCollision();
}
// Función para dibujar todos los elementos del juego
function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Si el juego no ha comenzado, muestra el mensaje de inicio y termina la función
  if (!gameStarted) {
    render();
    return;
  }

  drawBackground();
  ctx.drawImage(globyImg, globy.x, globy.y, globy.width, globy.height);

  // Dibuja los tubos en el canvas
  for (let pipe of pipes) {
    ctx.drawImage(pipeTopImg, pipe.x, 0, pipeWidth, pipe.top);
    ctx.drawImage(pipeBottomImg, pipe.x, pipe.top + pipeGap, pipeWidth, canvas.height - pipe.top - pipeGap);
  }

  // Dibuja las monedas en el canvas (si no han sido recolectadas)
  for (let coin of coins) {
    if (!coin.collected) {
      ctx.drawImage(coinImg, coin.x, coin.y, coin.width, coin.height);
    }
  }

  if (countdownActive) {
    ctx.fillStyle = 'white';
    ctx.font = '60px GamerFont';
    ctx.fillText(countdown, canvas.width / 2 - 20, canvas.height / 2);
    return;
  }

  if (gameOver) {
    displayGameOver();
    return; // Termina la función si el juego ha terminado
  }

  // Muestra la puntuación
  ctx.fillStyle = 'white';
  ctx.font = '30px Arial'
  ctx.fillText(`Score: ${score}`, 70, 30);
  saveScoreToLocalStorage();
  displayHighScore();
}

// Bucle principal del juego
function gameLoop() {
  update();                                                // Actualiza el estado del juego
  draw();                                                  // Dibuja todos los elementos del juego
  frames++;                                                // Incrementa el contador de frames
  if (!gameOver) requestAnimationFrame(gameLoop);          // Si el juego no ha terminado, sigue con el bucle
}

// Funciones para guardar y mostrar la puntuación máxima
function saveScoreToLocalStorage() {
  const highScore = document.querySelector(".high-score").textContent
  if (!highScore || score > parseInt(highScore)) {
    const highScore = document.querySelector(".high-score").textContent
  }
}
function displayHighScore() {
  const highScore = document.querySelector(".high-score").textContent
  ctx.fillStyle = 'white';
  ctx.font = '20px Arial';
  ctx.fillText(`High Score: ${highScore}`, canvas.width - 200, 30);
 
}
function enviarPuntuacion(puntaje) {
  console.log("Enviar puntuacion!!!");
  console.log("EJ SCORE ES. " + score)
  // Datos que deseas enviar en la solicitud POST
  const data = {
    juego_id: "5",
    puntuacion: puntaje,
  };

  // URL a la que deseas enviar la solicitud POST
  const url = "../../../guardar_puntuacion.php"; // Reemplaza esto con la URL correcta de tu script PHP

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
      throw new Error("La solicitud no pudo completarse correctamente.");
    }
  })
  .catch((error) => {
    console.error("Error al realizar la solicitud POST:", error);
  });
}
// Función para mostrar el mensaje de Game Over y la puntuación
function displayGameOver() {
  const highScore = document.querySelector(".high-score").textContent;
  if (score > highScore) {
    console.log("Nuevo highscore!")
    enviarPuntuacion(score)
  }

  btnGameOver.classList.remove("hide"); 
  ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';  // fondo semi-transparente
  ctx.fillRect(0, canvas.height / 4, canvas.width, canvas.height / 2);

  // Configura el punto de referencia del texto en el centro
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';

  // Dibuja "Game Over" centrado
  ctx.fillStyle = 'red';
  ctx.font = '60px GameOver';
  ctx.fillText('Game Over', canvas.width / 2, canvas.height / 2);

  // Dibuja el puntaje debajo de "Game Over"
  ctx.fillStyle = 'white';
  ctx.font = '40px Arial';
  ctx.fillText(`Score: ${score}`, canvas.width / 2, canvas.height / 2 + 50);

  if (highScore) {
    ctx.fillText(`High Score: ${highScore}`, canvas.width / 2, canvas.height / 2 + 100);
  }
}
window.onload = function() {

  draw();   // Dibuja la pantalla de inicio
}
function render() {
  // Dibuja fondo, objetos, etc.
    // Muestra el mensaje de inicio en el centro del canvas
    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';  // fondo semi-transparente
    ctx.fillRect(0, canvas.height / 4, canvas.width, canvas.height / 2);
  
    ctx.textAlign = 'center';  // Centra el texto horizontalmente
    ctx.textBaseline = 'middle'; // Centra el texto verticalmente
  
    ctx.fillStyle = 'white';
    ctx.font = '20px Arial';
    ctx.fillText('Toca para Iniciar', canvas.width / 2, canvas.height / 2);
  
    ctx.textAlign = 'start'; // Restablece la alineación horizontal del texto
    ctx.textBaseline = 'alphabetic'; // Restablece la alineación vertical del texto
    btnGameOver.classList.add("hide");
}
/////////////////////////////////
function isMobileDevice() {
  return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
}

const mobileDevice = isMobileDevice();

if (mobileDevice) {
    // Ajusta el tamaño de Globy para móviles
    globy.width = 50;      // Nuevo ancho para móviles
    globy.height = 40;     // Nuevo alto para móviles

    // Ajusta la gravedad para móviles
    const gravity = 0.5;   // Puedes ajustar este valor para que sea el adecuado para la experiencia móvil

    // Ajusta el tamaño de los tubos para móviles si aún deseas hacerlo
    const pipeWidth = 35;
    const pipeGap = 180;   
} else {
    // Tamaño de Globy para dispositivos no móviles (como se tenía originalmente)
    globy.width = 55;      
    globy.height = 70;

    // Gravedad para dispositivos no móviles (original)
    const gravity = 0.5;

    // Tamaño de los tubos para dispositivos no móviles (original)
    const pipeWidth = 50;
    const pipeGap = 250;
}



gameLoop();                                                // Inicia el bucle principal del juego.
