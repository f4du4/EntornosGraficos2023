<?php
require_once "../../index.php";
if (
  isset($_SESSION) &&
  isset($_SESSION["rol_id"]) &&
  $_SESSION["email"] != null &&
  $_SESSION["email"] != ""
) {
  if ($_SESSION["rol_id"] == 1) {
    include BASE_PATH . "/componentes/headers/cliente_header.php";
    include BASE_PATH . "/componentes/menu/cliente_menu.html";
    $rol = "cliente";
  } elseif ($_SESSION["rol_id"] == 2) {
    include BASE_PATH . "/componentes/headers/jefecatedra_header.php";
    include BASE_PATH . "/componentes/menu/jefecatedra_menu.html";
    $rol = "jefe de catedra";
  } elseif ($_SESSION["rol_id"] == 3) {
    include BASE_PATH . "/componentes/headers/admin_header.php";
    include BASE_PATH . "/componentes/menu/admin_menu.html";
    $rol = "admin";
  } elseif ($_SESSION["rol_id"] == 4) {
    include BASE_PATH . "/componentes/headers/admin_header.php";
    include BASE_PATH . "/componentes/menu/admin_menu.html";
    $rol = "super admin";
  }
} else {
  include BASE_PATH . "/componentes/headers/header.php";
  include BASE_PATH . "/componentes/menu/menu.html";
}
include BASE_PATH . "/componentes/breadcrumbs/breadcrumbs.php";
