<?php
include "conexion.php";
$id = $_POST['iduser'];
$vQuery = "DELETE FROM usuarios WHERE usuarios.id = '$id'" ;
$vResultado = mysqli_query($link,$vQuery);
mysqli_close($link);
header("Location: ./listar_usuarios.php");
?>
