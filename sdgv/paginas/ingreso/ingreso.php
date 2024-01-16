<?php
require_once "../../index.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/estilos.css">
    <script>
        function cambiarVisibilidad() {
            const el = document.getElementById("password-icon");
            const passwordEl = document.getElementById("password-input");
            if (el.classList.contains('bi-eye-slash')) {
                el.classList.remove('bi-eye-slash');
                el.classList.add('bi-eye');
                passwordEl.type = 'text';
            } else {
                el.classList.remove('bi-eye');
                el.classList.add('bi-eye-slash');
                passwordEl.type = 'password';
            }
        }

        function validaSoloLetras(target) {
            var regEx = /^[A-Za-z]+$/;
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

        <?php include BASE_PATH .
            "/componentes/mapeador/mapeador_header.php"; ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-3 titulo">Ingreso</h2>
            <p class="text-center descripcion">Registrese para continuar <a href="../registro/registro.php">SignUp</a></p>
            <form action="../../controladora/ingreso/valida_form_ingreso.php" method="POST" class="d-flex flex-column iniciosesion">
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Email:</label>
                    <input class="px-3" type="email" name="Mail" placeholder="Ingrese su email..." required autocomplete="off" />
                </div>
                <div class="d-flex justify-content-between formdiv m-2 position-relative">
                    <label class="formlabel" for="">Contraseña:</label>
                    <input id="password-input" class="px-3" type="password" name="Contra" placeholder="Ingrese su contraseña..." required autocomplete="off">
                    <i id="password-icon" onclick="cambiarVisibilidad()" class="bi bi-eye-slash position-absolute end-0"></i>
                </div>
                <button type="submit" name="submitingreso" class="mt-4 mb-5 p-2 click boton">INGRESAR</button>
            </form>

        </div>
        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>