<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vacante</title>
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
            <h1 class="text-center p-4 pt-5 titulo">Modificacion de la Vacante</h2>
                <?php
                $id = $_POST['idvac'];
                $vQuery = "SELECT vacantes.id, vacantes.nombre, vacantes.descripcion, vacantes.fechaIni, vacantes.fechaFin, materias.nombreMat, vacantes.materia
            FROM vacantes INNER JOIN materias ON materias.id = vacantes.materia WHERE vacantes.id = '$id'";
                $MateriasQuery = "SELECT materias.id, materias.nombreMat FROM materias";
                $vResultado = mysqli_query($link, $vQuery);
                $vResMat = mysqli_query($link, $MateriasQuery);
                $row = mysqli_fetch_array($vResultado);

                $num = mysqli_num_rows($vResultado);
                $numMat = mysqli_num_rows($vResMat);
                if ($num > 0 && $numMat > 0) {
                ?>
                    <div class="row d-flex-row justify-content-center pt-2">
                        <form action="procesar_editar_vacante.php" class="d-flex flex-column justify-content-center text-center iniciosesion" method="post">
                            <input type="hidden" value="<?php echo $row['id'] ?>" name="idvacante">
                            <br>
                            <label for="">Puesto:</label>
                            <input type="text" value="<?php echo $row['nombre'] ?>" name="nombrevacante">
                            <br>
                            <label for="">Descripcion:</label>
                            <input type="text" value="<?php echo $row['descripcion'] ?>" name="descripcionvacante">
                            <br>
                            <label for="">Fecha de Inicio:</label>
                            <input type="text" value="<?php echo $row['fechaIni'] ?>" name="fechaInivacante">
                            <br>
                            <label for="">Fecha de Cierre:</label>
                            <input type="text" value="<?php echo $row['fechaFin'] ?>" name="fechaFinvacante">
                            <br>
                            <label for="">Materia:</label>
                            <select class="form-control" id="selectItem" name="materiavacante">
                                <?php
                                while ($materiasrow = mysqli_fetch_array($vResMat)) {
                                ?>
                                    <option <?php if ($row['materia'] == $materiasrow['id']) echo 'selected'; ?> value="<?php echo $materiasrow['id']; ?>">
                                        <?php echo $materiasrow['nombreMat']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br>
                            <br>
                            <input type="submit" name="submiteditar" value="Editar" class="btn btn-success"> <br> <br>
                        </form>
                    <?php
                }
                    ?>
                    </div>
                    <?php
                    include "./footer.html";
                    ?>
        </div>
</body>

</html>