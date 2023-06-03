<!--Ejercicio 4
- Contar las páginas visitadas por un usuario durante su sesión.-->
<?php
    session_start(); //siempre primero inicializo sesion
?>
<html>
    <body>
        <?php
            if (!isset($_SESSION["contador"])){
                $_SESSION["contador"] = 1;       //si no existe el contador, lo igualo a 1
            }else{
                $_SESSION["contador"]++;         //si ya existe lo incremento en 1
            } 
        ?>
        <a href= "contador_visitas.php">Pagina del Contador</a> <!--aca voy a mostrar la cant de visitas-->
    </body>
</html>