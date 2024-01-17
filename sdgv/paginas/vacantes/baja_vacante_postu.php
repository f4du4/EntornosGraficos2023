<?php
require_once "../../index.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja Vacante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">

        <?php
        include BASE_PATH . "/componentes/mapeador/mapeador_header.php";
        $idVac = $_POST['idvac'];

        ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Eliminar Vacante con Postulaciones</h2>
            <p class="text-center descripcion">Si realmente desea eliminar esta vacante que ya tiene postulaciones,
                al hacerlo el sistema notificara al jefe de catedra a cargo de la materia y a los postulantes. Para eliminarla,
                presione el boton</p>
            <form method="POST" class="d-flex flex-column iniciosesion" action="../../controladora/vacantes/baja_vacante.php">
                <input type="hidden" name="idvacante" readonly value="<?php echo $idVac; ?>">
                <input type="submit" name="submitbaja" value="ELIMINAR" class="mt-3 mb-3 p-2 click boton">
            </form>
        </div>
        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>