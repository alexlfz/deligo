<?php
    include "../php/conexion.php";
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $SQLObtenerUsuario = "SELECT * FROM usuarios WHERE email='$email'";
    $paqueteObtenerUsuario=mysqli_query($conexion, $SQLObtenerUsuario);

    while($fila=mysqli_fetch_array($paqueteObtenerUsuario)){
        if(($email==$fila['email'])and(password_verify($password,$fila['password']))){
            session_start();
            $_SESSION['id_usuario'] = $fila['id_usuario'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellidos'] = $fila['apellidos'];
            $_SESSION['email'] = $fila['email'];
            $_SESSION['password'] = $password;
            $_SESSION['direccion'] = $fila['direccion'];
            $_SESSION['telefono'] = $fila['telefono'];
            $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
            header('Location: ../php/main');
        }else{
            header('Location: ../index');
        }
    }
?>