<?php
require_once "../../index.php";
session_start();
include BASE_PATH . "/controladora/db/conexion.php";
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
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php include BASE_PATH .
            "/componentes/mapeador/mapeador_header.php"; ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Gestion de Postulaciones</h2>

            <?php
            $vQueryMaterias = "SELECT id, nombreMat FROM materias";
            $vResultMaterias = mysqli_query($link, $vQueryMaterias);
            ?>

            <div class="row d-flex justify-content-center p-5 pt-3">
                <form action="" method="GET" class="form-inline">
                    <label for="filtro-materia" class="mr-2">Filtrar por Materia:</label>
                    <select name="filtro-materia" id="filtro-materia" class="form-control mr-2">
                        <?php while ($rowMat = mysqli_fetch_array($vResultMaterias)) { ?>
                            <option value="<?php echo $rowMat["id"]; ?>">
                                <?php echo $rowMat["nombreMat"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </form>
            </div>

            <?php
            // Obtener el valor del filtro desde la URL (si fue enviado)
            $filtroMateria = isset($_GET['filtro-materia']) ? $_GET['filtro-materia'] : '';

            // Modificar la consulta SQL para incluir la condición del filtro
            $vQuery = "SELECT postulaciones.id, postulaciones.estado, materias.nombreMat, usuarios.email, 
                                    postulaciones.usuarios_id, postulaciones.vacantes_id 
                                    FROM postulaciones 
                                    INNER JOIN vacantes ON vacantes.id = postulaciones.vacantes_id
                                    INNER JOIN materias ON materias.id = vacantes.materia 
                                    INNER JOIN usuarios ON usuarios.id = postulaciones.usuarios_id";

            if (!empty($filtroMateria)) {
                $vQuery .= " WHERE materias.id = '$filtroMateria'";
            }

            $vResultado = mysqli_query($link, $vQuery);
            $num_rows = mysqli_num_rows($vResultado);
            if ($num_rows > 0) { ?>
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
                    while ($row = $vResultado->fetch_array()) { ?>
                        <tr class="datosTabla">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["estado"]; ?></td>
                            <td><?php echo $row["nombreMat"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td>
                                <form action="../vacantes/obtener_vacante.php" method="post">
                                    <input type="hidden" name="idvac" readonly value="<?php echo $row["vacantes_id"]; ?>">
                                    <input type="hidden" name="idpostu" readonly value="<?php echo $row["id"]; ?>">
                                    <input type="submit" class="btn btn-primary" value="Vacante" name="submitvacante">
                                </form>
                            </td>
                            <td>
                                <form action="../usuarios/obtener_usuario.php" method="post">
                                    <input type="hidden" name="idusu" readonly value="<?php echo $row["usuarios_id"]; ?>">
                                    <input type="hidden" name="idpostu" readonly value="<?php echo $row["id"]; ?>">
                                    <input type="submit" class="btn btn-primary" value="Usuario" name="submitusuario">
                                </form>
                            </td>

                        </tr>
                    <?php } ?>
                </table>
            <?php
            } else {
                echo '<h2 class="text-center justify-content-center p-4 pt-5 titulo">No hay postulaciones para el filtro elegido</h2>';
            } ?>

        </div>

        <?php
        mysqli_close($link);
        mysqli_free_result($vResultado);
        include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>