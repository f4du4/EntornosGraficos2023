<?php
session_start();
require_once "../../index.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga Puntaje</title>
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
        <?php include BASE_PATH .
            "/componentes/mapeador/mapeador_header.php"; ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-3 titulo">Cargar Puntaje</h2>
            <?php if (isset($_POST["submitPostu"])) {
                $idPostulacion = $_POST["idPostu"];
                $idMateria = $_POST["idMateria"]; ?>
                <form method="post" action="../../controladora/postulaciones/procesar_cargar_puntaje.php" class="d-flex flex-column iniciosesion">
                    <label for="">Puntaje:</label>
                    <input type="number" name="puntos" placeholder="Cargue el puntaje">
                    <input type="hidden" name="idPos" readonly value="<?php echo $idPostulacion; ?>">
                    <input type="hidden" name="idMateria" readonly value="<?php echo $idMateria; ?>">
                    <input type="submit" name="submitCarga" class="btn btn-success exito" value="Cargar"><br> <br>
                </form>
            <?php
            } ?>
        </div>
        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>