<?php
include "conexion.php";
if (isset($_POST['submitEmail'])) {
    $idPostulacion = $_POST['idPostu'];
    $idVacante = $_POST['idVac'];
    $destino = $_POST['emailUser'];
    $nombre = $_POST['nombreUser'];
    $apellido = $_POST['apellidoUser'];
    $puesto = $_POST['puesto'];
    $materia = $_POST['materia'];

    $asunto = "Ganaste Concurso Vacante";
    $headers = "From:noreply@example.com\r\n";
    $headers .= "Reply-To:noreply@example.com\r\n";
    $headers .= "MIME-Version:1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $mensaje = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Notificacion Ganador Vacante</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'>
        <link rel='stylesheet' href='./estilos.css'>
    </head>
    <body>
        <h1>¡Hola {$nombre} {$apellido}!</h1>
        <h3>Te enviamos ésta notificación desde el sistema de gestión de vacantes 
            de la Universidad Tecnológica Nacional para informarte que fuiste seleccionado/a para la vacante de la materia {$materia}
            para el puesto de {$puesto}. Acercate hasta la Universidad para conocer los pasos a seguir. 
        
        </h3>
    </body>
    </html>";

    mail($destino, $asunto, $mensaje, $headers);
    $ActualizaQuery = "UPDATE postulaciones SET estado = 'Aceptada' WHERE postulaciones.id = $idPostulacion";
    mysqli_query($link, $ActualizaQuery) or die(mysqli_error($link));

    $RechazaQuery = "UPDATE postulaciones SET estado = 'Rechazada' WHERE postulaciones.vacantes_id = $idVacante AND postulaciones.id != $idPostulacion";
    mysqli_query($link, $RechazaQuery) or die(mysqli_error($link));
}
mysqli_close($link);

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
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <?php
    include "./jefecatedra_header.html";
    include "./jefecatedra_menu.html";
    include "./breadcrumbs.php";
    ?>
    <div class="row d-flex-row justify-content-center pt-2">
        <h2 class="text-center p-4 pt-3 titulo">¡Notificacion enviada exitosamente!</h2>
        <br>
        <a href="./jefecatedra_vacantes.php" type="submit" name="submitingreso" class="mt-4 mb-5 p-2 btn btn-success exito">Volver Atras</a>
        <br>
        <br>
    </div>
    <?php
    include "./footer.html";
    ?>
</body>

</html>