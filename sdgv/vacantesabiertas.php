
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
        session_start();
        if($_SESSION['rol_id']==1){
            include "./cliente_header.html";
            include "./cliente_menu.html";
        }else if($_SESSION['rol_id']==3){
            include "./admin_header.html";
            include "./admin_menu.html";
        }else{
            include "./header.html";
            include "./menu.html";
        }
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-5 titulo">Listado de vacantes abiertas</h2>
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
                $vFechaQuery = "SELECT fechaFin,fechaIni,id,nombre,materia FROM vacantes WHERE '$hoy' BETWEEN vacantes.fechaIni AND vacantes.fechaFin"; 
                $vResultado = mysqli_query($link, $vFechaQuery);
                $num_rows = mysqli_num_rows($vResultado);
                if($num_rows > 0){
                    ?>
                    <br><br>
                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <th>ID</th>
                            <th>Puesto</th>
                            <th>Fecha y Hora de Cierre</th>
                            <th>Materia</th>
                            <th>Accion</th>
                        </tr>
                        <?php
                        while($row = $vResultado->fetch_array()){
                            $id = $row['id'];
                            $puesto = $row['nombre'];
                            $fechaCierre = $row['fechaFin'];
                            $materia = $row['materia'];
                        ?>
                        <tr class="datosTabla">
                            <td><?php echo $id ?></td>
                            <td><?php echo $puesto ?></td>
                            <td><?php echo $fechaCierre ?></td>
                            <td><?php echo $materia ?></td>
                            <td>
                                <form action="postularse.php" method="post">
                                    <input type="hidden" name="idvacante" readonly value="<?php echo $row['id'] ?>">
                                    <input type="submit" class="btn btn-success" value= "Postular" name="submitvacante">
                                </form>
                            </td>
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
</html>