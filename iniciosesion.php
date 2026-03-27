<?php
    // iniciosesion.php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    // Permitir métodos POST y OPTIONS (para CORS)
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    // Código para crear una nueva cuenta de usuario
    if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
        // Manejar la solicitud OPTIONS (para CORS)
        exit(0);
    } 
    
    //vincular a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crelectronics";

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