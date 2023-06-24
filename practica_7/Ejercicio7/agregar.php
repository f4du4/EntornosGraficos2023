<?php
session_start();
extract($_REQUEST);

($link = mysqli_connect("localhost:3306", "root")) or
  die("No se ha podido establecer la conexion con la base de datos");
// TODO: la base de datos se llama compras? o es la tabla?
mysqli_select_db($link, "compras");

if (!isset($cantidad)) {
  $cantidad = 1;
}
$vSql = "select * from catalogo where id='" . $id . "'";
$vResultado = mysqli_query($link, $vSql);
$row = mysqli_fetch_array($vResultado);

if (isset($_SESSION["carro"])) {
  $carro = $_SESSION["carro"];
}

$carro[md5($id)] = [
  "identificador" => md5($id),
  "cantidad" => $cantidad,
  "producto" => $row["producto"],
  "precio" => $row["precio"],
  "id" => $id,
];

$_SESSION["carro"] = $carro;
header("Location:catalogo.php?" . SID);
?>
