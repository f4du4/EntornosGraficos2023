<?php
session_start();

include "conexion.php";
    //Captura datos desde el Form anterior
$vNom = $_POST['Nom'];
$vApe = $_POST['Ape'];
$vMail = $_POST['Mail'];
$vContra = $_POST['Contra'];
$expresionReg = "/^[A-Z a-z]+$/";

//Arma la instrucción SQL y luego la ejecuta
$vRolQuery = "SELECT id FROM roles WHERE descripcion = 'cliente'";
// como estoy contando deberia ser 0 para dejar q se regitre.
$vEncontrarEmail = "SELECT email FROM usuarios WHERE email = '$vMail'";
$vEmailEncontrado = mysqli_query($link, $vEncontrarEmail) or die (mysqli_error($link));

if ($vEmailEncontrado != null && mysqli_fetch_array($vEmailEncontrado)[0] != null) {
        // mostrar mensaje que ya existe el usuario.
        header("Location: ./registro.php");
        ?>
        <h2 class="errorBackend">El Usuario ya existe</h2><a class="errorEnlace" href="./registro.php">Volver a pantalla de Registro</a>
        <?php
} else {
        if(preg_match($expresionReg,$vNom) == 0 || preg_match($expresionReg,$vApe) == 0){
            header("Location: ./registro.php");
            ?>
            <h2 class="errorBackend">El nombre y/o el apellido son invalidos: solo letras</h2><a class="errorEnlace" href="./registro.php">Volver a pantalla de Registro</a>
            <?php
        }else{
            // vRolResult es un objecto que devuelve msqli_query y necesito convertirlo a array para leerlo. (lo puedo recorrer si hay mas de un resultado).
            $vRolResult = mysqli_query($link, $vRolQuery) or die (mysqli_error($link));
                if ($vRolResult) {
                    // leo la variable porque no puedo usar vRolResult directamente. Asi q se guarda en row (es un array por eso acceso a 0)
                    if ($row = mysqli_fetch_array($vRolResult)) {
                        // creo otra query para insertar el usuario en la bd y le paso tmb el rolId q busque previamente.
                        $addUserQuery = "INSERT INTO usuarios(nombre, apellido, email, pass, rol_id) values('$vNom','$vApe', '$vMail', '$vContra', $row[0])";
                        mysqli_query($link, $addUserQuery) or die (mysqli_error($link));
                        header("Location: ./ingreso.php");
                        ?>
                        <h2 class="correctoBackend">¡Fuiste Registrado Exitosamente! Ya podes iniciar sesion.</h2>
                        <?php
                    }
                }
        }
}

mysqli_close($link);
//abrir aca --> http://localhost/sdgv/registro.php

?>
</body>
</html>