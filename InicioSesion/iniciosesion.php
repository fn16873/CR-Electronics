<?php

    require_once "../config/connection.php";
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
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Guardar información del usuario en la sesión
        $_SESSION["correo"] = $email;
        $_SESSION["rol"] = $user["rol"];
        $_SESSION["id_usuario"] = $user["id_usuario"];
        // Redirigir al usuario según su rol
        if (password_verify($contrasena, $user["contrasena"])) {
            echo "Inicio de sesión exitoso";
            if ($user["rol"] == "Administrador") {
                $_SESSION["rol"] = "Administrador";
                $_SESSION["correo"] = $email;
                header("Location: ../Admin/Administrador.php"); 
                
            } else {
                $_SESSION["rol"] = "Cliente";
                $_SESSION["correo"] = $email;
                header("Location: ../index.php"); 

            }
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El correo electrónico no está registrado";
    }
?>