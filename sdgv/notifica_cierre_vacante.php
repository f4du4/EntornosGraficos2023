<?php
// Include any necessary configuration or database connection files Connect to the database
include "conexion.php";

// Get the current date
date_default_timezone_set("America/Argentina/Buenos_Aires"); //defino la zona horaria
$dia = date("d"); //j es los dias sin el cero adelante
$mes = date("m"); //n es los meses sin el cero adelante
$year = date("Y");
$hora = date("H"); //horas de 00 a 23
$min = date("i"); //minutos de 00 a 59
$seg = date("s"); //segundos de 00 a 59
$hoy = date("Y-m-d H:i:s");

// Query the database to get the data for emails that have passed the endDate
$vQuery = "SELECT usuarios.email, vacantes.fue_enviado, materias.nombreMat,vacantes.nombre, usuarios.nombre as nombreUser, usuarios.apellido
FROM vacantes INNER JOIN 
materias ON materias.id = vacantes.materia INNER JOIN usuarios ON materias.jefecatedra_id = usuarios.id
WHERE vacantes.fechaFin <= '$hoy' OR vacantes.fue_enviado != 1";
$vResultado = mysqli_query($link, $vQuery);

// Check if the query was successful
if (!$vResultado) {
    die("Query failed: " . mysqli_error($link));
}

// Loop through the vResultados and send emails
while ($row = mysqli_fetch_assoc($vResultado)) {
    $nom = $row['nombreUser'];
    $ape = $row['apellido'];
    $email = $row['email'];
    $materia = $row['nombreMat'];
    $puesto = $row['nombre'];
    $message = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Notificacion Nueva Vacante</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'>
        <link rel='stylesheet' href='./estilos.css'>
    </head>
    <body class='mensajemail'>
        <h1 class='pt-5 p-3 text-center justify-content-center mensajemail'>¡Hola {$nom} {$ape}!</h1>
        <h3 class='p-3 text-center justify-content-center mensajemail'>Te enviamos ésta notificación desde el sistema de gestión de vacantes 
            de la Universidad Tecnológica Nacional para informarte que actualmente se cerró la vacante para 
            el puesto de {$puesto} en la materia {$materia}. Ya puedes comenzar con la etapa de selección. 
        
        </h3>
    </body>
    </html>"; //aca iria html

    // Send the email using mail() function or a PHP mail library
    // ...
    // For example, using the mail() function:

    mail('faduadora77@gmail.com', 'Your Subject', $message, 'From: faduadora77@gmail.com');
}

// Close the database link
mysqli_close($link);
?>