<?php
function generarContrasenaAleatoria($longitud = 12)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';
    $contrasena = '';
    $caracteres_length = strlen($caracteres) - 1;

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, $caracteres_length);
        $contrasena .= $caracteres[$indice];
    }
    echo $contrasena;
    return $contrasena;
}
