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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear cuenta12</title>
    <link rel="stylesheet" href="inicio-sesion.css">
</head>
<body>
    <!--Se ingresa el encabezado de la pagina solo poniedo la imagen que lo puede dirigir al inicio de la pagina-->
    <header>
        <!--Se importa la  clase logo-->
        <div class="logo">
            <a href="./index.html"><img src="logo-empresa/logo-empresa-blanco.png" width="150"></a>
        </div>
    </header>
    <!--Se crea la secion para el inicio de sesion-->
    <section>
        <!--Se crea/inicia la clase con el div de cuenta-->
        <div class="cuenta">
            <!--Apartado del formulario-->
            <form action="crear-cuenta.html">

                <!--Etiquetas de label (Poner texto arriba del input) junto a sus inputs para capturar los datos del usuario-->
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="telefono">Número de teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Crear cuenta</button>
            </form>
        </div>
    </section>
    <!--Etiqueta para el pie de pagina-->
    <footer>
        <p>&copy; 2026 CR Electronics. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    //Verificar que recibimos los datos del formulario
    if (!isset($nombre) || !isset($apellido) || !isset($email)){
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
    
    // Si el correo electrónico ya existe, mostrar un mensaje de error
    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        

        // Insertar los datos en la tabla de usuarios
        $insertardatos = "INSERT INTO usuario (nombre, apellido, correo, contrasena, direccion, telefono) VALUES ('$nombre', '$apellido', '$email', '$contrasena', '$direccion', '$numero')";
        $ejecutar = $mysqli_query($conn, $insertardatos);

        if ($ejecutar->execute()) {
            echo json_encode(["message" => "Cuenta creada exitosamente"]);
            header("Location: inicio-sesion.html"); // Redirigir al usuario a la página de inicio de sesión
            exit();
        } else {
            echo json_encode(["message" => "Error al crear la cuenta"]);
        }
    }

    // Cerrar la conexión a la base de datos
    $ejecutar->close();
    $conn->close();
?>