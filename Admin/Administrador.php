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

require_once '../config/connection.php';
$db = new DatabaseConnection();
$conn = $db->connect();

// Consulta para obtener productos con imágenes y videos
$sql = "SELECT
	p.id_producto,
    p.nombre,
    p.marca,
    p.categoria,
    p.descripcion,
    p.precio,
    p.stock,
    GROUP_CONCAT(DISTINCT i.imagen_url) AS todas_imagen,
    GROUP_CONCAT(DISTINCT v.video_URL) AS todos_video
   FROM producto AS p
   LEFT JOIN imagen_producto AS i ON p.id_producto=i.id_producto
   LEFT JOIN video_producto AS v ON p.id_producto = v.id_producto
   GROUP BY p.id_producto;";

$stmt = $conn->query($sql);
$stmt->execute();
$admin = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <li><a href="Administrador.php">Lista de productos</a></li>
            <li><a href="AgregarProductos.php">Agregar productos</a></li>
            <li><a href="EliminarProductos.php">Eliminar productos</a></li>
            <li><a href="EditarProductos.php">Editar productos</a></li>
            <li><a href="../InicioSesion/cerrar-sesion.php">Cerrar sesión</a></li>
        </ul>
    </div>
    <section>
    <div class="admin">
        <h2>Lista de productos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Imágenes</th>
                <th>Videos</th>
            </tr>
            <?php foreach ($admin as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($producto['marca']); ?></td>
                    <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                    <td class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td>
                        <?php 
                        // Mostrar imágenes
                        $imagenes = explode(',', $producto['todas_imagen']);
                        foreach ($imagenes as $imagen) {
                            if (!empty($imagen)) {
                                echo '<img src="' . htmlspecialchars($imagen) . '" alt="Imagen del producto" width="100">';
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        // Mostrar videos
                        $videos = explode(',', $producto['todos_video']);
                        foreach ($videos as $video) {
                            if (strpos($video, 'watch?v=') !== false) {
                                $video = str_replace('watch?v=', 'embed/', $video);
                            }
                            if (!empty($video)) {
                                echo '<iframe width="250" height="150" src="' . htmlspecialchars($video) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="../JS/ajuste.js"></script>
</body>
</html>