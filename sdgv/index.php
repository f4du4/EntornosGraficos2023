<?php
if (!defined("BASE_PATH")) {
    define("BASE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/sdgv");
}
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
}

if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    $loader = require_once BASE_PATH . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
