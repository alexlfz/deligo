<?php
session_start();

include "../php/conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

$id_restaurante = $data['id_restaurante'];
$productos = $data['productos'];
$id_cliente = $_SESSION['id_usuario'];
$direccion = $_SESSION['direccion'];
$fecha = date('Y-m-d');

$sqlInsertarPedido = "INSERT INTO pedidos (id_pedido, id_restaurante, id_cliente, fecha_pedido, direccion_entrega) VALUES (null, '$id_restaurante', '$id_cliente', '$fecha', '$direccion')";

$paqueteInsertarPedido = mysqli_query($conexion, $sqlInsertarPedido);

if ($paqueteInsertarPedido) {
    $id_pedido = mysqli_insert_id($conexion);

    if ($id_pedido) {
        foreach ($productos as $producto) {
            $id_producto = $producto['id_producto'];
            $cantidad = $producto['cantidad'];

            $sqlObtenerPrecio = "SELECT precio FROM productos WHERE id_producto = '$id_producto'";
            $resultadoPrecio = mysqli_query($conexion, $sqlObtenerPrecio);

            if ($filaPrecio = mysqli_fetch_assoc($resultadoPrecio)) {
                $precio = $filaPrecio['precio'];

                $subtotal = $precio * $cantidad;

                $sqlInsertarDetallesPedido = "INSERT INTO detallespedidos (id_detalle_pedido, id_pedido, id_producto, cantidad, subtotal) VALUES (null, '$id_pedido', '$id_producto', '$cantidad', '$subtotal')";
                $paqueteInsertarDetallesPedido = mysqli_query($conexion, $sqlInsertarDetallesPedido);

                if (!$paqueteInsertarDetallesPedido) {
                    echo "Error al agregar los detalles del pedido";
                    exit;
                }
            } else {
                echo "No se pudo obtener el precio del producto con ID: $id_producto";
                exit;
            }
        }

        echo "Pedido agregado correctamente";
    } else {
        echo "Error al obtener el ID del pedido";
    }
} else {
    echo "Error al agregar el pedido";
}
?>