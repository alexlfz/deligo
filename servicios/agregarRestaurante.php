<?php
session_start();
include "../php/conexion.php";

$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre_restaurante'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$nombreImagen = $_FILES['imagen']['name'];
$tmpImagen = $_FILES['imagen']['tmp_name'];

$sqlInsertarRestaurante = "INSERT INTO restaurantes (id_restaurante, nombre, direccion, telefono, id_usuario, imagen) VALUES (null, '$nombre', '$direccion', '$telefono', $id_usuario, '$nombreImagen')";
$resultadoInsertarRestaurante = mysqli_query($conexion, $sqlInsertarRestaurante);

if ($resultadoInsertarRestaurante) {
    $id_restaurante = mysqli_insert_id($conexion);
    $rutaImagen = "../images/restaurantes/" . $id_restaurante;
    $rutaImagenProductos = "../images/restaurantes/" . $id_restaurante . "/productos/";
    $rutaImagenFoto = "../images/restaurantes/" . $id_restaurante ."/". $nombreImagen;
    
    if (!is_dir($rutaImagen)) {
        mkdir($rutaImagen, 0777, true);
        mkdir($rutaImagenProductos, 0777, true);
    }

    move_uploaded_file($tmpImagen, $rutaImagenFoto);

    echo "Restaurante agregado correctamente";
}
