<?php
    //vincular a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crelectronics";
    // Código para crear una nueva cuenta de usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $contrasena = $_POST["password"];
        $numero = $_POST["telefono"];
        $direccion = $_POST["direccion"];

        // Crear conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Verificar si el correo electrónico ya está registrado
        $sql = "SELECT * FROM usuario WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El correo electrónico ya está registrado.";
        } else {
            //encriptar la contraseña
            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            // Insertar los datos en la tabla de usuarios
            $sql = "INSERT INTO usuario (nombre, apellido, correo, contrasena, direccion, telefono) VALUES ('$nombre', '$apellido', '$email', '$contrasena', '$direccion', '$numero')";

            if ($conn->query($sql) === TRUE) {
                echo "Cuenta creada exitosamente";
                header("Location: login.php"); // Redirigir al usuario a la página de inicio de sesión
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // Cerrar la conexión
        $conn->close();
    }
?>