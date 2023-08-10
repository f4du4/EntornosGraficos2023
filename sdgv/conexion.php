<?php
    $link = mysqli_connect("localhost:3306", "root") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "gestionvacantes"); //conexion a base de datos
    /*
    LO DE ARRIBA ES CUANDO LO CORRO LOCAL, EN EL SITIO WEB, QUEDA DE LA SIGUIENTE FORMA:
    $link = mysqli_connect("localhost", "id21133366_gestionvacantes2023","faduaUTN2023!","id21133366_db_gestionvacantes") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "id21133366_db_gestionvacantes"); //conexion a base de datos
    */
?>