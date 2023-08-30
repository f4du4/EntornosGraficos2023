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
    <title>Gestion de Vacantes</title>
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
            <h1 class="text-center p-4 pt-5 titulo">Gestion de Vacantes</h2>
                <div class="row d-flex d-flex-row justify-content-center">
                    <h3 class="text-center pb-1 pt-3 titulo">Buscador de Vacantes</h3>
                    <form class="text-center justify-content-center p-4 buscador" method="post">
                        <input class="busqueda me-2 px-3" name="materia" type="text" placeholder="  Ingrese su busqueda...">
                        <button type="submit" name="submit" class="mt-4 mb-5 p-2 click botonBusqueda">BUSCAR</button>
                    </form>
                    <?php if (isset($_POST["submit"])) {
                        $vMateria = $_POST["materia"];
                        $vMateriaQuery = "SELECT vacantes.id, vacantes.nombre, vacantes.fechaFin, materias.nombreMat FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id 
                WHERE materias.nombreMat LIKE '%$vMateria%'";
                        $vResultado = mysqli_query($link, $vMateriaQuery);
                        $num_rows = mysqli_num_rows($vResultado);
                        if ($num_rows > 0) { ?>
                            <br>
                            <br>
                            <table class="tablaVacantes">
                                <tr class="tituloTabla">
                                    <th>ID</th>
                                    <th>Puesto</th>
                                    <th>Fecha y Hora de Cierre</th>
                                    <th>Materia</th>
                                </tr>
                                <?php while (
                                    $row = $vResultado->fetch_array()
                                ) {

                                    $id = $row["id"];
                                    $puesto = $row["nombre"];
                                    $fechaCierre = $row["fechaFin"];
                                    $materia = $row["nombreMat"];
                                ?>
                                    <tr class="datosTabla">
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $puesto; ?></td>
                                        <td><?php echo $fechaCierre; ?></td>
                                        <td><?php echo $materia; ?></td>
                                    </tr>
                                <?php
                                } ?>
                            </table>
                            <br> <br>
                        <?php } else { ?>
                            <h2 class="p-3 text-center justify-content-center">La materia ingresada no existe o bien no hay vacantes disponibles</h2><br>
                    <?php }
                    }
                    ?>
                </div>
                <table class="tablaVacantes">
                    <tr class="tituloTabla">
                        <th>ID</th>
                        <th>Puesto</th>
                        <th>Fecha y Hora de Cierre</th>
                        <th>Materia</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>

                    <?php
                    $vQuery =
                        "SELECT vacantes.id, vacantes.nombre, vacantes.fechaFin, materias.nombreMat FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id";
                    $vResultado = mysqli_query($link, $vQuery);
                    while ($row = $vResultado->fetch_array()) { ?>
                        <tr class="datosTabla">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["fechaFin"]; ?></td>
                            <td><?php echo $row["nombreMat"]; ?></td>
                            <td>
                                <form action="./editar_vacante.php" method="post">
                                    <input type="hidden" name="idvac" readonly value="<?php echo $row["id"]; ?>">
                                    <input type="submit" class="btn btn-success exito" value="Editar" name="submiteditar">
                                </form>
                            </td>
                            <td>
                                <form action="../../controladora/vacantes/eliminar_vacante.php" method="post">
                                    <input type="hidden" name="idvac" readonly value="<?php echo $row["id"]; ?>">
                                    <input type="submit" class="btn btn-danger exito" value="Eliminar" name="submiteliminar">
                                </form>
                            </td>

                        </tr>
                    <?php }
                    mysqli_close($link);
                    mysqli_free_result($vResultado);
                    ?>
                </table>
        </div>
        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>