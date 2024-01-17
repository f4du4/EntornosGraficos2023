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
    <title>Obtener Vacante</title>
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
        $id = $_POST["idpostu"];
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Vacante asociada a la postulacion <?php echo $id; ?></h2>
            <?php
            $idVacante = $_POST["idvac"];
            $vQuery = "SELECT vacantes.id, vacantes.nombre, vacantes.descripcion, vacantes.fechaIni, vacantes.fechaFin, vacantes.om_data, materias.nombreMat, vacantes.om_data
            FROM vacantes INNER JOIN materias ON materias.id = vacantes.materia WHERE vacantes.id = '$idVacante'";
            $vResultado = mysqli_query($link, $vQuery);
            $row = mysqli_fetch_array($vResultado);

            $num = mysqli_num_rows($vResultado);
            if ($num > 0) { ?>
                <div class="row d-flex-row justify-content-center pt-2">

                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <th>ID</th>
                            <th>Puesto</th>
                            <th>Descripcion</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Cierre</th>
                            <th>Materia</th>
                            <th>Orden de Merito</th>
                        </tr>
                        <tr class="datosTabla">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["descripcion"]; ?></td>
                            <td><?php echo $row["fechaIni"]; ?></td>
                            <td><?php echo $row["fechaFin"]; ?></td>
                            <td><?php echo $row["nombreMat"]; ?></td>
                            <?php
                            if ($row["om_data"] == null || $row["om_data"] == '') {
                            ?>
                                <td><button class="descargarpdf" style="color:red"><i class="bi bi-filetype-pdf"></i></button></td>
                            <?php
                            } else {
                            ?>
                                <td><button class="descargarpdf" onclick="descargarArchivo()"><i class="bi bi-filetype-pdf"></i></button></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </table>
                <?php }
            mysqli_free_result($vResultado);
            mysqli_close($link);
                ?>

                </div>

                <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
        </div>
</body>
<script>
    function descargarArchivo() {

        // API endpoint to fetch the PDF data
        const id = '<?php echo $id; ?>';
        const apiUrl = `/controladora/vacantes/orden_merito/descargar_orden_pdf.php?id=${id}`;

        // Fetch the PDF data using the API
        fetch(apiUrl)
            .then(response => {
                return response.json();
            })
            .then(data => {
                // Decode the Base64 data to a binary PDF
                const pdfData = atob(data.pdfData);

                // Create a Blob object from the binary PDF data
                const blob = new Blob([new Uint8Array([...pdfData].map(char => char.charCodeAt(0)))], {
                    type: 'application/pdf'
                });

                // Create a temporary URL for the Blob
                const blobUrl = URL.createObjectURL(blob);

                // Create a link to download the PDF
                const downloadLink = document.createElement('a');
                downloadLink.href = blobUrl;
                downloadLink.download = 'orden_merito.pdf'; // Specify the desired file name for download
                downloadLink.click();
                // Clean up by revoking the Blob URL
                URL.revokeObjectURL(blobUrl);
            })
            .catch(error => console.error('Error fetching PDF:', error));
    }
</script>


</html>