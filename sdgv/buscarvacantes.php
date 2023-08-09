<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vacantes Disponibles</title>
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
           }else if($_SESSION['rol_id']==2){
                   include "./jefecatedra_header.html";
                   include "./jefecatedra_menu.html";
           }else if($_SESSION['rol_id']==3){
                include "./admin_header.html";
                include "./admin_menu.html";
            }else if($_SESSION['rol_id']==4){
               include "./superadmin_header.html";
               include "./superadmin_menu.html";
           }
        }else {
            include "./header.html";
            include "./menu.html";
        }
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-3 titulo">Buscador de Vacantes</h2>
            <form class="text-center justify-content-center p-4 buscador" method="post">
                <input class="busqueda me-2 px-3" name="materia" type="text" placeholder="  Ingrese su busqueda...">
                <button type="submit" name="submit" class="mt-4 mb-5 p-2 click botonBusqueda">BUSCAR</button>
            </form>
            <?php if(isset($_POST["submit"])) {
                include "conexion.php";  
                $vMateria = $_POST["materia"];
                if ($vMateria == '' || $vMateria == null) {
                    $vMateriaQuery = 'SELECT vacantes.id, vacantes.nombre, vacantes.fechaFin, materias.nombreMat FROM vacantes INNER JOIN materias ON vacantes.materia = materias.id';
                } else {
                    $vMateriaQuery = "SELECT vacantes.id, vacantes.nombre, vacantes.fechaFin, materias.nombreMat FROM vacantes 
                INNER JOIN materias ON vacantes.materia = materias.id WHERE materias.nombreMat LIKE '%$vMateria%'"; 
                }
                $vResultado = mysqli_query($link, $vMateriaQuery);
                $num_rows = mysqli_num_rows($vResultado);
                if($num_rows > 0){
                    ?>
                    <br><br>
                    <table class="tablaVacantes">
                        <tr class="tituloTabla">
                            <th>ID</th>
                            <th>Puesto</th>
                            <th>Cierre</th>
                            <th>Materia</th>
                            <th>Orden de Merito</th>
                        </tr>
                        <?php
                        while($row = $vResultado->fetch_array()){
                            $id = $row['id'];
                            $puesto = $row['nombre'];
                            $fechaCierre = $row['fechaFin'];
                            $materia = $row['nombreMat'];
                            
                            $url = "descargar_orden_pdf.php?id=" . urlencode($id);
                        ?>
                        <tr class="datosTabla">
                            <td><?php echo $id ?></td>
                            <td><?php echo $puesto ?></td>
                            <td><?php echo $fechaCierre ?></td>
                            <td><?php echo $materia ?></td>
                            <td><button onclick="descargarArchivo()"><i class="bi bi-filetype-pdf"></i></button></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <br><br>
                     <?php
                  
                }else{
                    ?>
                    <h2 class="text-center justify-content-center p-3">La materia ingresada no existe o bien no hay vacantes abiertas</h2>
                    <?php
                }
            }
            ?>
        </div>

        <?php
        include "./footer.html";
        ?>
    </div>
</body>

</html>