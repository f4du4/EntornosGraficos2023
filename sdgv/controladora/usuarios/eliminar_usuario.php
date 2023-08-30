<?php
include "../db/conexion.php";
if (isset($_POST["submiteliminar"])) {
    $id = $_POST["iduser"];
    $vQuery = "DELETE FROM usuarios WHERE usuarios.id = '$id'";
    $vResultado = mysqli_query($link, $vQuery);
    header("Location: ../../paginas/usuarios/aprobacion_eliminar_usuario.php");
}
mysqli_close($link);
mysqli_free_result($vResultado);
die();
