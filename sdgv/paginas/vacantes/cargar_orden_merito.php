<?php
require_once "../../index.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Orden de Merito</title>
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
        <?php
        include BASE_PATH . "/componentes/mapeador/mapeador_header.php";
        $idJefeCatedra = $_SESSION["id"];
        include BASE_PATH . "/controladora/db/conexion.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-3 titulo">Cargar Orden de Merito</h2>
            <?php
            $vQuery = "SELECT materias.nombreMat, vacantes.nombre, vacantes.id FROM materias INNER JOIN vacantes ON vacantes.materia = materias.id WHERE materias.jefecatedra_id = $idJefeCatedra AND vacantes.om_data is NULL";
            $vResultado = mysqli_query($link, $vQuery);
            $num_rows = mysqli_num_rows($vResultado);
            if ($num_rows > 0) { ?>
                <h3 class="text-center p-4 descripcion">A continuacion se le
                    presentan aquellas vacantes las cuales aun no ha cargado
                    la orden de merito en formato "pdf".</h3><br>
                <table class="tablaVacantes">
                    <tr class="tituloTabla">
                        <th>Puesto</th>
                        <th>Materia</th>
                        <th>Accion</th>
                    </tr>
                    <?php while ($row = $vResultado->fetch_array()) { ?>
                        <tr class="datosTabla">
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["nombreMat"]; ?></td>
                            <td>
                                <form action="../../controladora/vacantes/orden_merito/procesar_cargar_ordenmerito.php" class="d-flex flex-column justify-content-center text-center" method="post" enctype="multipart/form-data">
                                    <input class="p-2" type="file" accept="application/pdf" name="pdfFile" id="pdfFile" required>
                                    <input type="hidden" value="<?php echo $row["id"]; ?>" name="idvac"><br>
                                    <input type="submit" name="submitcargar" value="Cargar" class="boton">
                                </form>
                            </td>

                        </tr>
                    <?php }
                } else { ?> <h2 class="text-center correctoBackend">¡Enhorabuena! No tienes cargas pendientes.</h2>
                <?php }
                mysqli_free_result($vResultado);
                mysqli_close($link);
                ?>
                </table>
        </div>

        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>