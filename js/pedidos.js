$(document).ready(function () {
    listarPedidos();
});

function listarPedidos() {
    datos = {};
    $.ajax({
        url: "../servicios/cargarPedidos",
        type: "GET",
        data: datos
    }).done(function (respuesta) {
        console.log(respuesta);
        var divPedidos = $('#div-pedidos');

        if (respuesta != 0) {
            for (var i = 0; i < Object.keys(respuesta).length; i++) {
                var pedido = respuesta[i];
                var idRestaurante = pedido.id_restaurante;
                var nombreRestaurante = pedido.nombre_restaurante;
                var imagenRestaurante = pedido.imagen_restaurante;
                var fechaPedido = pedido.fecha_pedido;
                var direccionEntrega = pedido.direccion_entrega;
                var detalles = pedido.detalles;
                var subtotalTotal = 0;

                var filaPedido = `
            <div class="row align-items-center mb-3 pedido">
            <div class="col-md-2">
                <img src="../images/restaurantes/` + idRestaurante + `/` + imagenRestaurante + `" class="img-fluid rounded img-pedido" alt="Imagen Restaurante">
            </div>
            <div class="col-md-5">
                <div class="nombre-restaurante">` + nombreRestaurante + `</div>
                <p class="direccion-entrega">Dirección de Entrega: ` + direccionEntrega + `</p>
                <p class="fecha-pedido">` + fechaPedido + `</p>
            </div>
            <div class="col-md-5">
                <p class="detalles-pedido">Detalles del Pedido:</p>
                <ul class="detalles-list">`;

                for (var j = 0; j < Object.keys(detalles).length; j++) {
                    var detalle = detalles[j];
                    var nombreProducto = detalle.nombre_producto;
                    var cantidad = detalle.cantidad;
                    var subtotal = detalle.subtotal;
                    subtotalTotal += parseFloat(subtotal);

                    filaPedido += `
            <li>` + cantidad + ` | ` + nombreProducto + ` ` + parseFloat(subtotal) + `€ </li>`;
                }

                filaPedido += `
                <li class="subtotal-total">Total: ${subtotalTotal.toFixed(2)}€</li>
                </ul>
            </div>
            </div>
            `;

                divPedidos.append(filaPedido);
            }
        }
    });
}