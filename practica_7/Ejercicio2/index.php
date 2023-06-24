<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ejercicio 2</title>
  </head>
  <body>
      
      <h1>Fadua Dora - Ejercicio 2 - Practica 7</h1>
      Crear una cookie llamada “contador” que lleve la cuenta en el lado cliente del número de veces que
      se ha accedido a la página contador.php. Si es la primera vez que se accede, la página dará la
      bienvenida al usuario. Si ya se ha accedido anteriormente, la página hará uso de la cookie para
      mostrar el número de veces que se ha visitado dicha página.
      <?php if (isset($_COOKIE["contador"])) {
        setcookie(
          "contador",
          $_COOKIE["contador"] + 1,
          time() + 60 * 60 * 24 * 90
        );
        echo "<p> Has visitado la página " .
          $_COOKIE["contador"] .
          " veces.</p>";
      } else {
        setcookie("contador", 1, time() + 60 * 60 * 24 * 90);
        echo "<p>Bienvenido al contador de visitas!</p>";
      } ?>

  </body>
</html>