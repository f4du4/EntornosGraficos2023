<?php
    $link = mysqli_connect("localhost:3306", "root") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "gestionvacantes"); //conexion a base de datos
    /*
    LO DE ARRIBA ES CUANDO LO CORRO LOCAL, EN EL SITIO WEB, QUEDA DE LA SIGUIENTE FORMA:
    $link = mysqli_connect("localhost", "id21170736_faduadora","2023FDSicardi!","id21170736_db_gestiondevacantes23") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "id21170736_db_gestiondevacantes23");  //conexion a base de datos
    */
