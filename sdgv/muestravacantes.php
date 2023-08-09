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
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
    <div class="container-fluid d-flex-row m-0">
        <?php
            include "./header.html";
            include "./menu.html";
            include "./breadcrumbs.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Listado de vacantes abiertas</h2>
            <?php 
                date_default_timezone_set("America/Argentina/Buenos_Aires"); //defino la zona horaria
                $dia = date("d"); //j es los dias sin el cero adelante
                $mes = date("m"); //n es los meses sin el cero adelante
                $year = date("Y");
                $hora = date("H"); //horas de 00 a 23
                $min = date("i"); //minutos de 00 a 59
                $seg = date("s"); //segundos de 00 a 59
                $hoy = date("Y-m-d H:i:s");
                include "conexion.php";  
                $vFechaQuery = "SELECT vacantes.fechaFin, vacantes.fechaIni, vacantes.id, vacantes.nombre,
                materias.nombreMat, vacantes.om_data FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id
                 WHERE '$hoy' BETWEEN vacantes.fechaIni AND vacantes.fechaFin"; 
                $vResultado = mysqli_query($link, $vFechaQuery);
                $num_rows = mysqli_num_rows($vResultado);
                if($num_rows > 0){
                    ?>
                    <br><br>
                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <!--<th>ID</th>-->
                            <th>Puesto</th>
                            <th>Cierre vacante</th>
                            <th>Materia</th>
                            <th>Orden de Merito</th>
                        </tr>
                        <?php
                        while($row = $vResultado->fetch_array()){
                            $id = $row['id'];
                            $url = "descargar_orden_pdf.php?id=" . urlencode($id);
                           // $puesto = $row['nombre'];
                            //$fechaCierre = $row['fechaFin'];
                            //$materia = $row['nombreMat'];
                        ?>
                        <tr class="datosTabla">
                            
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['fechaFin'] ?></td>
                            <td><?php echo $row['nombreMat'] ?></td>
                            <td><button class="descargarpdf" onclick="descargarArchivo()"><i class="bi bi-filetype-pdf"></i></button></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <br><br>
                     <?php
                  
                }else{
                    ?>
                    <h2>Actualmente no hay vacantes abiertas.</h2>
                    <?php
                }
            
            ?>
        </div>

        <?php
        include "./footer.html";
        ?>
    </div>
</body>
<script>
      function descargarArchivo() {

        // API endpoint to fetch the PDF data
        const id = '<?php echo $id ?>';
        console.log(id);
        const apiUrl = `descargar_orden_pdf.php?id=${id}`;
  
        // Fetch the PDF data using the API
        fetch(apiUrl)
          .then(response => {
            return response.json();
          })
          .then(data => {
            // Decode the Base64 data to a binary PDF
            const pdfData = atob(data.pdfData);
  
            // Create a Blob object from the binary PDF data
            const blob = new Blob([new Uint8Array([...pdfData].map(char => char.charCodeAt(0)))], { type: 'application/pdf' });
  
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