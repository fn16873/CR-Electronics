<?php
    //vincular a la base de datos
    $servername = "localhost:3306";
    $username = "root";
    $password = "2408";
    $dbname = "crelectronics";
    // Código para crear una nueva cuenta de usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];

        // Crear conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar los datos en la tabla de usuarios
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";

        if ($conn->query($sql) === TRUE) {
            echo "Cuenta creada exitosamente";
            header("Location: login.php"); // Redirigir al usuario a la página de inicio de sesión
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }
?>