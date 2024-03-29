<?php
session_start();
require_once "../../index.php";
include BASE_PATH . "/controladora/db/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Correo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <?php include BASE_PATH . "/componentes/mapeador/mapeador_header.php"; ?>
    <div class="row d-flex-row justify-content-center pt-2">
        <h2 class="text-center p-4 pt-3 titulo">¡Notificacion enviada exitosamente!</h2>
        <br>
        <a href="./jefecatedra_vacantes.php" type="submit" name="submitingreso" class="mt-4 mb-5 p-2 btn btn-success exito">Volver a mis vacantes</a>
        <br>
        <br>
    </div>
    <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
</body>

</html>