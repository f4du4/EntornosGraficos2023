<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validacion alta formulario</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
<?php


include "conexion.php";
    //Captura datos desde el Form anterior
$vMail = $_POST['Mail'];
$vContra = $_POST['Contra'];
session_start();
$_SESSION["email"]=$vMail; //variable de inicio de sesion

// como estoy contando deberia ser 0 para dejar q se regitre.
$vQuery = "SELECT * FROM usuarios WHERE usuarios.email='$vMail' AND usuarios.pass='$vContra'";
$vResultado = mysqli_query($link, $vQuery) or die (mysqli_error($link));
$row =  mysqli_fetch_array($vResultado);
$num_rows = mysqli_num_rows($vResultado);


if($num_rows>0){
    $_SESSION['id']=$row['id'];
    $_SESSION['nombre']=$row['nombre'];
    $_SESSION['apellido']=$row['apellido'];
    $_SESSION['pass']=$row['pass'];
    $_SESSION['email']=$row['email'];
    $_SESSION['rol_id']=$row['rol_id'];
    if ($row['rol_id'] == 1) { //cliente
        header("Location: ./cliente_inicio.php");
        
    }else{
        if ($row['rol_id'] == 2) { //jefe de catedra
            header("Location: ./inicio.php");
        
        }else{
            if ($row['rol_id'] == 3) {  //admin
                header("Location: ./admin_inicio.php");      

            }else{
                if ($row['rol_id'] == 4) { //super admin
                header("Location: ./inicio.php");
                }  
            }
        }
    }
}else{
    include "./ingreso.php";
    ?>
    <h2 class="errorBackend">Email o Contraseña incorrectos, pruebe de nuevo.</h2>
    <?php
}

mysqli_free_result($vResultado);
mysqli_close($link);
//abrir aca --> http://localhost/sdgv/registro.php

?>
</body>
</html>