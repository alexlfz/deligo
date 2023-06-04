<?php
    include "../php/conexion.php";

    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $SQLEditarUsuario= "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', direccion = '$direccion', telefono = '$telefono' WHERE (id_usuario = '$id_usuario');";
    $paqueteEditarUsuario=mysqli_query($conexion, $SQLEditarUsuario);

    if($paqueteEditarUsuario){
        session_start();
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['direccion'] = $direccion;
        $_SESSION['telefono'] = $telefono;
        header('Location: ../php/main');
    }else{
        echo("<h1>Error en la solicitud</h1>");
    }

?>