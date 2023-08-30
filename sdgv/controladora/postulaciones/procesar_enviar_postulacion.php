<?php
include "../db/conexion.php";
if (isset($_POST["submitenviar"])) {
    if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
        // File information
        $fileTmpPath = $_FILES["pdfFile"]["tmp_name"];
        $pdfName = $_FILES["pdfFile"]["name"]; // Get the original name of the uploaded PDF

        // Read the file content and convert it to binary
        $pdfData = file_get_contents($fileTmpPath);

        // Convert the binary PDF data to Base64 encoding
        $base64Data = base64_encode($pdfData);
        $idUsuario = $_POST["iduser"];
        $idVacante = $_POST["idvac"];
        $estado = "En espera";

        $vQuery = "INSERT INTO postulaciones(estado, usuarios_id, vacantes_id, cv_nombre, cv_data) VALUES ('$estado', '$idUsuario', '$idVacante', '$pdfName', '$base64Data')";
        mysqli_query($link, $vQuery) or die(mysqli_error($link));

        $queryJefeCatedra = "SELECT usuarios.email, usuarios.nombre, usuarios.apellido, materias.nombreMat, vacantes.nombre as nombreVac FROM vacantes 
        INNER JOIN materias ON vacantes.materia = materias.id INNER JOIN usuarios ON materias.jefecatedra_id = usuarios.id 
        WHERE vacantes.id = $idVacante";
        $resultJefeCatedra = mysqli_query($link, $queryJefeCatedra);
        $rowJefeCatedra = mysqli_fetch_array($resultJefeCatedra);
        $nombre = $rowJefeCatedra['nombre'];
        $apellido = $rowJefeCatedra['apellido'];
        $mate = $rowJefeCatedra['nombreMat'];
        $vac = $rowJefeCatedra['nombreVac'];
        $destino = $rowJefeCatedra['email'];
        $asunto = "Notificacion Postulacion a Vacante";
        $mensaje = "¡Hola {$nombre} {$apellido}! Este correo es para informarle que se ha postulado un usuario a su vacante de 
                    la materia {$mate} para el puesto de {$vac}. Si desea visualizar la nueva postulacion, ingrese al sistema de 
                    gestion de vacantes.";
        $headers = "From:noreply@example.com\r\n";
        $headers .= "Reply-To:noreply@example.com\r\n";
        $headers .= "MIME-Version:1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        mail($destino, $asunto, $mensaje, $headers);
    }
    header("Location: ../../paginas/postulaciones/cliente_postulaciones.php");
}
mysqli_close($link);
