<?php
require_once "../../index.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Usuario</title>
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
        $mensaje = 'Ha ocurrido un error, por favor, intentelo nuevamente.';
        $errores = array(
            1 => $mensaje,
            2 => "Error al cargar el cv, asegurese que el archivo que intenta cargar tenga el formato PDF",
        );
        if (isset($_GET['code'])) {
            $codigo = $_GET['code'];
            if (array_key_exists($codigo, $errores)) {
                $mensaje = $errores[$codigo];
            }
        }
        ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="errorBackend">
                <?php echo $mensaje; ?>
                <br>
                <br>
                <a href="../vacantes/vacantes_abiertas.php" type="submit" class="btn btn-light">Ver vacantes abiertas</a><br> <br>
            </h2>
        </div>

        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>