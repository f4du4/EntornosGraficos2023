<?php
require_once "../../index.php";
$link = mysqli_connect($_ENV["DB_ENDPOINT"], $_ENV["DB_USER"]) or die("Problemas de conexión a la base de datos");
mysqli_select_db($link, $_ENV["DB_NAME"]);
