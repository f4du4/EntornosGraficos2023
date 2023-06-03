<?php
    if(!empty($_POST['nombre']) && !empty($_POST['asunto']) && !empty($_POST['mensaje']) && !empty($_POST['email'])){
        $nombre = $_POST['nombre'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        $destino = $_POST['email'];
        $headers = "From:noreply@example.com\r\n";
        $headers = "Reply-To:noreply@example.com\r\n";
        $headers = "MIME-Version:1.0\r\n";
        $headers = "Content-type: text/html; charset=iso-8859-1\r\n";
        
        mail($destino, $asunto, $mensaje, $headers);

        echo "<h1>Mail enviado exitosamente</h1>";

    }
?>