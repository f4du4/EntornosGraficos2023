<html>
<head><title>Documento 2</title></head>
<body>
    <?php
    if (!isset($_POST['submit'])) { //condicional que indica que hacer si no se cliquea el boton
    ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!--FORMULARIO PARA INGRESAR EDAD-->
            <!--Al usar method = post, no me muestra la info ingresada en la url--> 
            Edad: <input name="age" size="2"> 
            <input type="submit" name="submit" value="Ir"> <!--input de tipo submit (Boton)-->
        </form>
    <?php
    }
    else {
        $age = $_POST['age']; //variable age le asigna lo que le devuelve POST
        if ($age >= 21) {   //condicional if que indica que hacer si edad es mayor a 21
            echo 'Mayor de edad'; //muestra que es mayor de edad
        }
        else { //si no es mayor o igual a 21 y sin chequear si ingreso un numero
            echo 'Menor de edad'; //muestra que es menor de edad 
        }
    }
    ?>
</body></html>