<?php
session_start();
if (!empty($_SESSION["email"])) {
    error_reporting(0); //no quiero q le muestre el warning al cliente
    session_unset();
    session_destroy();
    header("Location: ../../paginas/inicio/inicio.php");
    die();
}
