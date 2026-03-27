<?php
    // agregar.php
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

    //Verificar que recibimos los datos del formulario
    if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"])){
        echo "Faltan datos";
        exit();
    } else {
        // Obtener los datos del formulario
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $email = trim($_POST["email"]);
        $contrasena = trim($_POST["password"]);
        $numero = trim($_POST["telefono"]);
        $direccion = trim($_POST["direccion"]);
    }



    //valida si los datos no están vacíos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($contrasena) || empty($numero) || empty($direccion)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Verificar si el correo electrónico ya está registrado
    $sql = "SELECT * FROM usuario WHERE correo='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode(["message" => "El correo electrónico ya está registrado"]);
        exit();
    }

    // Encriptar la contraseña antes de almacenarla
    $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar los datos en la tabla de usuarios
    $sql = "INSERT INTO usuario (nombre, apellido, correo, contrasena, telefono, direccion) VALUES ('$nombre', '$apellido', '$email', '$contrasena', '$numero', '$direccion')";


    // Ejecutar la consulta y verificar si se realizó correctamente
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Cuenta creada exitosamente"]);
        header("Location: inicio-sesion.html"); // Redirigir al usuario a la página de inicio de sesión
        exit();
    } else {
        echo json_encode(["message" => "Error al crear la cuenta"]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>