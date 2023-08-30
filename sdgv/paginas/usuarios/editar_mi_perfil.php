<?php
session_start();
require_once "../../index.php";
include BASE_PATH . "/controladora/db/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php include BASE_PATH .
            "/componentes/mapeador/mapeador_header.php"; ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-5 titulo">Editar mi perfil</h2>
                <?php
                $id = $_POST["iduser"];
                $vQuery = "SELECT id,nombre,apellido,email,pass FROM usuarios WHERE usuarios.id = '$id'";
                $vResultado = mysqli_query($link, $vQuery);
                $row = mysqli_fetch_array($vResultado);
                $num = mysqli_num_rows($vResultado);
                if ($num > 0) { ?>
                    <div class="row d-flex-row justify-content-center pt-2">
                        <form action="../../controladora/usuarios/procesar_editar_mi_perfil.php" class="d-flex flex-column justify-content-center text-center iniciosesion" method="post">
                            <input type="hidden" value="<?php echo $row["id"]; ?>" name="iduser">
                            <br>
                            <label for="">Nombre:</label>
                            <input type="text" value="<?php echo $row["nombre"]; ?>" name="nombreuser">
                            <br>
                            <label for="">Apellido:</label>
                            <input type="text" value="<?php echo $row["apellido"]; ?>" name="apellidouser">
                            <br>
                            <label for="">Email:</label>
                            <input type="text" value="<?php echo $row["email"]; ?>" name="emailuser">
                            <br>
                            <label for="">Contraseña:</label>
                            <input type="text" value="<?php echo $row["pass"]; ?>" name="passuser">
                            <br>
                            <br>
                            <input type="submit" name="submiteditar" value="Editar" class="btn btn-success"> <br> <br>
                        </form>
                    <?php }
                mysqli_free_result($vResultado);
                mysqli_close($link);
                    ?>
                    </div>
                    <?php include BASE_PATH .
                        "/componentes/footer/footer.html"; ?>
        </div>
</body>

</html>