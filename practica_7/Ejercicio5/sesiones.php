<?php
    session_start();

    extract($_POST);

    $_SESSION['usuario'] = $usuario;
    $_SESSION['clave'] = $clave;

    print('clave')
  
?>

<a href="perfil.php">Ir al perfil</a>