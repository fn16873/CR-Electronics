<?php
// procesar_registro.php

require_once "../config/connection.php";

session_start();

$conn = new DatabaseConnection();
$conn = $conn->connect();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $imagenurl1 = $_POST["imagenurl1"];
    /*Verificar si los campos de imagen 2 3 y video están vacíos*/
    if (empty($_POST["imagenurl2"])) {
        $imagenurl2 = null;
    } else {
        $imagenurl2 = $_POST["imagenurl2"];
    }
    if (empty($_POST["imagenurl3"])) {
        $imagenurl3 = null;
    } else {
        $imagenurl3 = $_POST["imagenurl3"];
    }
    if (empty($_POST["videourl"])) {
        $videourl = null;
    } else {
        $videourl = $_POST["videourl"];
    }
} else {
    echo "No se han enviado datos.";
    exit();
}

// Preparar la consulta SQL para insertar el producto
$sql = "INSERT INTO producto (nombre, marca, categoria, descripcion, precio, stock) VALUES (:nombre, :marca, :categoria, :descripcion, :precio, :stock)";
$sql_imagen = "INSERT INTO imagen_producto (id_producto, imagen_url) VALUES (:id_producto, :imagen_url)";

if (!empty($imagenurl2)) {
    $sql_imagen2 = "INSERT INTO imagen_producto (id_producto, imagen_url) VALUES (:id_producto, :imagen_url2)";
    $stmt_ima2 = $conn->prepare($sql_imagen2);
}

if (!empty($imagenurl3)) {
    $sql_imagen3 = "INSERT INTO imagen_producto (id_producto, imagen_url) VALUES (:id_producto, :imagen_url3)";
    $stmt_ima3 = $conn->prepare($sql_imagen3);
}

if (!empty($videourl)) {
    $sql_video = "INSERT INTO video_producto (id_producto, video_URL) VALUES (:id_producto, :video_URL)";
    $stmt_video = $conn->prepare($sql_video);
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":categoria" => $categoria,
        ":marca" => $marca,
        ":precio" => $precio,
        ":stock" => $stock,
        ":descripcion" => $descripcion
    ]);

    $id_producto = $conn->lastInsertId();

    $stmt_ima1 = $conn->prepare($sql_imagen);
    $stmt_ima1->execute([
        ":id_producto" => $id_producto,
        ":imagen_url" => $imagenurl1
    ]);


     if (!empty($imagenurl2)) {
        $stmt_ima2 = $conn->prepare($sql_imagen2);
        $stmt_ima2->execute([
            ":id_producto" => $id_producto,
            ":imagen_url2" => $imagenurl2
        ]);
    }


    if (!empty($imagenurl3)) {
        $stmt_ima3 = $conn->prepare($sql_imagen3);
        $stmt_ima3->execute([
            ":id_producto" => $id_producto,
            ":imagen_url3" => $imagenurl3
        ]);
    }


    if (!empty($videourl)) {
        $stmt_video = $conn->prepare($sql_video);
        $stmt_video->execute([
            ":id_producto" => $id_producto,
            ":video_URL" => $videourl
        ]);
    }

    echo "Producto registrado exitosamente.";
    header("Location: ../admin/AgregarProductos.php");
    exit();
} catch(PDOException $e) {
    echo "Error al registrar el producto: " . $e->getMessage();
}

?>