<?php

session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION["correo"]) || $_SESSION["rol"] !== "Administrador") {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión o no tiene el rol de administrador
    header("Location: ../inicio-sesion.html");
    exit();
}

if ($_SESSION["rol"] !== "Administrador") {
    // Redirigir al usuario a la página de inicio de sesión si no tiene el rol de administrador
    header("Location: ../inicio-sesion.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="../Style/Style-admin.css">
</head>
<body>
    <header>
        <!--Se importa la  clase logo-->
        <div class="logo">
            <a href="../index.php"><img src="../logo-empresa/logo-empresa-blanco.png" width="150"></a>
        </div>
    </header>

    <div class="Dashboard">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="">Lista de productos</a></li>
            <li><a href="">Agregar productos</a></li>
            <li><a href="">Eliminar productos</a></li>
            <li><a href="">Editar productos</a></li>
            <li><a href="../InicioSesion/cerrar-sesion.php">Cerrar sesión</a></li>
        </ul>
    </div>
    <section>
    <div class="admin">
            <h2>Iniciar sesión</h2>
            <form action="./InicioSesion/iniciosesion.php" method="post">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <label for=""></label>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="./crear-cuenta.html">Regístrate aquí</a></p>
    </div>
</body>
</html>