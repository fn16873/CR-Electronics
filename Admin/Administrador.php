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
</head>
<body>
    
</body>
</html>