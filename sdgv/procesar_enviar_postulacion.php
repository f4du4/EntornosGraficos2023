<?php
include "conexion.php";
if(isset($_POST['submitenviar'])){
    if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
        // File information
        $fileTmpPath = $_FILES["pdfFile"]["tmp_name"];
        $pdfName = $_FILES["pdfFile"]["name"]; // Get the original name of the uploaded PDF
    
        // Read the file content and convert it to binary
        $pdfData = file_get_contents($fileTmpPath);
    
        // Convert the binary PDF data to Base64 encoding
        $base64Data = base64_encode($pdfData);
    $idUsuario = $_POST['iduser'];
    $idVacante = $_POST['idvac'];
    $estado = "En espera";

    $vQuery = "INSERT INTO postulaciones(estado, usuarios_id, vacantes_id, cv_nombre, cv_data) VALUES ('$estado', '$idUsuario', '$idVacante', '$pdfName', '$base64Data')";
    mysqli_query($link, $vQuery) or die (mysqli_error($link));
    }
    mysqli_close($link);
    header("Location: ./cliente_postulaciones.php"); 
    }
    ?>