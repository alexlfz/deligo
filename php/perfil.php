<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location:../index.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../js/main.js"></script>
    <title>DELIGO</title>
</head>

<body class="d-flex flex-column">
    <?php include 'header.php' ?>
    <div id="page-content">
        <div class="container">
            <div class="row">
                <form action="../servicios/editarUsuario" method="POST">
                    <h1 class="text-center mb-5 fw-light mt-5">EDITAR PERFIL</h1>
                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputNombre" name="nombre" value="<?php echo $_SESSION['nombre']; ?>">
                        <input type="text" class="form-control" id="inputId_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>" style="display:none">
                    </div>
                    <div class="mb-3">
                        <label for="inputApellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="inputApellidos" name="apellidos" value="<?php echo $_SESSION['apellidos']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputDireccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="inputDireccion" name="direccion" value="<?php echo $_SESSION['direccion']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="inputTelefono" name="telefono" value="<?php echo $_SESSION['telefono']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Aceptar</button>
                </form>
            </div>
        </div>

    </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>