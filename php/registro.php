<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/registro.css">
    <title>DELIGO</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-12 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Crear cuenta en DELIGO</h5>
                        <form action="../servicios/registrar.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Nombre">
                                <label for="inputNombre">Nombre</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputApellidos" name="apellidos" placeholder="Apellidos">
                                <label for="inputApellidos">Apellidos</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección">
                                <label for="inputDireccion">Dirección</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="inputTelefono" name="telefono" placeholder="Teléfono">
                                <label for="inputTelefono">Teléfono</label>
                            </div>
                            <hr>
                            <div class="form-floating mb-3">
                                <input type="Email" class="form-control" id="inputEmail" name="email" placeholder="Correo electrónico">
                                <label for="inputEmail">Correo electrónico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Contraseña">
                                <label for="inputPassword">Contraseña</label>
                            </div>
                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrar</button>
                            </div>
                            <a class="d-block text-center mt-2 small" href="../index">Iniciar sesión</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>