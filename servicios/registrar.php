<?php
    include "../php/conexion.php";

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $SQLRegistrar = "INSERT INTO usuarios (id_usuario,nombre,apellidos,email,password,direccion,telefono) VALUES (null,'$nombre','$apellidos','$email','$password','$direccion','$telefono');";
    $paqueteRegistrar=mysqli_query($conexion, $SQLRegistrar);

    if($paqueteRegistrar){
        header('Location: ../index.php');
    }else{
        echo("<h1>Error en la solicitud</h1>");
    }

?>