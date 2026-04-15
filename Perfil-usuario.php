<?php

session_start();

//verificar si el usuario ha iniciado sesión, si no, redirigir a la página de inicio de sesión
if (!isset($_SESSION["correo"]) || $_SESSION["rol"] !== "Cliente") {
    header("Location: inicio-sesion.html");
    exit();
}

// conexión a la base de datos
require_once "./config/connection.php";
$connection = new DatabaseConnection();
$conn = $connection->connect();

// Obtener lista de usuarios
$sql = "SELECT nombre, correo, contrasena, direccion, telefono FROM usuario WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["correo"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="./Style/Perfil-usuario.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="./index.php"><img src="logo-empresa/logo-empresa-blanco.png" width="150"></a>
        </div>
    </header>
    <thead>
        <section class="informacion">
            <h1>Perfil de Usuario</h1>
            <p>Bienvenido al perfil de usuario. Aquí puedes ver y editar tu información personal.</p>
            <h2>Información Personal</h2>
            <table>
                <tr>
                    <th>Nombre</th>
                    <td id="nombre"></td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td id="correo"></td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td id="contraseña"></td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td id="direccion"></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td id="telefono"></td>
                </tr>
            </table>
            <button id="editar-info">Editar Información</button>
        </section>
    </thead>
    <script>
        document.getElementById("nombre").textContent = "<?php echo $user['nombre']; ?>";
        document.getElementById("correo").textContent = "<?php echo $user['correo']; ?>";
        document.getElementById("contraseña").textContent = "<?php echo $user['contrasena']; ?>";
        document.getElementById("direccion").textContent = "<?php echo $user['direccion']; ?>";
        document.getElementById("telefono").textContent = "<?php echo $user['telefono']; ?>";
    </script>
</body>
</html>