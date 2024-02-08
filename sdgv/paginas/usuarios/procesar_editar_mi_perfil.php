<?php
include "../db/conexion.php";
session_start();
if (isset($_POST["submiteditar"]) && isset($_POST["id"])) {
    $id = $_POST["iduser"];
    if ($_SESSION["id"] == $id) {

        $nom = $_POST["nombreuser"];
        $ape = $_POST["apellidouser"];
        $email = $_POST["emailuser"];
        $pass = $_POST["passuser"];

        $vQuery = "UPDATE usuarios SET usuarios.nombre = '$nom', usuarios.apellido = '$ape',
usuarios.email = '$email', usuarios.pass = '$pass' WHERE usuarios.id = '$id'";
        mysqli_query($link, $vQuery);
        mysqli_close($link);
        header("Location: ../../paginas/usuarios/perfil_usuario.php");
    } else {
        header("Location: ../../paginas/usuarios/error_editar_perfil_usuario.php");
    }
}
