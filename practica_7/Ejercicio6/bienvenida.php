<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
  </head>
  <body>
    <?php if (isset($_SESSION["nombre"])) {
      echo "<h2>Bienvenido " . $_SESSION["nombre"] . "!</h2>";
    } else {
      echo "<p>Usted no puede visitar esta página</p>";
    } ?>
  </body>
</html>