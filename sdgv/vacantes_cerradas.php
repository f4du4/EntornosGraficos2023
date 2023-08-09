<?php
include "conexion.php";  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Vacantes Cerradas</title>
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
         
         if($_SESSION['email'] != null && $_SESSION['email'] != ''){
             if($_SESSION['rol_id']==1){
                 include "./cliente_header.html";
                 include "./cliente_menu.html";
            }
            
         }else {
             include "./header.html";
             include "./menu.html";
        }
         include "./breadcrumbs.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Listado de vacantes cerradas</h2>
            <?php 
                date_default_timezone_set("America/Argentina/Buenos_Aires"); //defino la zona horaria
                $dia = date("d"); //j es los dias sin el cero adelante
                $mes = date("m"); //n es los meses sin el cero adelante
                $year = date("Y");
                $hora = date("H"); //horas de 00 a 23
                $min = date("i"); //minutos de 00 a 59
                $seg = date("s"); //segundos de 00 a 59
                $hoy = date("Y-m-d H:i:s");
                
                $vFechaQuery = "SELECT vacantes.nombre, materias.nombreMat, postulaciones.puntaje, usuarios.email 
                FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id
                INNER JOIN postulaciones ON postulaciones.vacantes_id = vacantes.id
                INNER JOIN usuarios ON postulaciones.usuarios_id = usuarios.id
                WHERE '$hoy' >= vacantes.fechaFin AND vacantes.fue_enviado = 1 AND postulaciones.estado = 'Aceptada'"; 
                $vResultado = mysqli_query($link, $vFechaQuery);
                $num_rows = mysqli_num_rows($vResultado);
                if($num_rows > 0){
                    // por cada materia y cada vacante, deberia mostrar la persona y su puntaje supongo
                    //quizas par mostrar el ganador podria hacer una flag en la tabla postulaciones
                    ?>
                    <br><br>
                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <!--<th>ID</th>-->
                            <th>Materia</th>
                            <th>Puesto</th>
                            <th>Ganador</th>
                            <th>Puntaje</th>
                        </tr>
                        <?php
                        while($row = $vResultado->fetch_array()){
        
                        ?>
                        <tr class="datosTabla">
                            <td><?php echo $row['nombreMat'] ?></td>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['puntaje'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <br><br>
                     <?php
                  
                }else{
                    ?>
                    <h2>Actualmente no estan disponibles los resultados de ningun concurso.</h2>
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