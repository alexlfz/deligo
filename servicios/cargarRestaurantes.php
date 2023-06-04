<?php
    include "../php/conexion.php";
    
    $SQLObtenerRestaurantes = "SELECT * FROM restaurantes;";
    $paqueteObtenerRestaurantes=mysqli_query($conexion, $SQLObtenerRestaurantes);

    if(mysqli_num_rows($paqueteObtenerRestaurantes) > 0){
        $respuesta = array();
        while($dato = $paqueteObtenerRestaurantes->fetch_assoc()){
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