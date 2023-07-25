<?php
include "conexion.php";
if(isset($_POST['submiteditar'])){

$id = $_POST['iduser'];
$nom = $_POST['nombreuser'];
$ape = $_POST['apellidouser'];
$email = $_POST['emailuser'];
$pass = $_POST['passuser'];

$vQuery = "UPDATE usuarios SET usuarios.nombre = '$nom', usuarios.apellido = '$ape',
usuarios.email = '$email', usuarios.pass = '$pass' WHERE usuarios.id = '$id'";
$vResultado = mysqli_query($link,$vQuery);

mysqli_close($link);
header("Location: ./perfil_usuario.php");
}
?>