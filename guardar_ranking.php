<?php
// Conexión a la base de datos
$host = 'localhost';
$db   = 'JuegosScoresDB';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);
$juego_id = 2;

// Consulta para obtener el ranking
// Consulta SQL para obtener el ranking de puntuaciones
$stmt = $pdo->query("SELECT usuarios_id, SUM(score) AS total_puntos FROM score GROUP BY usuarios_id ORDER BY total_puntos DESC");

$ranking = $stmt->fetchAll();
 

// Mostrar el ranking
echo "<h2>Ranking de Usuarios</h2>";
echo "<ol>";
foreach ($ranking as $fila) {
    echo "<li>Usuario: " . htmlspecialchars($fila['nombre_usuario']) . " - Puntos: " . htmlspecialchars($fila['total_puntos']) . "</li>";
}
echo "</ol>";
?>

