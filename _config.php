<?php
  ## Veritabanına bağlantı kuralım...
  ## Veritabanına bağlantı kuralım...
  $host     = "localhost";
  $user     = "root";
  $password = "root";
  $database = "kis_kampi_ornekleri";
  $cnnMySQL = mysqli_connect( $host, $user, $password, $database );
  if( mysqli_connect_error() ) die("Veritabanına bağlanılamadı...");
  $temp = mysqli_query($cnnMySQL, "set names 'utf8'");
?>
