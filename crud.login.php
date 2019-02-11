<?php require_once("_config.php"); ?>

<?php
  if( isset($_POST["kullaniciadi"]) ) {
    if( $_POST["kullaniciadi"] == "admin" and $_POST["parola"] == "qwe"  ) {
      @session_start();
      $_SESSION["yetkili"] = 1;
      header("Location: index.php");
      die(); // header komutundan sonra bunu yazmak zorunludur!
    } else {
      @session_start();
      $_SESSION["yetkili"] = 0;
      echo "<h1 style='color:red;'>YANLIŞ PAROLA</h1>";
    }
  }
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Giriş Yapınız</h1>

   <form action="" method="post">

    <p> Kullanıcı Adı: <input type="text" name="kullaniciadi" /> </p>
    <p> Parolanız: <input type="password" name="parola" /> </p>
    <p>
        <input type="submit" value="GİRİŞ YAP" />
        <a href="index.php">Vazgeç...</a>
    </p>

  </form>


</body>
</html>
