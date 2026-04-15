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
	p.nombre,
    p.marca,
    GROUP_CONCAT(DISTINCT i.imagen_url) AS todas_imagen,
    GROUP_CONCAT(DISTINCT v.video_URL) AS todos_video
   FROM producto AS p
   LEFT JOIN imagen_producto AS i ON 
   p.id_producto=i.id_producto
   LEFT JOIN video_producto AS v ON
   p.id_producto=v.id_producto
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
            <li><a href="">Lista de productos</a></li>
            <li><a href="">Agregar productos</a></li>
            <li><a href="">Eliminar productos</a></li>
            <li><a href="">Editar productos</a></li>
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
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imágenes/Videos</th>
                </tr>
                <?php foreach ($admin as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                        <td>
                            <?php 
                            // Mostrar imágenes
                            $imagenes = explode(',', $producto['todas_imagen']);
                            foreach ($imagenes as $imagen) {
                                if (!empty($imagen)) {
                                    echo '<img src="' . htmlspecialchars($imagen) . '" alt="Imagen del producto" width="100">';
                                }
                            }
                            // Mostrar videos
                            $videos = explode(',', $producto['todos_video']);
                            foreach ($videos as $video) {
                                if (!empty($video)) {
                                    echo '<video width="320" height="240" controls><source src="' . htmlspecialchars($video) . '" type="video/mp4">Tu navegador no soporta el elemento de video.</video>';
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <p>¿No tienes una cuenta? <a href="./crear-cuenta.html">Regístrate aquí</a></p>
    </div>
</body>
</html>