<?php
  @session_start();
  $_SESSION["yetkili"] = 0;

  // Veya:
  unset($_SESSION["yetkili"]); // Bu değişkeni yok et!

  header("Location: index.php");
  die();
?>
