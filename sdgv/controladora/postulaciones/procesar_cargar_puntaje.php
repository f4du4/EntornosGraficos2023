<?php
include "../db/conexion.php";
if (isset($_POST["submitCarga"])) {
    $puntos = $_POST["puntos"];
    $idP = $_POST["idPos"];

    $idMateria = $_POST['idMateria'];
    $vQuery = "UPDATE postulaciones SET puntaje = '$puntos' WHERE postulaciones.id = $idP";
    mysqli_query($link, $vQuery) or die(mysqli_error($link));
    header("Location: ../../paginas/postulaciones/obtener_postulaciones.php?id=" . $idMateria);
}
mysqli_close($link);
