<?php
session_start();
if (!empty($_SESSION['email'])) {
    error_reporting(0); //no quiero q le muestre el warning al cliente
    header("Location: /inicio.php");
    session_destroy();
    die;
}
?>
