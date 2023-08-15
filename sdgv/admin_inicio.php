<?php
session_start();
if ($_SESSION['email'] == null || $_SESSION['email'] == '') {
    header("Location: ./ingreso.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php
        include "./admin_header.html";
        include "./admin_menu.html";
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h1 class="text-center inicio p-4">¡Bienvendo al Sistema de Gestion de Vacantes de la Universidad Tecnológica Nacional - FRRo!</h1>
            <p class="inicio descripcion p-3 text-center">La universidad Tecnológica Nacional de Rosario se encuentra ubicada en el centro de la ciudad de Rosario,
                con direccion en Zeballos 1341, fue fundada en 1953 y actualmente consta de cinco carreras de grado. <br> <br>
                Este sitio web tiene como proposito la agilizacion del proceso de postulacion a vacantes en la Universidad,
                con el fin de lograr re-asignar los cargos de manera rapida y equitativa, donde los alumnos,
                los profesores y la institucion se vean beneficiados.
                <br>
            </p>
            <h3 class="text-center p-3">MAPA DE SITIO</h3>
            <img src="mapasitio_admin.png" alt="Mapa de Sitio de Administradores del Sitio Web de Gestion de Vacantes de la UTN FRRo" class="mapasitio" />
        </div>
        <?php
        include "./footer.html";
        ?>
    </div>
</body>

</html>