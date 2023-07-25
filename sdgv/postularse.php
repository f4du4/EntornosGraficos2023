<?php
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
        session_start();
        include "./cliente_header.html";
        include "./cliente_menu.html";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-5 titulo">Postulacion a Vacante</h2>
            <?php 
       
            $id_vacante = $_POST['idvacante'];
            $vQuery = "SELECT nombre,materia FROM vacantes WHERE vacantes.id LIKE '$id_vacante'";
            $vResultado = mysqli_query($link, $vQuery);
            $row = mysqli_fetch_array($vResultado);
            $num_rows = mysqli_num_rows($vResultado);
            if($num_rows > 0){
                $materia = $row['materia'];
                $puesto = $row['nombre'];
                $id_usuario = $_SESSION['id'];
                $vUserQuery = "SELECT nombre,apellido,email FROM usuarios WHERE usuarios.id = '$id_usuario'";
                $vResultadoUser = mysqli_query($link,$vUserQuery);
                $rowUser = mysqli_fetch_array($vResultadoUser);
                $numUser = mysqli_num_rows($vResultadoUser);
                if($numUser>0){
                    $nombreUser = $rowUser['nombre'];
                    $apellidoUser = $rowUser['apellido'];
                    $emailUser = $rowUser['email'];
                ?>
                    <div class="row d-flex-row justify-content-center pt-2 m-5">
                        <h3>La persona: <?php echo $rowUser['nombre'] ?> <?php echo $rowUser['apellido'] ?><br>
                        Con correo electronico: <?php echo $rowUser['email'] ?><br>
                        Se postula a la vacante de la materia <?php echo $materia?> para el puesto de <?php echo $puesto ?>.
                        <br><br>
                        Si los datos son correctos y desea postularse, <strong>por favor cargue su CV</strong> y envie la postulacion a traves del boton "Enviar".</h3>
                        <form action="procesar_enviar_postulacion.php" class="d-flex flex-column justify-content-center text-center" method="post">
                            <input type="file" name="fileToUpload" id="fileToUpload" require>
                            <input type="hidden" value = "<?php echo $id_usuario ?>" name ="iduser">
                            <br>
                            <input type="hidden" value = "<?php echo $id_vacante ?>" name ="idvac">
                            <br><br>
                            <input type="submit" name="submitenviar" value="Enviar" class="btn btn-success"><br><br>
                        </form>
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