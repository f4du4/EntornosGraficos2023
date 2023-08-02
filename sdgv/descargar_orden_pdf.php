<?php
include "conexion.php";

$vacanteID = $_GET["id"];

$vQuery = "SELECT om_data FROM vacantes WHERE vacantes.id = '$vacanteID'";
$vResult = mysqli_query($link,$vQuery);
$row = mysqli_fetch_array($vResult);
$response = [
    "pdfData" => $row['om_data'],
  ];
  // Send the JSON response to the client-side
  header("Content-type: application/json");
  echo json_encode($response);
?>