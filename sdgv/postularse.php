<?php
session_start();
include "conexion.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulacion a Vacante</title>
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
        include "./cliente_header.html";
        include "./cliente_menu.html";
        include "./breadcrumbs.php";
        if(isset($_POST['submitvacante'])){
            $idVacante = $_POST['idvacante'];
            $miNombre = $_SESSION['nombre'];
            $miApellido = $_SESSION['apellido'];
            $idUser = $_SESSION['id'];

            $vQuery = "SELECT vacantes.nombre, materias.nombreMat FROM vacantes INNER JOIN materias 
            ON materias.id = vacantes.materia WHERE vacantes.id = $idVacante";
            $vResult = mysqli_query($link, $vQuery);
            $num_rows = mysqli_num_rows($vResult);
            if($num_rows>0){
                $row = mysqli_fetch_array($vResult);
                $puesto = $row['nombre'];
                $materia = $row['nombreMat'];
                
                ?>
                <div class="row d-flex d-flex-row justify-content-center pt-2">
                <h4 class="text-start inicio p-2 m-3 justify-content-center">
                    La persona <?php echo $miNombre?> <?php echo $miApellido?>, ¿esta segura que desea postularse a 
                    la vacante de la materia <?php echo $materia?> para el puesto de <?php echo $puesto?>? <br>De ser asi, 
                    por favor cargue su CV y presione el boton "Enviar" para enviar su postulacion.
                </h4><br>
                <form action="procesar_enviar_postulacion.php" class="d-flex flex-column justify-content-center text-center inicio" method="post" enctype="multipart/form-data">
                    <input class="p-2 ms-4" type="file" accept="application/pdf" name="pdfFile" id="pdfFile" required>
                    <input type="hidden" value = "<?php echo $idVacante ?>" name ="idvac">
                    <input type="hidden" value = "<?php echo $idUser ?>" name ="iduser"><br>
                    <input type="submit" name="submitenviar" value="Enviar" class="btn btn-success exito"><br><br>
                </form>

                <?php
            }
        }
        include "./footer.html";
        ?>
    </div>
</body>
</html>