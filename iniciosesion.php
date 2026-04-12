<?php

    require_once "./config/connection.php";
    session_start();

    // Código para crear una nueva cuenta de usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST["password"];
        $email = $_POST["email"];
    }

    $conn = new DatabaseConnection();
    $pdo = $conn->connect();

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
    $sql = "SELECT * FROM usuario WHERE correo=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    //contraseña_verify para comparar la contraseña ingresada con la contraseña encriptada almacenada en la base de datos
    if ($stmt->rowCount() > 0) {
        // Verificar la contraseña
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($contrasena, $row["contrasena"])) {
            echo "Inicio de sesión exitoso";
            // Iniciar sesión y redirigir al usuario a la página principal
            session_start();
            $_SESSION["correo"] = $email;
            header("Location: index.php"); 
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El correo electrónico no está registrado";
    }
    
?>