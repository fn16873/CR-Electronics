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
            <li><a href="Administrador.php">Lista de productos</a></li>
            <li><a href="AgregarProductos.php">Agregar productos</a></li>
            <li><a href="EliminarProductos.php">Eliminar productos</a></li>
            <li><a href="EditarProductos.php">Editar productos</a></li>
            <li><a href="../InicioSesion/cerrar-sesion.php">Cerrar sesión</a></li>
        </ul>
    </div>
    <section>
    <div class="admin">
        <h2>Registrar Productos</h2>
        <form action="procesar_registro.php" method="POST">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="marca">Marca:</label>
            <select name="marca" id="marca" required>
                <option value=""></option>
                <option value="Samsung">Samsung</option>
                <option value="Apple">Apple</option>
                <option value="Xiaomi">Xiaomi</option>
                <option value="Honor">Honor</option>
                <option value="ASUS">ASUS</option>
                <option value="Acer">Acer</option>
                <option value="MSI">MSI</option>
                <option value="Lenovo">Lenovo</option>
                <option value="HP">HP</option>
                <option value="NVIDIA">NVIDIA</option>
                <option value="AMD">AMD</option>
                <option value="Intel">Intel</option>
                <option value="Crucial">Crucial</option>
                <option value="Kingston">Kingston</option>
                <option value="Corsair">Corsair</option>
                <option value="G.Skill">G.Skill</option>
                <option value="TeamGroup">TeamGroup</option>
                <option value="Seasonic">Seasonic</option>
                <option value="EVGA">EVGA</option>
                <option value="be quiet!">be quiet!</option>
                <option value="Western Digital">Western Digital</option>
                <option value="Seagate">Seagate</option>
                <option value="NZXT">NZXT</option>
                <option value="Cooler Master">Cooler Master</option>
                <option value="Fractal Design">Fractal Design</option>
                <option value="Lian Li">Lian Li</option>
            </select>
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" required>
                <option value=""></option>
                <option value="Dispositivos movil">Dispositivos Móviles</option>
                <option value="Laptop">Laptops</option>
                <option value="Componentes">Componentes</option>
            </select>
            <br>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" min="0" step="500" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" min="0" required>

            <label for="imagenurl1">Imagen del producto:</label>
            <input type="url" id="imagenurl1" name="imagenurl1" required>
            
            <label for="imagenurl2">Imagen del producto:</label>
            <input type="url" id="imagenurl2" name="imagenurl2">
            
            <label for="imagenurl3">Imagen del producto:</label>
            <input type="url" id="imagenurl3" name="imagenurl3">

            <label for="videourl">Video del producto:</label>
            <input type="url" id="videourl" name="videourl">

            <h5>Nota: Asegúrate de ingresar URLs válidas para las imágenes y el video.</h5>
            <br>
            <button type="submit">Registrar</button>
        </form>
    </div>
    </section>
    <script src="../JS/ajuste.js"></script>
</body>
</html>