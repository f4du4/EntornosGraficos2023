<?php
    $link = mysqli_connect("localhost:3306", "root") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "gestionvacantes"); //conexion a base de datos
?>