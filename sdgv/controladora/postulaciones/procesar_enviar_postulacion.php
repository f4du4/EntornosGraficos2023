<?php
include "../db/conexion.php";
if (isset($_POST["submitenviar"])) {
    if (isset($_POST["iduser"], $_POST["idvac"], $_FILES["pdfFile"]) && !empty($_POST["iduser"]) && !empty($_POST["idvac"]) && !empty($_FILES["pdfFile"]["name"])) {
        $extensionesPermitidas = ['pdf'];
        $extensionDelArchivo = strtolower(pathinfo($_FILES["pdfFile"]["name"], PATHINFO_EXTENSION));
        if (in_array($extensionDelArchivo, $extensionesPermitidas)) {
            if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
                $pathTemporal = $_FILES["pdfFile"]["tmp_name"];
                $nombrePdf = $_FILES["pdfFile"]["name"];
                $dataPdf = file_get_contents($pathTemporal);
                $pdfDataBase64 = base64_encode($dataPdf);
                $idUsuario = mysqli_real_escape_string($link, $_POST["iduser"]);
                $idVacante = mysqli_real_escape_string($link, $_POST["idvac"]);
                $estado = "En espera";
                $vQuery = "INSERT INTO postulaciones(estado, usuarios_id, vacantes_id, cv_nombre, cv_data) VALUES ('$estado', '$idUsuario', '$idVacante', '$nombrePdf', '$pdfDataBase64')";
                mysqli_query($link, $vQuery) or die(mysqli_error($link));
                header("Location: ../../paginas/postulaciones/cliente_postulaciones.php");
                exit;
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Only PDF files are allowed.";
        }
    } else {
        echo "Please fill out all the required fields.";
    }
}
mysqli_close($link);
