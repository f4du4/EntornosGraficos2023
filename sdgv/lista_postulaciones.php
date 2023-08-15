<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Postulaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php
        include "./admin_header.html";
        include "./admin_menu.html";
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-5 titulo">Gestion de Postulaciones</h2>

                <table class="tablaVacantes">
                    <tr class="tituloTabla">
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Vacante</th>
                        <th>Usuario</th>
                        <th>Ver Vacante</th>
                        <th>Ver Usuario</th>
                    </tr>
                    <?php
                    $vQuery = "SELECT postulaciones.id, postulaciones.estado, materias.nombreMat, usuarios.email, 
                    postulaciones.usuarios_id, postulaciones.vacantes_id FROM postulaciones INNER JOIN vacantes ON vacantes.id = postulaciones.vacantes_id
                    INNER JOIN materias ON materias.id = vacantes.materia INNER JOIN usuarios ON usuarios.id = postulaciones.usuarios_id";
                    $vResultado = mysqli_query($link, $vQuery);
                    while ($row = $vResultado->fetch_array()) {
                    ?>
                        <tr class="datosTabla">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['estado'] ?></td>
                            <td><?php echo $row['nombreMat'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td>
                                <form action="obtener_vacante.php" method="post">
                                    <input type="hidden" name="idvac" readonly value="<?php echo $row['vacantes_id'] ?>">
                                    <input type="hidden" name="idpostu" readonly value="<?php echo $row['id'] ?>">
                                    <input type="submit" class="btn btn-primary" value="Vacante" name="submitvacante">
                                </form>
                            </td>
                            <td>
                                <form action="obtener_usuario.php" method="post">
                                    <input type="hidden" name="idusu" readonly value="<?php echo $row['usuarios_id'] ?>">
                                    <input type="hidden" name="idpostu" readonly value="<?php echo $row['id'] ?>">
                                    <input type="submit" class="btn btn-primary" value="Usuario" name="submitusuario">
                                </form>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
        </div>

        <?php
        include "./footer.html";
        ?>
    </div>
</body>

</html>