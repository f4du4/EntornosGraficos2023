<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quienes Somos?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos.css">
    <script>
        function validaSoloLetras(target) {
            console.log({
                target
            })
            var regEx = /^[A-Z a-z]+$/;
            if (target.value.match(regEx)) {
                if (!!target.nextElementSibling) {
                    target.nextElementSibling.classList.add("hidden");
                    target.nextElementSibling.classList.remove("shown");
                }
                return true;
            } else {
                if (!!target.nextElementSibling) {
                    target.nextElementSibling.classList.remove("hidden");
                    target.nextElementSibling.classList.add("shown");
                }
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php

        if ($_SESSION['email'] != null && $_SESSION['email'] != '') {
            if ($_SESSION['rol_id'] == 1) {
                include "./cliente_header.html";
                include "./cliente_menu.html";
            } else if ($_SESSION['rol_id'] == 2) {
                include "./jefecatedra_header.html";
                include "./jefecatedra_menu.html";
            } else if ($_SESSION['rol_id'] == 3) {
                include "./admin_header.html";
                include "./admin_menu.html";
            } else if ($_SESSION['rol_id'] == 4) {
                include "./admin_header.html";
                include "./admin_menu.html";
            }
        } else {
            include "./header.html";
            include "./menu.html";
        }
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h1 class="text-start inicio p-2 m-3">Sobre Nosotros</h1>
            <p class="text-start inicio p-2  m-3">Si deseas contactarte con nosotros para comentarnos alguna duda, recomendacion,
                u oportunidad de mejora, por favor rellena y envia el formulario, y te contactaremos.
            </p>
            <form method="POST" class="d-flex flex-column iniciosesion">
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Email:</label>
                    <input class="px-3" type="email" name="mail" placeholder="Ej: analisap01@gmail.com" required />
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Nombre completo:</label>
                    <div class="containerError">
                        <input class="px-3" type="text" name="nombre" placeholder="Ej: Ana Lisa Perez" required onchange="validaSoloLetras(this)" />
                        <div class="error hidden">Nombre invalido: solo ingresar letras</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Comentario:</label>
                    <input class="px-3" type="text" name="comentario" placeholder="Ingrese su comentario..." required />
                </div>

                <button type="submit" name="submitFormulario" class="mt-3 mb-3 p-2 click boton">ENVIAR</button>
            </form>
        </div>
        <?php
        if (isset($_POST['submitFormulario'])) {
        ?><h3 class="correctoBackend">¡Comentario enviado exitosamente!</h3>
        <?php
            $nombre = $_POST['nombre'];
            $email = $_POST['mail'];
            $comentario = $_POST['comentario'];
            $destino = "faduadora77@gmail.com";
            $asunto = "Consulta Sistema Gestion Vacantes";
            $mensaje = "Consulta de: {$nombre}, email: {$email}, Consulta: {$comentario}.";
            $headers = "From:noreply@example.com\r\n";
            $headers .= "Reply-To:noreply@example.com\r\n";
            $headers .= "MIME-Version:1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            mail($destino, $asunto, $mensaje, $headers);
        }

        ?>
        <h3 class="text-start inicio p-2  m-3">UTN FRRo</h3>
        <p class="quienessomos p-2  m-5">La Facultad Regional Rosario o FRRo es una de las facultades pertenecientes
            a la Universidad Tecnológica Nacional o UTN de la República Argentina. Dicha regional se sitúa actualmente
            en la calle Zeballos 1341 de la ciudad de Rosario, en la Provincia de Santa Fe y consta de 5 carreras de
            grado: Ingeniería Mecánica, Ingeniería Civil, Ingeniería en Sistemas de Información, Ingeniería Eléctrica e Ingeniería
            Química y varias carreras de posgrado. <br> <br> El actual edificio se comenzó a construir en el año 1965 en la gestión del primer Decano electo, el Ing. Eduardo Arbones.
            En el año 1969 se inauguró el anexo y al año siguiente la planta baja y el primer piso del edificio central, habiéndose llegado en la actualidad a un nivel de cuatro pisos y el ala sur del quinto.
            Para 2012 se compró en la cuadra de enfrente, 10 metros en diagonal, dos ex edificios (un comercio y otro desconocido) el cual sirven para posgrado y otro anexo más, donde se dictan cátedras diversas.
        </p>
    </div>
    <?php
    include "./footer.html";
    ?>
    </div>
</body>

</html>