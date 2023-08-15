<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Obtener Usuario</title>
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
    $id = $_POST['idpostu'];
    ?>
    <div class="row d-flex d-flex-row justify-content-center pt-2">
      <h2 class="text-center p-4 pt-5 titulo">Usuario asociado a la postulacion <?php echo $id ?></h2>
      <?php
      $idusuario = $_POST['idusu'];
      $vQuery = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.email,
            usuarios.pass, roles.descripcion AS rol FROM usuarios INNER JOIN roles ON roles.id = usuarios.rol_id
            WHERE usuarios.id = '$idusuario'";
      $vResultado = mysqli_query($link, $vQuery);
      $row = mysqli_fetch_array($vResultado);
      $num = mysqli_num_rows($vResultado);
      if ($num > 0) {
      ?>
        <div class="row d-flex-row justify-content-center pt-2">

          <table class="tablaVacantes">
            <tr class="tituloTabla">
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
              <th>Rol</th>
              <th>CV</th>
            </tr>
            <tr class="datosTabla">
              <td><?php echo $row['id'] ?></td>
              <td><?php echo $row['nombre'] ?></td>
              <td><?php echo $row['apellido'] ?></td>
              <td><?php echo $row['email'] ?></td>
              <td><?php echo $row['rol'] ?></td>
              <td><button class="descargarpdf" onclick="descargarArchivo()"><i class="bi bi-filetype-pdf"></i></button></td>
            </tr>
          </table>
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
    const id = '<?php echo $id ?>'; //ID DE LA POSTULACION
    console.log(id);
    const apiUrl = `descargar_pdf.php?id=${id}`;

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