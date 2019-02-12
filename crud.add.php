<?php require_once("_config.php"); ?>
<?php require_once("crud.yetki.kontrolu.php"); ?>
<?php
  if( isset($_POST["adi"]) ) {
    ## Veritabanına kayıt ekleme
    ## Veritabanına kayıt ekleme
    // SQL içine konulacak değişkenlere MUTLAKA bu işlem uygulanmalıdır. Bunun sebebi GÜVENLİK'tir.
    $adi = mysqli_real_escape_string($cnnMySQL, $_POST["adi"]);
    $tel = mysqli_real_escape_string($cnnMySQL, $_POST["tel"]);
    $grup = mysqli_real_escape_string($cnnMySQL, $_POST["grup"]);

    $SQL = "INSERT INTO telefonrehberi SET
                adisoyadi = '$adi',
                telefonu  = '$tel',
                grubu  = '$grup'            ";
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
    <p> Grubu:
        <?php
          $SQL = "SELECT * FROM gruplar ORDER BY grupadi ";
          $rowsGrubu = mysqli_query($cnnMySQL, $SQL);
          $Secenekler = "";
          while($rowGrup = mysqli_fetch_assoc($rowsGrubu)) {
            $Secenekler .= sprintf("<option value='%s'>%s</option>\n", $rowGrup["id"], $rowGrup["grupadi"]);
          }
        ?>


        <select name="grup">
          <?php echo $Secenekler; ?>
        </select>
    </p>

    <p>
        <input type="submit" value="KAYDET" />
        <a href="index.php">Vazgeç...</a>
    </p>

  </form>


</body>
</html>
