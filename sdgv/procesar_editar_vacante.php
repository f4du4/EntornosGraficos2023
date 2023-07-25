<?php
include "conexion.php";
if(isset($_POST['submiteditar'])){

$id = $_POST['idvacante'];
$puesto = $_POST['nombrevacante'];
$desc = $_POST['descripcionvacante'];
$fechaIni = $_POST['fechaInivacante'];
$fechaFin = $_POST['fechaFinvacante'];
$materia = $_POST['materiavacante'];

$vQuery = "UPDATE vacantes SET vacantes.nombre = '$puesto', vacantes.descripcion = '$desc',
vacantes.fechaIni = '$fechaIni', vacantes.fechaFin = '$fechaFin', vacantes.materia = '$materia' WHERE vacantes.id = '$id'";
$vResultado = mysqli_query($link,$vQuery);

mysqli_close($link);
header("Location: ./lista_vacantes.php");
}
?>