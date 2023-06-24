<?php
//verifico que recebi datos del formulario
if (isset($_POST["estilo"])) {
  //estoy recibiendo un estilo nuevo lo tengo que meter en las cookies
  $estilo = $_POST["estilo"];
  //meto el estilo en una cookie
  setcookie("estilo", $estilo, time() + 60 * 60 * 24 * 90);
} else {
  //si no recibi el estilo que quiere el usuario en la página, verifico si hay una cookie creada
  if (isset($_COOKIE["estilo"])) {
    //tengo la cookie
    $estilo = $_COOKIE["estilo"];
  }
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
        <?php //miro si he tengo un estilo definido, porque entonces tengo que cargar la correspondiente hoja de estilos

        if (isset($estilo)) {
            echo '<link rel="STYLESHEET" type="text/css" href="' .$estilo .'.css">';
        }?>
    </head>
    <body>
        <h1>Fadua Dora - Ejercicio 1 - Práctica 7</h1>
        <p>Crear una página que puede configurarse con distintos estilos CSS. El usuario es quien decide qué
        aspecto desea que tenga la página, por medio de un formulario. Luego la página es capaz de
        recordar, entre los distintos accesos que realice el usuario, el aspecto que había elegido para
        mostrar la web.
        </p>
        <form action="index.php" method="post">
            Aquí puedes seleccionar el estilo que prefieres en la página:
            <br />
            <select name="estilo">
                <option value="verde">Verde</option>
                <option value="rojo">Rojo</option>
                <option value="azul">Azul</option>
            </select>
            <input type="submit" value="Actualizar el estilo">
        </form>
    </body>
</html>