<?php
    //vincular a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crelectronics";

    // Código para iniciar sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $email = $_POST["email"];
        $contrasena = $_POST["password"];

        // Crear conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Verificar las credenciales del usuario
        $sql = "SELECT * FROM usuario WHERE email='$email'";
        $result = $conn->query($sql);

        //contraseña_verify para comparar la contraseña ingresada con la contraseña encriptada almacenada en la base de datos
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row["contrasena"])) {
                echo "Inicio de sesión exitoso";
                // Iniciar sesión y redirigir al usuario a la página principal
                session_start();
                $_SESSION["email"] = $email;
                header("Location: index.php");
                exit();
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "El correo electrónico no está registrado";
        }

        // Cerrar la conexión
        $conn->close();
    }
?>