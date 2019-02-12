<?php
  if( $_SESSION["yetkili"] != 1 ) {
    die("<h1 style='color:red;'>Yetkili Değilsiniz!</h1>");
  }
?>
