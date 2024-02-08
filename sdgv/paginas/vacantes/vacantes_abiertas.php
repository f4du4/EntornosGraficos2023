<?php
require_once "../../index.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Vacantes Abiertas</title>
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
            <h2 class="text-center p-4 pt-5 titulo">Listado de vacantes abiertas</h2>
            <?php
            $userId = $_SESSION['id'];
            date_default_timezone_set("America/Argentina/Buenos_Aires"); //defino la zona horaria
            $dia = date("d"); //j es los dias sin el cero adelante
            $mes = date("m"); //n es los meses sin el cero adelante
            $year = date("Y");
            $hora = date("H"); //horas de 00 a 23
            $min = date("i"); //minutos de 00 a 59
            $seg = date("s"); //segundos de 00 a 59
            $hoy = date("Y-m-d H:i:s");
            include BASE_PATH . "/controladora/db/conexion.php";
            $num_pagina = 1;
            if (isset($_GET["page"])) {
                $num_pagina = $_GET["page"]; //para saber q pagina de resultados muestro
            }

            $limite = 2; //items/rows por pagina
            $inicio = ($num_pagina - 1) * $limite; //limite inicial

            $vQueryTotalRows = "SELECT COUNT(*) as total FROM vacantes WHERE '$hoy' BETWEEN vacantes.fechaIni AND vacantes.fechaFin";
            $resultadoTotal = mysqli_query($link, $vQueryTotalRows);
            $rowsTotales = mysqli_fetch_array($resultadoTotal)["total"];
            mysqli_free_result($resultadoTotal);
            $totalPaginas = ceil($rowsTotales / $limite);

            $misPostulacionesQuery = "SELECT vacantes.id from postulaciones inner join vacantes on postulaciones.vacantes_id = vacantes.id where postulaciones.usuarios_id = '$userId'";
            $vResultadoMisPostulaciones = mysqli_query($link, $misPostulacionesQuery);
            $vFechaQuery = "SELECT vacantes.fechaFin, vacantes.fechaIni, vacantes.id, vacantes.nombre,
                materias.nombreMat, vacantes.om_data FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id
                WHERE '$hoy' BETWEEN vacantes.fechaIni AND vacantes.fechaFin LIMIT $inicio, $limite";
            $vResultado = mysqli_query($link, $vFechaQuery);
            $num_rows = mysqli_num_rows($vResultado);

            $vacantesYaPostuladas = array();

            if ($vResultadoMisPostulaciones) {
                while ($row = $vResultadoMisPostulaciones->fetch_array()) {
                    $vacantesYaPostuladas[$row['id']] = true;
                }
            }

            if ($num_rows > 0 && $rowsTotales > 0) { ?>
                <br> <br>
                <table class="tablaVacantes">
                    <tr class="tituloTabla">
                        <th>Puesto</th>
                        <th>Cierre vacante</th>
                        <th>Materia</th>
                        <th>Orden de Merito</th>
                        <th>Accion</th>
                    </tr>
                    <?php while ($row = $vResultado->fetch_array()) {
                        $id = $row["id"]; ?>
                        <tr class="datosTabla">

                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["fechaFin"]; ?></td>
                            <td><?php echo $row["nombreMat"]; ?></td>
                            <?php
                            if ($row["om_data"] == null || $row["om_data"] == '') {
                            ?>
                                <td><button class="descargarpdf" style="color:red"><i class="bi bi-filetype-pdf"></i></button></td>
                            <?php
                            } else {
                            ?>
                                <td><button class="descargarpdf" onclick="descargarArchivo(<?php echo $id; ?>)"><i class="bi bi-filetype-pdf"></i></button></td>
                            <?php
                            }
                            ?>
                            <td>
                                <form action="../postulaciones/postularse.php" method="post">
                                    <input type="hidden" name="idvacante" readonly value="<?php echo $row["id"]; ?>">
                                    <?php
                                    $postulacionDeshabilitada = isset($vacantesYaPostuladas[$id]) ? 'disabled' : '';
                                    $label = $postulacionDeshabilitada != '' ? 'Postulado' : 'Postular';
                                    echo '<input type="submit" class="btn btn-success exito px-2" value="' . $label . '" name="submitvacante"' . $postulacionDeshabilitada . '>';                                    ?>
                                </form>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </table>
                <br> <br>

                <?php
                echo '<ul class="pagination justify-content-center lead">';
                if ($num_pagina > 1) {
                    echo '<li class="page-item"><a class="page-link item-paginacion" href="./vacantes_abiertas.php?page=' .
                        ($num_pagina - 1) .
                        '">Anterior</a></li>';
                }

                if ($num_pagina > 2) {
                    echo '<li class="page-item"><a class="page-link item-paginacion" href="./vacantes_abiertas.php?page=1">1</a></li>';
                    if ($num_pagina > 3) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                }

                for (
                    $i = max(1, $num_pagina - 1);
                    $i <= min($num_pagina + 2, $totalPaginas);
                    $i++
                ) {
                    $claseActiva = $i == $num_pagina ? "active" : "";
                    echo '<li class="page-item ' .
                        $claseActiva .
                        '"><a class="page-link item-paginacion" href="./vacantes_abiertas.php?page=' .
                        $i .
                        '">' .
                        $i .
                        "</a></li>";
                }

                if ($num_pagina < $totalPaginas - 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    echo '<li class="page-item"><a class="page-link item-paginacion" href="./vacantes_abiertas.php?page=' .
                        $totalPaginas .
                        '">' .
                        $totalPaginas .
                        "</a></li>";
                }

                if ($num_pagina < $totalPaginas) {
                    echo '<li class="page-item"><a class="page-link item-paginacion" href="./vacantes_abiertas.php?page=' .
                        ($num_pagina + 1) .
                        '">Siguiente</a></li>';
                }
                echo "</ul>";
            } else { ?>
                <h2>Actualmente no hay vacantes abiertas.</h2>
            <?php }
            mysqli_free_result($vResultadoMisPostulaciones);
            mysqli_free_result($vResultado);
            mysqli_close($link);
            ?>
        </div>

        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>
<script>
    function descargarArchivo(id) {

        const apiUrl = `../../controladora/vacantes/orden_merito/descargar_orden_pdf.php?id=${id}`;

        fetch(apiUrl)
            .then(response => {
                return response.json();
            })
            .then(data => {
                const pdfData = atob(data.pdfData);

                const blob = new Blob([new Uint8Array([...pdfData].map(char => char.charCodeAt(0)))], {
                    type: 'application/pdf'
                });

                const blobUrl = URL.createObjectURL(blob);

                const downloadLink = document.createElement('a');
                downloadLink.href = blobUrl;
                downloadLink.download = 'orden_merito.pdf';
                downloadLink.click();
                URL.revokeObjectURL(blobUrl);
            })
            .catch(error => console.error('Error fetching PDF:', error));
    }
</script>

</html>