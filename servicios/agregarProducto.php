<?php
    include "../php/conexion.php";

    $id_restaurante = $_POST['id_restaurante'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];

    $nombreImagen = $_FILES['imagen']['name'];
    $tmpImagen = $_FILES['imagen']['tmp_name'];
    $rutaImagen = "../images/restaurantes/" . $id_restaurante . "/productos/" . $nombreImagen;

    
    if (move_uploaded_file($tmpImagen, $rutaImagen)) {
    
    $sqlInsertarProducto = "INSERT INTO productos (id_producto,id_restaurante, nombre_producto, precio, imagen) VALUES (null,'$id_restaurante', '$producto', '$precio', '$nombreImagen')";
    $resultadoInsertar = mysqli_query($conexion, $sqlInsertarProducto);

    if ($resultadoInsertar) {
        echo "Producto agregado correctamente";
    } else {
        echo "Error al agregar el producto";
    }
    } else {
    
    echo "Error al subir la imagen";
    }
?>