<?php
include "../db/conexion.php";

$postulacionesID = $_GET["id"];

$vQuery = "SELECT cv_data FROM postulaciones WHERE postulaciones.id = '$postulacionesID'";
$vResult = mysqli_query($link, $vQuery);
$row = mysqli_fetch_array($vResult);
$response = [
  "pdfData" => $row['cv_data'],
];
// Send the JSON response to the client-side
header("Content-type: application/json");
echo json_encode($response);
mysqli_free_result($vResult);
mysqli_close($link);
