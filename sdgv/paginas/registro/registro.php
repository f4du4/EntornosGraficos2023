<?php
require_once "../../index.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            console.log({
                target
            })
            var regEx = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;
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
            <h2 class="text-center p-4 pt-3 titulo">Registro</h2>
            <p class="text-center descripcion">¿Ya estas registrado? <a href="../ingreso/ingreso.php">Iniciar Sesion</a></p>
            <p class="text-center descripcion">Completa los siguientes datos para registrarte</p>
            <form method="POST" class="d-flex flex-column iniciosesion">
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Nombre:</label>
                    <div class="containerError">
                        <input class="px-3" type="text" name="Nom" placeholder="Ingrese su nombre..." required onchange="validaSoloLetras(this)" autocomplete="one-time-code" />
                        <div class="error hidden">Nombre invalido: solo ingresar letras</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Apellido:</label>
                    <div class="containerError">
                        <input class="px-3" type="text" name="Ape" placeholder="Ingrese su apellido..." required onchange="validaSoloLetras(this)" autocomplete="one-time-code" />
                        <div class="error hidden">Apellido invalido: solo ingresar letras</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Email:</label>
                    <input class="px-3" type="email" name="Mail" placeholder="Ingrese su email..." required autocomplete="one-time-code" />
                </div>
                <div class="d-flex justify-content-between formdiv m-2 position-relative">
                    <label class="formlabel" for="">Contraseña:</label>
                    <input id="password-input" class="px-3" type="password" name="Contra" placeholder="Ingrese su contraseña..." required autocomplete="one-time-code">
                    <i id="password-icon" onclick="cambiarVisibilidad()" class="bi bi-eye-slash position-absolute end-0"></i>
                </div>
                <button type="submit" name="submitregistro" class="mt-3 mb-3 p-2 click boton">REGISTRARSE</button>
            </form>

            <?php if (isset($_POST["submitregistro"])) {
                include BASE_PATH . "/controladora/db/conexion.php";
                //Captura datos desde el Form anterior
                $vNom = $_POST["Nom"];
                $vApe = $_POST["Ape"];
                $vMail = $_POST["Mail"];
                $vContra = $_POST["Contra"];
                $expresionReg = "/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/";

                //Arma la instrucción SQL y luego la ejecuta
                $vRolQuery = "SELECT id FROM roles WHERE descripcion = 'cliente'";
                // como estoy contando deberia ser 0 para dejar q se regitre.
                $vEncontrarEmail = "SELECT email FROM usuarios WHERE email = '$vMail'";
                ($vEmailEncontrado = mysqli_query($link, $vEncontrarEmail)) or
                    die(mysqli_error($link));
                $num_row = mysqli_num_rows($vEmailEncontrado);

                // mostrar mensaje que ya existe el usuario.
                if ($num_row > 0) { ?>
                    <h2 class="errorBackend">El Usuario ya existe</h2>
                    <?php } else {
                    if (
                        preg_match($expresionReg, $vNom) == 0 ||
                        preg_match($expresionReg, $vApe) == 0
                    ) { ?>
                        <h2 class="errorBackend">El nombre y/o el apellido son invalidos: solo letras</h2>
            <?php } else { // vRolResult es un objecto que devuelve msqli_query y necesito convertirlo a array para leerlo. (lo puedo recorrer si hay mas de un resultado).
                        ($vRolResult = mysqli_query($link, $vRolQuery)) or
                            die(mysqli_error($link));
                        if ($vRolResult) {
                            // leo la variable porque no puedo usar vRolResult directamente. Asi q se guarda en row (es un array por eso acceso a 0)
                            if ($row = mysqli_fetch_array($vRolResult)) {
                                // creo otra query para insertar el usuario en la bd y le paso tmb el rolId q busque previamente.
                                $addUserQuery = "INSERT INTO usuarios(nombre, apellido, email, pass, rol_id) values('$vNom','$vApe', '$vMail', '$vContra', $row[0])";
                                mysqli_query($link, $addUserQuery) or
                                    die(mysqli_error($link));
                                echo "<script>location.href='/paginas/registro/aprobacion_registro.php';</script>";
                            }
                        }
                    }
                }

                mysqli_free_result($vEmailEncontrado);
                mysqli_close($link);
            } ?>
        </div>
        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>