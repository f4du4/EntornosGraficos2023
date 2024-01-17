<?php
include "../db/conexion.php";
if (isset($_POST["submiteliminar"])) {
    $id = $_POST["idvac"];
    $vQuery = "DELETE FROM vacantes WHERE vacantes.id = '$id'";
    $vResultado = mysqli_query($link, $vQuery);
    header("Location: ../../paginas/vacantes/aprobacion_eliminar_vacante.php");
}
mysqli_close($link);
mysqli_free_result($vResultado);

die();
