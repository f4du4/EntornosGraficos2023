<?php
  setcookie("noticia", null, time() - 60);
  header("Location: index.php");
?>
