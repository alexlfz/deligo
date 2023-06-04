var respuestaRestaurante = [];

$(document).ready(function () {
    respuestaRestaurante = JSON.parse(localStorage.getItem('respuestaRestaurante'));

    mostrarRestaurante(respuestaRestaurante[0]);
});


$(document).on('click', '#carritoCompra', function () {
    var productos = [];
    $('[id^=inputCantidad]').each(function () {
        var idProducto = $(this).attr('id').replace('inputCantidad', '');
        var cantidad = $(this).val();
        if (cantidad > 0) {
            productos.push({
                id_producto: idProducto,
                cantidad: cantidad
            });
        }
    });

    realizarPedido(productos,respuestaRestaurante[0].id_restaurante);

    window.location.href = '../php/main';
});

function mostrarRestaurante(respuestaRestaurante) {
    $('#div-restaurante').append(`
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <h3>${respuestaRestaurante.nombre.toUpperCase()}</h3>
                <img src="../images/restaurantes/` + respuestaRestaurante.id_restaurante + `/` + respuestaRestaurante.imagen + `" class="img-fluid custom-image-size">
                <p class="mt-3">Dirección: ` + respuestaRestaurante.direccion + `</p>
                <p>Teléfono: ` + respuestaRestaurante.telefono + `</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <h3>PRODUCTOS</h3>
                <div class="row mt-2" id="div-productos"></div>
            </div>
        </div>
    `);
    cargarProductos(respuestaRestaurante.id_restaurante);
}

function cargarProductos(id_restaurante) {
    datos = {
        id_restaurante: id_restaurante
    };
    $.ajax({
        url: "../servicios/cargarProductos",
        type: "GET",
        data: datos
    }).done(function (respuesta) {
        if (respuesta != 0) {
            for (i = 0; i < Object.keys(respuesta).length; i++) {
                if (i != Object.keys(respuesta).length - 1) {
                    $('#div-productos').append(`
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <img src="../images/restaurantes/` + id_restaurante + `/productos/` + respuesta[i].imagen + `" class="img-fluid rounded" alt="Imagen">
                        </div>
                        <div class="col-md-6">
                            <p class="m-0 py-2 border-bottom">` + respuesta[i].nombre_producto.toUpperCase() + ` (` + respuesta[i].precio + `€)</p>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="inputCantidad` + respuesta[i].id_producto + `" min="0" value="0">
                        </div>
                    </div>
                    `);
                } else {
                    $('#div-productos').append(`
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <img src="../images/restaurantes/` + id_restaurante + `/productos/` + respuesta[i].imagen + `" class="img-fluid rounded" alt="Imagen">
                        </div>
                        <div class="col-md-6">
                            <p class="m-0 py-2 border-bottom">` + respuesta[i].nombre_producto.toUpperCase() + ` (` + respuesta[i].precio + `€)</p>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="inputCantidad` + respuesta[i].id_producto + `" min="0" value="0">
                        </div>
                        <div id="carritoCompra">&#128722;</div>
                    </div>
                    `);
                }
            }
        }
    });
}

function realizarPedido(productos, id_restaurante) {
    if (productos.length > 0) {
        $.ajax({
            url: "../servicios/realizarPedido.php",
            type: "POST",
            data: JSON.stringify({id_restaurante: id_restaurante, productos: productos }),
            contentType: "application/json"
        }).done(function (respuesta) {
            console.log(respuesta);
        });
    } else {
        console.log("No hay productos seleccionados");
    }
}