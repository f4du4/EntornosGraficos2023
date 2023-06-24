<?php
  setcookie("usuario", $_POST["usuario"], time() + 60 * 60 * 24 * 90);
  // redirige cuando setea este header entonces se actualiza la pagina
  header("Location: index.php");
?>
