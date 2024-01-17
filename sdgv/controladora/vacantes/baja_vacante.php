<?php
$idVacante = $_POST['idvacante'];
include BASE_PATH . "/controladora/db/conexion.php";
//traigo todos los usuarios postulados
$vQueryPostulantes = "SELECT usuarios.email, usuarios.nombre, usuarios.apellido, postulaciones.id FROM postulaciones INNER JOIN usuarios ON postulaciones.usuarios_id = usuarios.id 
    WHERE postulaciones.vacantes_id = '$idVacante'";

//traigo al jefe de catedra vinculado con esa vacante
$vQueryJefeCatedra = "SELECT usuarios.email, usuarios.nombre, usuarios.apellido, materias.nombreMat FROM vacantes INNER JOIN materias ON materias.id = vacantes.materia 
    INNER JOIN usuarios ON materias.jefecatedra_id = usuarios.id WHERE vacantes.id = '$idVacante' ";

$vResultPostu = mysqli_query($link, $vQueryPostulantes);
$vResultJC = mysqli_query($link, $vQueryJefeCatedra);

//primero mando mail al profesor
$rowJC = mysqli_fetch_array($vResultJC);
$emailJC = $rowJC["email"];
$nombreJC = $rowJC["nombre"];
$apeJC = $rowJC["apellido"];
$materiaJC = $rowJC["nombreMat"];

$asuntoJC = "Baja de Vacante";
$headersJC = "From:noreply@example.com\r\n";
$headersJC .= "Reply-To:noreply@example.com\r\n";
$headersJC .= "MIME-Version:1.0\r\n";
$headersJC .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mensajeJC = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Baja de una Vacante</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'>
        <link rel='stylesheet' href='estilos/estilos.css'>
    </head>
    <body>
        <h1>Hola {$nombreJC} {$apeJC}</h1>
        <h3>Te enviamos ésta notificación desde el sistema de gestión de vacantes 
            de la Universidad Tecnológica Nacional para informarte que se ha eliminado una vacante de la materia {$materiaJC}.  
        
        </h3>
    </body>
    </html>";

mail($emailJC, $asuntoJC, $mensajeJC, $headersJC);

// mando mail a postulantes
if ($vResultPostu) {
    while ($rowPostu = mysqli_fetch_assoc($vResultPostu)) {
        $emailPostu = $rowPostu['email'];
        $nombrePostu = $rowPostu['nombre'];
        $apellidoPostu = $rowPostu['apellido'];
        $idPostu = $rowPostu['id'];

        $asuntoPostu = "Baja de una vacante y su postulacion";
        $mensajePostu = "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Baja de una vacante y su postulacion</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
                <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'>
                <link rel='stylesheet' href='estilos/estilos.css'>
            </head>
            <body>
                <h1>Hola {$nombrePostu} {$apellidoPostu}</h1>
                <h3>Le enviamos ésta notificación desde el sistema de gestión de vacantes 
                    de la Universidad Tecnológica Nacional para informarle que se ha eliminado una vacante de la materia {$materiaJC} 
                    a la cual usted se habia postulado.  
                
                </h3>
            </body>
            </html>";

        mail($emailPostu, $asuntoPostu, $mensajePostu, $headersJC);

        $vQueryBajaPostu = "DELETE FROM postulaciones WHERE id = '$idPostu'";
        $vResultBajaPostu = mysqli_query($link, $vQueryBajaPostu);
    }
}

$vQueryBajaVacante = "DELETE FROM vacantes WHERE id = '$idVacante'";
$vResultBajaVacante = mysqli_query($link, $vQueryBajaVacante);

header("Location: ../../paginas/vacantes/aprobacion_eliminar_vacante.php");
die();
mysqli_free_result($vResultJC);
mysqli_free_result($vResultPostu);
mysqli_free_result($vResultBajaVacante);
mysqli_free_result($vResultBajaPostu);
mysqli_close($link);
