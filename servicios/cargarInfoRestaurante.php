<?php
    session_start();
    include "../php/conexion.php";

    $id_restaurante = $_POST['id_restaurante'];
    
    $SQLObtenerInfoRestaurante = "SELECT * FROM restaurantes WHERE id_restaurante = $id_restaurante";
    $paqueteObtenerInfoRestaurante=mysqli_query($conexion, $SQLObtenerInfoRestaurante);

    if(mysqli_num_rows($paqueteObtenerInfoRestaurante) > 0){
        $respuesta = array();
        while($dato = $paqueteObtenerInfoRestaurante->fetch_assoc()){
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