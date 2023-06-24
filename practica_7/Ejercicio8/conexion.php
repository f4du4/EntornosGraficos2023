<?php
  ($link = mysqli_connect("localhost:3306", "root")) or
    die("Hubo problemas de conexion");
  mysqli_select_db($link, "prueba");
?>
