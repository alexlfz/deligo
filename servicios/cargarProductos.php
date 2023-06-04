<?php
    include "../php/conexion.php";

    $id_restaurante = $_GET['id_restaurante'];
    
    $SQLObtenerProductos = "SELECT * FROM productos WHERE id_restaurante = $id_restaurante";
    $paqueteObtenerProductos=mysqli_query($conexion, $SQLObtenerProductos);

    if(mysqli_num_rows($paqueteObtenerProductos) > 0){
        $respuesta = array();
        while($dato = $paqueteObtenerProductos->fetch_assoc()){
            $auxData = array(
                'id_restaurante' => $dato['id_restaurante'],
                'id_producto' => $dato['id_producto'],
                'nombre_producto' => $dato['nombre_producto'],
                'precio' => $dato['precio'],
                'imagen' => $dato['imagen'],
            );
            array_push($respuesta,$auxData);
        }
        header('Content-type: application/json');
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }else{
        echo 0;
    }
?>