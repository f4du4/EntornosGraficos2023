<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulaciones Cliente</title>
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
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-3 titulo">Mis Postulaciones</h2>
            <?php 
                $idCliente = $_SESSION['id'];
                include "conexion.php";  
                $vClienteQuery = "SELECT postulaciones.id, postulaciones.estado, vacantes.nombre, vacantes.fechaFin, materias.nombreMat
                FROM postulaciones INNER JOIN vacantes ON postulaciones.vacantes_id = vacantes.id INNER JOIN materias ON vacantes.materia = materias.id 
                WHERE postulaciones.usuarios_id = '$idCliente'"; 
                $vResultado = mysqli_query($link, $vClienteQuery);
                $num_rows = mysqli_num_rows($vResultado);
                if($num_rows > 0){
                    ?>
                    <br><br>
                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <th>ID</th>
                            <th>Puesto</th>
                            <th>Materia</th>
                            <th>Fecha y Hora de Cierre</th>
                            <th>Estado</th>
                        </tr>
                        <?php
                        while($row = $vResultado->fetch_array()){
                        ?>
                        <tr class="datosTabla">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['nombre']?></td>
                            <td><?php echo $row['nombreMat'] ?></td>
                            <td><?php echo $row['fechaFin'] ?></td>
                            <td><?php echo $row['estado']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <br><br>
                     <?php
                  
                }else{
                    ?>
                    <h2>Actualmente no tienes postulaciones realizadas.</h2>
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