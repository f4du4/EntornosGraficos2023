<?php
include "conexion.php";
if(isset($_POST['submitenviar'])){

    $idUsuario = $_POST['iduser'];
    $idVacante = $_POST['idvac'];
    $estado = "En espera";
    //$archivopdf = $_POST['fileToUpload'];
  
    //$carpeta_destino = "sdgv/";

    //$nombre_archivo = basename($_FILES['fileToUpload']['nombre']);
    //$extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    $vQuery = "INSERT INTO postulaciones(estado, usuarios_id, vacantes_id) VALUES ('$estado', '$idUsuario', '$idVacante')";
    mysqli_query($link, $vQuery) or die (mysqli_error($link));

    mysqli_close($link);
    header("Location: ./cliente_postulaciones.php"); 
    }
    ?>