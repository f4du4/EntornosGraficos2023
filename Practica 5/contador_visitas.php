<?php
    session_start();
?>
<html>
    <body>
        <a href="ejercicio4_prac5.php"></a>
        <?php
            echo "Usted ha visitado " . ($_SESSION["contador"]) . " páginas";
        ?>
        <br>
        <br>
        <a href="ejercicio4_prac5.php">Volver a pagina anterior</a>
    </body>
</html>
