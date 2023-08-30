<?php
include "../db/conexion.php";
if (isset($_POST["submitCarga"])) {
    $puntos = $_POST["puntos"];
    $idP = $_POST["idPos"];
    $vQuery = "UPDATE postulaciones SET puntaje = '$puntos' WHERE postulaciones.id = $idP";
    mysqli_query($link, $vQuery) or die(mysqli_error($link));
    header("Location: ../../paginas/vacantes/jefecatedra_vacantes.php");
}
mysqli_close($link);
