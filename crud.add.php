<?php
  if( isset($_POST["adi"]) ) {
    ## Veritabanına bağlantı kuralım...
    ## Veritabanına bağlantı kuralım...
    $host     = "localhost";
    $user     = "root";
    $password = "root";
    $database = "kis_kampi_ornekleri";
    $cnnMySQL = mysqli_connect( $host, $user, $password, $database );
    if( mysqli_connect_error() ) die("Veritabanına bağlanılamadı...");
    $temp = mysqli_query($cnnMySQL, "set names 'utf8'");


    ## Veritabanına kayıt ekleme
    ## Veritabanına kayıt ekleme
    // SQL içine konulacak değişkenlere MUTLAKA bu işlem uygulanmalıdır. Bunun sebebi GÜVENLİK'tir.
    $adi = mysqli_real_escape_string($cnnMySQL, $_POST["adi"]);
    $tel = mysqli_real_escape_string($cnnMySQL, $_POST["tel"]);

    $SQL = "INSERT INTO telefonrehberi SET
                adisoyadi = '$adi',
                telefonu  = '$tel'  ";
    $rows = mysqli_query($cnnMySQL, $SQL);

    echo "<p>Kayıt tamam...</p>";
    echo "<a href='index.php'>Ana Sayfa....</a>";
    die();
  }
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Kayıt Ekle</h1>

   <form action="" method="post">

    <p> Adı Soyadı: <input type="text" name="adi" /> </p>
    <p> Telefonu:   <input type="text" name="tel" /> </p>
    <p><input type="submit" value="KAYDET" /> </p>

  </form>


</body>
</html>
