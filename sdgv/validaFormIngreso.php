<?php
include "conexion.php";

//Captura datos desde el Form anterior
$vMail = $_POST['Mail'];
$vContra = $_POST['Contra'];
session_start();
$_SESSION["email"] = $vMail; //variable de inicio de sesion

// como estoy contando deberia ser 0 para dejar q se regitre.
$vQuery = "SELECT * FROM usuarios WHERE usuarios.email='$vMail' AND usuarios.pass='$vContra'";
$vResultado = mysqli_query($link, $vQuery) or die(mysqli_error($link));
$row =  mysqli_fetch_array($vResultado);
$num_rows = mysqli_num_rows($vResultado);

if ($num_rows > 0) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['apellido'] = $row['apellido'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['rol_id'] = $row['rol_id'];

    if ($row['rol_id'] == 1) { //cliente
        header("Location: /cliente_inicio.php");
        exit;
    } else if ($row['rol_id'] == 2) { //jefe de catedra
        header("Location: /jefecatedra_inicio.php");
        exit;
    } else if ($row['rol_id'] == 3) {  //admin
        header("Location: /admin_inicio.php");
        exit;
    } else if ($row['rol_id'] == 4) { //super admin
        header("Location: /admin_inicio.php");
        exit;
    }
} else {
    
?>
   <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>validacion alta formulario</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <link rel="stylesheet" href="./estilos.css">
        </head>
        <body>
        <?php
            include "./header.html";
            include "./menu.html";
            include "./breadcrumbs.php";
        ?> 
            <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="errorBackend">Email o Contraseña incorrectos, pruebe de nuevo. <br>
            <a href="\ingreso.php" type="submit" class="btn btn-light">Ir al Ingreso</a><br><br></h2>  
            </div>
        <?php
        include "./footer.html";
        ?>   
        </body>
        </html>
<?php
}

mysqli_free_result($vResultado);
mysqli_close($link);
?>
