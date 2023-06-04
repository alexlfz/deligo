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
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../js/main.js"></script>
    <title>DELIGO</title>
</head>

<body class="d-flex flex-column">
    <?php include 'header.php' ?>
    <div id="page-content">
        <div class="container">
            <h1 class="my-4">RESTAURANTES</h1>
            <div class="row" id="div-restaurantes">
                

            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>