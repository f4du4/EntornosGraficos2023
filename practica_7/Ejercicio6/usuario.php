<?php
session_start();

include "conexion.php";

$vSql = "SELECT nombre FROM alumnos WHERE mail='" . $_POST["mail"] . "'";
($vResultado = mysqli_query($link, $vSql)) or die(mysqli_error($link));
$fila = mysqli_fetch_array($vResultado);

if (mysqli_num_rows($vResultado) == 0) {
  echo "El mail ingresado no existe en la base<br>";
  
  echo "<a href='index.html'>Volver al Inicio</a>";
} else {
  $_SESSION["nombre"] = $fila["nombre"]; ?>
  <a href="bienvenida.php">Ir a la página siguiente</a>
<?php
} ?>
