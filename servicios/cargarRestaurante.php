<?php
    session_start();
    include "../php/conexion.php";
    
    $SQLObtenerRestaurante = "SELECT * FROM restaurantes WHERE id_usuario = " . $_SESSION['id_usuario'];
    $paqueteObtenerRestaurante=mysqli_query($conexion, $SQLObtenerRestaurante);

    if(mysqli_num_rows($paqueteObtenerRestaurante) > 0){
        $respuesta = array();
        while($dato = $paqueteObtenerRestaurante->fetch_assoc()){
            $auxData = array(
                'id_restaurante' => $dato['id_restaurante'],
                'nombre' => $dato['nombre'],
                'direccion' => $dato['direccion'],
                'telefono' => $dato['telefono'],
                'id_usuario' => $dato['id_usuario'],
                'imagen' => $dato['imagen']
            );
            array_push($respuesta,$auxData);
        }
        header('Content-type: application/json');
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }else{
        echo 0;
    }
?>