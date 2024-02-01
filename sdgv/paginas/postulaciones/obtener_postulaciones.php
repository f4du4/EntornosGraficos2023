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
    <title>Obtener Postulaciones</title>
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

        $idMateria = $_GET["id"];
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <?php
            $vQuery = "SELECT vacantes.nombre, vacantes.fechaFin, vacantes.id as vacanteId, postulaciones.usuarios_id, materias.nombreMat FROM vacantes INNER JOIN postulaciones ON 
            vacantes.id = postulaciones.vacantes_id INNER JOIN materias ON vacantes.materia = materias.id WHERE vacantes.materia = '$idMateria' AND postulaciones.estado = 'En espera'";
            $vResultado = mysqli_query($link, $vQuery);
            $row = mysqli_fetch_array($vResultado);
            $num = mysqli_num_rows($vResultado);

            if ($num > 0) {
                $nombre_materia = $row["nombreMat"];
            ?>
                <h2 class="text-center p-4 pt-3 titulo">Postulaciones asociadas a la materia <?php echo $nombre_materia; ?></h2>
                <?php
                $idVac = $row["vacanteId"];
                $vQueryUser = "SELECT usuarios.email, usuarios.id, usuarios.nombre AS nombreUser, usuarios.apellido AS apellidoUser, postulaciones.estado, postulaciones.puntaje, postulaciones.cv_data, postulaciones.id as postuId 
                FROM usuarios INNER JOIN postulaciones ON postulaciones.usuarios_id = usuarios.id WHERE 
                postulaciones.vacantes_id = $idVac";
                $vResultUser = mysqli_query($link, $vQueryUser);
                $num_user = mysqli_num_rows($vResultUser);
                if ($num_user > 0) { ?>
                    <div class="row d-flex-row justify-content-center pt-2">

                        <table class="tablaVacantes">
                            <tr class="tituloTabla">
                                <th>Puesto</th>
                                <th>Postulante</th>
                                <th>CV</th>
                                <th>Puntaje</th>
                                <th>Notificar Ganador</th>
                            </tr>
                            <?php while ($user = mysqli_fetch_assoc($vResultUser)) {
                                $id = $user["postuId"] ?>
                                <tr class="datosTabla">
                                    <td><?php echo $row["nombre"]; ?></td>
                                    <td><?php echo $user["email"]; ?></td>
                                    <?php
                                    if ($user["cv_data"] == null || $user["cv_data"] == '') {
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
                                        <?php if (
                                            $user["puntaje"] != "0" &&
                                            $user["puntaje"] != null
                                        ) {
                                            echo $user["puntaje"];
                                        } else {
                                        ?>
                                            <form action="./carga_puntaje_postu.php" method="post">
                                                <input type="hidden" name="idMateria" readonly value="<?php echo $idMateria; ?>">
                                                <input type="hidden" name="idPostu" readonly value="<?php echo $user["postuId"]; ?>">
                                                <input type="submit" name="submitPostu" value="Cargar" class="btn btn-success exito">
                                            </form>
                                        <?php
                                        } ?>
                                    </td>
                                    <td>
                                        <form action="./enviar_mail_postu.php" method="post">
                                            <input type="hidden" name="idPostu" readonly value="<?php echo $id; ?>">
                                            <input type="hidden" name="idVac" readonly value="<?php echo $row["vacanteId"]; ?>">
                                            <input type="hidden" name="emailUser" readonly value="<?php echo $user["email"]; ?>">
                                            <input type="hidden" name="idUser" readonly value="<?php echo $user["id"]; ?>">
                                            <input type="hidden" name="materia" readonly value="<?php echo $row["nombreMat"]; ?>">
                                            <input type="hidden" name="puesto" readonly value="<?php echo $row["nombre"]; ?>">
                                            <input type="hidden" name="nombreUser" readonly value="<?php echo $user["nombreUser"]; ?>">
                                            <input type="hidden" name="apellidoUser" readonly value="<?php echo $user["apellidoUser"]; ?>">
                                            <button class="descargarpdf" name="submitEmail"><i class="bi bi-envelope-at"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php
                    mysqli_free_result($vResultUser);
                } else { ?><h3>No hay postulantes aun</h3><?php }
                                                    } else {
                                                            ?>
                    <h3>No hay vacantes abiertas de esta materia</h3>
                <?php
                                                    }
                ?>

                    </div>

                    <?php
                    mysqli_free_result($vResultado);
                    mysqli_close($link);
                    include BASE_PATH .
                        "/componentes/footer/footer.html"; ?>
        </div>
</body>
<script>
    function descargarArchivo(id) {

        // API endpoint to fetch the PDF data
        const id = '<?php echo $id; ?>';
        console.log(id);
        const apiUrl = `/controladora/postulaciones/descargar_pdf.php?id=${id}`;

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
                downloadLink.download = 'cv.pdf'; // Specify the desired file name for download
                downloadLink.click();
                // Clean up by revoking the Blob URL
                URL.revokeObjectURL(blobUrl);
            })
            .catch(error => console.error('Error fetching PDF:', error));
    }
</script>

</html>