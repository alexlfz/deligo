$(document).ready(function () {
    cargarRestaurante();
});

function cargarRestaurante() {
    datos = {};
    $.ajax({
        url: "../servicios/cargarRestaurante",
        type: "GET",
        data: datos
    }).done(function (respuesta) {
        if (respuesta != 0) {
            for (i = 0; i < Object.keys(respuesta).length; i++) {
                $('#div-restaurante').append(`
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <h3>` + (respuesta[0].nombre).toUpperCase() + `</h3>
                        <img src="../images/restaurantes/`+respuesta[0].id_restaurante+`/`+respuesta[0].imagen+`" class="img-fluid custom-image-size" alt="...">
                        <p class="mt-3">Dirección: ` + respuesta[0].direccion + `</p>
                        <p>Teléfono: ` + respuesta[0].telefono + `</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <h3>PRODUCTOS</h3>
                        <div class="row mt-2">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="inputId_restaurante" name="id_restaurante" value="` + respuesta[0].id_restaurante + `" style="display:none">
                                    <input type="file" class="form-control-file mt-1" name="imagen" id="inputImagen" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mt-1" id="inputProducto" name="producto" placeholder="Producto">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control mt-1" id="inputPrecio" name="precio" placeholder="Precio">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success mt-3 w-100" id="btnAgregarProducto">Agregar nuevo producto</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2" id="div-productos">

                        </div>
                    </div>
                </div>
                `);
            }

            cargarProductos(respuesta[0].id_restaurante)

        } else {
            $('#div-restaurante').append(`
                <div class="row">
                    <form action="../servicios/crearRestaurante.php" method="POST">
                        <h1 class="text-center my-3">CREA TU PROPIO RESTAURANTE</h1>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="inputNombreNuevo" name="inputNombreNuevo" placeholder="Nombre">
                            <label for="inputNombre">Nombre del restaurante</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="inputDireccionNuevo" name="inputDireccionNuevo" placeholder="Dirección">
                            <label for="inputDireccion">Dirección</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="inputTelefonoNuevo" name="inputTelefonoNuevo" placeholder="Teléfono">
                            <label for="inputTelefono">Teléfono</label>
                            <input type="file" class="form-control-file mt-1" name="imagen" id="inputImagenNuevo" accept="image/*">
                        </div>
                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="button" id="btnAgregarRestaurante">ACEPTAR</button>
                        </div>
                    </form>
                </div>
            `)
        }
    })
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
                $('#div-productos').append(`
                <div class="row align-items-center mb-3">
                    <div class="col-md-3">
                        <img src="../images/restaurantes/`+id_restaurante+`/productos/`+respuesta[i].imagen+`" class="img-fluid rounded" alt="Imagen">
                    </div>
                    <div class="col-md-6">
                        <p class="m-0 py-2 border-bottom">` + respuesta[i].nombre_producto +` (`+respuesta[i].precio+`€)</p>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger">
                            <i class="bi bi-x" id="btnEliminar" value="`+respuesta[i].id_producto+`/`+respuesta[i].id_restaurante+`/`+respuesta[i].imagen+`">Eliminar</i>
                        </button>
                    </div>
                </div>
            `);
            }
        }
    });
}

$(document).on('click', '#btnEliminar', function(event) {
    event.preventDefault();
    var valor = $(this).attr('value');
    var valoresSeparados = valor.split('/');
    var valor1 = valoresSeparados[0];
    var valor2 = valoresSeparados[1];
    var valor3 = valoresSeparados[2];


    $.ajax({
        url: "../servicios/eliminarProducto",
        type: "POST",
        data: {
            id_producto: valor1,
            id_restaurante: valor2,
            imagen: valor3
        }
    }).done(function(respuesta){
        location.reload(true);
    });
});

$(document).on('click', '#btnAgregarProducto', function(event) {
    event.preventDefault();
    var id_restaurante = $('#inputId_restaurante').val();
    var imagen = $('#inputImagen')[0].files[0];
    var producto = $('#inputProducto').val();
    var precio = $('#inputPrecio').val();

    const formData = new FormData();
    formData.append('id_restaurante', id_restaurante);
    formData.append('imagen', imagen);
    formData.append('producto', producto);
    formData.append('precio', precio);

    $.ajax({
        url: "../servicios/agregarProducto",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false
    }).done(function(respuesta){
        location.reload(true);
    });
});

$(document).on('click', '#btnAgregarRestaurante', function(event) {
    event.preventDefault();
    var nombre_restaurante = $('#inputNombreNuevo').val();
    var direccion = $('#inputDireccionNuevo').val();
    var telefono = $('#inputTelefonoNuevo').val();
    var imagen = $('#inputImagenNuevo')[0].files[0];

    const formData2 = new FormData();
    formData2.append('nombre_restaurante', nombre_restaurante);
    formData2.append('direccion', direccion);
    formData2.append('telefono', telefono);
    formData2.append('imagen', imagen);

    $.ajax({
        url: "../servicios/agregarRestaurante",
        type: "POST",
        data: formData2,
        processData: false,
        contentType: false
    }).done(function(respuesta){
        location.reload(true);
    });
});