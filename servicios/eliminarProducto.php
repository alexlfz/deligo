<?php
    include "../php/conexion.php";

    $id_restaurante = $_GET['id_restaurante'];
    
    if(isset($_POST['id_producto'])){
        $id_restaurante = $_POST['id_restaurante'];
        $id_producto = $_POST['id_producto'];
        $imagen = $_POST['imagen'];
        unlink("../images/restaurantes/".$id_restaurante."/productos"."/".$imagen);

        $SQLEliminarProducto = "DELETE FROM productos WHERE id_producto = $id_producto";
        $paqueteEliminarProducto=mysqli_query($conexion, $SQLEliminarProducto);
    }else{
        echo ("Falta la variable id_producto");
    }
?>