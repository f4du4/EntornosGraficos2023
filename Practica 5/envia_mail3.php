<?php
$htmlContent = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<p style="background-color: bisque;">Hey! Chequea este sitio web <a href="https://probandoenviarmail.000webhostapp.com/ejercicio3_pract5.html">Click Aqui!</a></p>
</body>
</html>';
    if(!empty($_POST['nombre']) && !empty($_POST['email1']) && !empty($_POST['email2'])){
        $nombre = $_POST['nombre'];
        $asunto = "Recomendacion Sitio Web";
        $desde = $_POST['email1'];
        $destino = $_POST['email2'];
        $headers = "From:noreply@example.com\r\n";
        $headers = "Reply-To:noreply@example.com\r\n";
        $headers = "MIME-Version:1.0\r\n";
        $headers = "Content-type: text/html; charset=iso-8859-1\r\n";
        
        if(mail($destino, $asunto, $htmlContent, $headers)){ 
            echo 'Email has sent successfully.'; 
        }else{ 
           echo 'Email sending failed.'; 
        }

    }
?>