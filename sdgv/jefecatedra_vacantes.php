<?php
session_start();
include "conexion.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Postulaciones</title>
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
        include "./jefecatedra_header.html";
        include "./jefecatedra_menu.html";
        include "./breadcrumbs.php";
        
        $idJefeCatedra = $_SESSION['id'];
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-3 titulo">Mis Materias</h2>
            
            <table class="tablaVacantes">
                    <tr class="tituloTabla">
                    <th>Materia</th>
                    <th>Accion</th> 
                    </tr>
                    
                    <?php 

                    $vQuery = "SELECT materias.id, materias.nombreMat FROM materias 
                    WHERE materias.jefecatedra_id = $idJefeCatedra";
                    
                    $vResultado = mysqli_query($link,$vQuery);
                    while($row = $vResultado->fetch_array()){
                    ?>
                    <tr class="datosTabla">
                        <td><?php echo $row['nombreMat'] ?></td>
                        <td>
                            <form action="obtener_postulaciones.php" method="post">
                                <input type="hidden" name="idMateria" readonly value="<?php echo $row['id'] ?>">
                                <input type="submit" class="btn btn-primary" value= "Ver Postulaciones" name="submitpostu">
                            </form>
                        </td>
                        
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>

        <?php
        include "./footer.html";
        ?>
    </div>
</body>
</html>