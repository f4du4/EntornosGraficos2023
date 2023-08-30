<?php
require_once "../../index.php";
include BASE_PATH . "/controladora/db/conexion.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <?php
    include BASE_PATH . "/componentes/mapeador/mapeador_header.php";

    $idUser = $_SESSION["id"];
    $vQuery = "SELECT id,nombre,apellido,email,pass FROM usuarios WHERE usuarios.id = '$idUser'";
    $vResultado = mysqli_query($link, $vQuery);
    $row = mysqli_fetch_array($vResultado);
    mysqli_free_result($vResultado);
    ?>
    <div class="row d-flex d-flex-row justify-content-center pt-2">
        <h2 class="text-center p-4 pt-3 titulo">Mi Perfil</h2>
        <table class="tablaVacantes">
            <tr class="tituloTabla">
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Editar</th>
            </tr>
            <tr class="datosTabla">
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nombre"]; ?></td>
                <td><?php echo $row["apellido"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["pass"]; ?></td>
                <td><?php echo $rol; ?></td>
                <td>
                    <form action="./editar_mi_perfil.php" method="post">
                        <input type="hidden" name="iduser" readonly value="<?php echo $row["id"]; ?>">
                        <input type="submit" class="btn btn-success exito" value="Editar" name="submit_miperfil">
                    </form>
                </td>
            </tr>
        </table>
        <?php
        mysqli_close($link);
        include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>