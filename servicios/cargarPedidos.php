<?php
include "../php/conexion.php";

session_start();

$id_cliente = $_SESSION['id_usuario'];

$SQLObtenerPedidos = "SELECT p.*, r.nombre AS nombre_restaurante, r.imagen AS imagen_restaurante, r.id_restaurante 
                        FROM pedidos p 
                        JOIN restaurantes r ON p.id_restaurante = r.id_restaurante 
                        WHERE p.id_cliente = $id_cliente";

$paqueteObtenerPedidos = mysqli_query($conexion, $SQLObtenerPedidos);

if (mysqli_num_rows($paqueteObtenerPedidos) > 0) {
    $respuesta = array();
    while ($dato = $paqueteObtenerPedidos->fetch_assoc()) {
        $id_pedido = $dato['id_pedido'];

        // Obtener los detalles del pedido desde la tabla detallespedidos
        $SQLObtenerDetalles = "SELECT d.*, pr.nombre_producto 
                                FROM detallespedidos d 
                                JOIN productos pr ON d.id_producto = pr.id_producto 
                                WHERE id_pedido = $id_pedido";
        $paqueteObtenerDetalles = mysqli_query($conexion, $SQLObtenerDetalles);
        $detalles = array();
        while ($detalle = $paqueteObtenerDetalles->fetch_assoc()) {
            $auxDetalle = array(
                'id_producto' => $detalle['id_producto'],
                'nombre_producto' => $detalle['nombre_producto'],
                'cantidad' => $detalle['cantidad'],
                'subtotal' => $detalle['subtotal']
            );
            array_push($detalles, $auxDetalle);
        }

        $auxData = array(
            'id_restaurante' => $dato['id_restaurante'],
            'nombre_restaurante' => $dato['nombre_restaurante'],
            'imagen_restaurante' => $dato['imagen_restaurante'],
            'fecha_pedido' => $dato['fecha_pedido'],
            'direccion_entrega' => $dato['direccion_entrega'],
            'detalles' => $detalles
        );
        array_push($respuesta, $auxData);
    }
    header('Content-type: application/json');
    echo json_encode($respuesta, JSON_FORCE_OBJECT);
} else {
    echo 0;
}
?>

