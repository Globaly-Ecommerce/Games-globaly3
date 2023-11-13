<?php
// Conexión a la base de datos (debes configurar los datos de conexión)
$host = 'localhost';
$db   = 'juegosscoresDB';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];




// ... Tu código de conexión y procesamiento de datos ...

try {
    // ... Tu código de inserción de usuario ...
    $pdo = new PDO($dsn, $user, $pass, $options);

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $clave = $_POST["clave"];

    // Consulta SQL para verificar si el correo o el nombre ya existen en la base de datos
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email OR nombre_usuario = :nombre");
    $stmt_check->execute(['email' => $email, 'nombre' => $nombre]);
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        // Si el correo o el nombre ya existen, muestra un mensaje de error.
        $error_message = "El correo electrónico o el nombre de usuario ya están registrados. Por favor, utiliza otro correo o nombre.";
    } else {
        // Si se registra con éxito, puedes redirigir al usuario o mostrar un mensaje de éxito.
        $hashed_password = password_hash($clave, PASSWORD_DEFAULT);
        $stmt_insert = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, email, clave) VALUES (:nombre_usuario, :email, :clave)");
        $stmt_insert->execute(['nombre_usuario' => $nombre, 'email' => $email, 'clave' => $hashed_password]);
        header('Location: '."iniciarSesion.php");
    }
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- ... Tu encabezado HTML ... -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <style>
        /* Estilo para el elemento div que contiene el mensaje de error */
        #error-message {
            font-family: 'Montserrat', sans-serif; /* Utiliza la fuente Montserrat */
            background-color: #ffcccc; /* Fondo de color */
            border: 1px solid #ff0000; /* Borde rojo */
            padding: 10px; /* Espaciado interno */
            color: #ff0000; /* Color del texto en rojo */
            text-align: center; /* Centrar el texto */
            margin-top: 10px; /* Espaciado superior */
            border-radius: 5px; /* Borde redondeado */
        }

        /* Estilo para el botón de retroceso */
        #back-button {
            font-family: 'Montserrat', sans-serif; /* Utiliza la fuente Montserrat */
            background-color: #007bff; /* Fondo de color azul */
            color: #fff; /* Color del texto en blanco */
            padding: 10px 20px; /* Espaciado interno */
            border: none; /* Sin borde */
            cursor: pointer; /* Cambiar el cursor al puntero al pasar el mouse */
            border-radius: 50px; /* Borde redondeado */
            text-decoration: none; /* Sin subrayado en el texto */
            font-size: 16px; /* Tamaño de fuente */
            margin-top: 10px; /* Espaciado superior */
        }

        /* Estilo al pasar el mouse sobre el botón */
        #back-button:hover {
            background-color: #0056b3; /* Cambia el fondo a un tono más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>
    <div id="error-message">
        <?php echo isset($error_message) ? $error_message : ''; ?>
    </div>
    <form action="registro.php" method="post">
        <!-- ... Tus campos de formulario ... -->
        <!-- Botón de retroceso -->
        <a id="back-button" href="iniciarSesion.php">Volver atrás</a>
    </form>
</body>
</html>

<?