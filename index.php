<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Electronic</title>
    <link rel="stylesheet" href="./Inicio.css">
</head>

<body>
    <button id="btnTop">↑</button>
    <script src="./Boton-inicio.JS"></script>
    <header>
        <div class="Barra">
            <!-- Botón hamburguesa -->
            <button class="boton-menu" aria-label="Abrir menú" id="abrir">
                <span class="linea"></span>
                <span class="linea"></span>
                <span class="linea"></span>
            </button>
            <!-- Navegación oculta/desplegable -->
            <nav class="hamburguesa" id="hamburguesa">
                <ul class="nav-menu">
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./Categorias.php">Categorías</a></li>
                    <li><a href="./inicio-sesion.php">Iniciar sesión</a></li>
                    <li><a href="./Perfil-usuario.php">Perfil</a></li>
                    <li><a href="#">Sobre nosotros</a></li>
                </ul>
            </nav>

            <div class="logo">
                <a href="./index.php"><img src="logo-empresa/logo-empresa-blanco.png" width="150"></a>
            </div>
            <div style="text-align: end;">
                <input class="buscar" type="search" id="buscar" placeholder="Buscar">
            </div>
        </div>
    </header>
    <h2>Celulares</h2>
    <div class="celulares">
        <table>
            <thead>
                <tr class="Imagen">
                    <th><a href=""><img src="Productos/Celulares/Samsung-S24.webp" width="230px"></a></th>
                    <th><a href=""><img src="Productos/Celulares/iPhone-17-pro.png" width="190"></a></th>
                    <th><a href=""><img src="Productos/Celulares/honor-magic-7-pro.png" width="240px"></a></th>
                    <th><a href=""><img src="Productos/Celulares/Google-Pixel-10-Pro.png" width="250px"></a></th>
                    <th><a href=""><img src="Productos/Celulares/xiaomi-15t-pro.png" width="280px"></a></th>

                </tr>
            </thead>
            <tbody>
                <tr class="Dispositivo">
                    <td><a href="">Samsung galaxy S24 ULTRA</a></td>
                    <td><a href=""></a>iPhone 17 PRO MAX</td>
                    <td><a href="">Honor Magic 7 PRO</a></td>
                    <td><a href="">Google Pixel 10 PRO</a></td>
                    <td><a href="">Xiaomi 15T PRO</a></td>
                </tr>
                <tr class="Precio">
                    <td>
                        <p>₡400,000</p>
                    </td>
                    <td>
                        <p>₡700,000</p>
                    </td>
                    <td>
                        <p>₡400,000</p>
                    </td>
                    <td>
                        <p>₡500,000</p>
                    </td>
                    <td>
                        <p>₡300,000</p>
                    </td>
                </tr>
                <tr class="Codigo">
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h2>Laptops</h2>
    <div class="laptops">
        <table>
            <thead>
                <tr class="Imagen">
                    <th><a href=""><img src="./Productos/Laptops/Asus-ROG-STRIX-G16.png" width="240px"></a></th>
                    <th><a href=""><img src="./Productos/Laptops/Macbook-Pro-16.png" width="240"></a></th>
                    <th><a href=""><img src="./Productos/Laptops/acer predator helios 18 ai.png" width="280px"></a>
                    </th>
                    <th><a href=""><img src="./Productos/Laptops/MSI TITAN 18.png" width="280px"></a></th>

                </tr>
            </thead>
            <tbody>
                <tr class="Dispositivo">
                    <td><a href="">Asus ROG Strix G15</a></td>
                    <td><a href="">Macbook Pro 16</a></td>
                    <td><a href="">Acer Predator Helios 18 AI</a></td>
                    <td><a href="">MSI Titan 18 HX AI</a></td>
                </tr>
                <tr class="Precio">
                    <td>
                        <p>₡900,000</p>
                    </td>
                    <td>
                        <p>₡1,200,000</p>
                    </td>
                    <td>
                        <p>₡950,000</p>
                    </td>
                    <td>
                        <p>₡3,000,000</p>
                    </td>
                </tr>
                <tr class="Codigo">
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                    <td>
                        <p>Código: </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <footer>
        <p>&copy; 2026 CR Electronics. Todos los derechos reservados.</p>
    </footer>

    <script src="./menu-hambur.js"></script>
</body>

</html>