<?php
include "conexion.php";
if(isset($_POST['submitcargar'])){
    if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
        // File information
        $pathTemporal = $_FILES["pdfFile"]["tmp_name"];
        $nombrepdf = $_FILES["pdfFile"]["name"]; // Get the original name of the uploaded PDF
    
        // Read the file content and convert it to binary
        $pdfToBinary = file_get_contents($pathTemporal);
    
        // Convert the binary PDF data to Base64 encoding
        $pdfDataBase64 = base64_encode($pdfToBinary);
        $idVacante = $_POST['idvac'];

    $vQuery = "UPDATE vacantes SET om_nombre = '$nombrepdf', om_data = '$pdfDataBase64' WHERE vacantes.id = $idVacante";
    mysqli_query($link, $vQuery) or die (mysqli_error($link));
    }
    mysqli_close($link);
    header("Location: ./cargar_orden_merito.php"); 
    }
    ?>