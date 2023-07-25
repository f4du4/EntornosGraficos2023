<?php
include "conexion.php";
$id = $_POST['idvac'];
$vQuery = "DELETE FROM vacantes WHERE vacantes.id = '$id'" ;
$vResultado = mysqli_query($link,$vQuery);
mysqli_close($link);
header("Location: ./lista_vacantes.php");
?>