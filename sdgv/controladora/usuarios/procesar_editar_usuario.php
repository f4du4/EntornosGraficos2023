<?php
include "../db/conexion.php";
if (isset($_POST["submiteditar"])) {
    $id = $_POST["iduser"];
    $nom = $_POST["nombreuser"];
    $ape = $_POST["apellidouser"];
    $email = $_POST["emailuser"];
    //$pass = $_POST['passuser'];
    $rol = $_POST["roliduser"];

    $vQuery = "UPDATE usuarios SET usuarios.nombre = '$nom', usuarios.apellido = '$ape',
usuarios.email = '$email', usuarios.rol_id = '$rol' WHERE usuarios.id = '$id'";
    $vResultado = mysqli_query($link, $vQuery);

    header("Location: ../../paginas/usuarios/listar_usuarios.php");
    die();
}
mysqli_free_result($vResultado);
mysqli_close($link);
