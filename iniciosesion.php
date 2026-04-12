<?php

    require_once "./config/connection.php";
    session_start();

    // Código para crear una nueva cuenta de usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST["password"];
        $email = $_POST["email"];
    }

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    //verificar que recibimos los datos del formulario
    if (!isset($_POST["email"]) || !isset($_POST["password"])){
        echo "Faltan datos";
        exit();
    } else {
        // Obtener los datos del formulario
        $email = trim($_POST["email"]);
        $contrasena = trim($_POST["password"]);
    }

    //valida si los datos no están vacíos
    if (empty($email) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Verificar las credenciales del usuario
    $sql = "SELECT * FROM usuario WHERE correo='$email'";
    $result = $conn->query($sql);

    //contraseña_verify para comparar la contraseña ingresada con la contraseña encriptada almacenada en la base de datos
    if ($result->num_rows > 0) {
        // Verificar la contraseña
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row["contrasena"])) {
            echo "Inicio de sesión exitoso";
            // Iniciar sesión y redirigir al usuario a la página principal
            session_start();
            $_SESSION["correo"] = $email;
            header("Location: index.html"); 
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El correo electrónico no está registrado";
    }

    // Cerrar la conexión
    $conn->close();
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="inicio-sesion.css">
</head>
<body>
    <!--Barra con solo la foto-->
    <header>
        <div class="logo">
            <a href="./index.php"><img src="logo-empresa/logo-empresa-blanco.png" width="150"></a>
        </div>
    </header>
    <section>
    <div class="cuenta">
            <h2>Iniciar sesión</h2>
            <form action="iniciosesion.php" method="post">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <label for=""></label>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="./crear-cuenta.php">Regístrate aquí</a></p>
    </div>
    </section>
    <footer>
        <p>&copy; 2026 CR Electronics. Todos los derechos reservados.</p>
    </footer>
</body>
</html>