$(document).ready(function(){
    cargarRestaurantes();
});

$(document).on('click', '.restaurante', function(event) {
    event.preventDefault();
    var idRestaurante = $(this).attr('id');
    obtenerRestaurante(idRestaurante);
});

function cargarRestaurantes(){
    datos = {};
    $.ajax({
        url: "../servicios/cargarRestaurantes.php",
        type: "POST",
        data: datos
    }).done(function(respuesta){
        if(respuesta != 0){
            for(i=0;i<Object.keys(respuesta).length;i++){
                $('#div-restaurantes').append(`
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card h-100 restaurante" id="`+respuesta[i].id_restaurante+`">
                        <a><img class="card-img-top img-fluid custom-image-size" src="../images/restaurantes/`+ respuesta[i].id_restaurante +`/`+ respuesta[i].imagen +`" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">` + respuesta[i].nombre+`</a>
                            </h4>
                            <p class="card-text">` + respuesta[i].direccion + " | " +  respuesta[i].telefono +`</p>
                        </div>
                    </div>
                </div>
                `);
            }
        }
    })
}

function obtenerRestaurante(idRestaurante){
    console.log(idRestaurante);

    const formData = new FormData();
    formData.append('id_restaurante', idRestaurante);
    $.ajax({
        url: "../servicios/cargarInfoRestaurante.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false
    }).done(function(respuesta){
        console.log(respuesta);

        localStorage.setItem('respuestaRestaurante', JSON.stringify(respuesta));

        window.location.href = '../php/infoRestaurante';
    });
}