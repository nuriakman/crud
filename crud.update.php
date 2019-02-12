<?php require_once("_config.php"); ?>
<?php require_once("crud.yetki.kontrolu.php"); ?>
<?php
  if(isset($_POST["adi"])) {
    ## Veritabanına kayıt ekleme
    ## Veritabanına kayıt ekleme
    // SQL içine konulacak değişkenlere MUTLAKA bu işlem uygulanmalıdır. Bunun sebebi GÜVENLİK'tir.
    $adi = mysqli_real_escape_string($cnnMySQL, $_POST["adi"]);
    $tel = mysqli_real_escape_string($cnnMySQL, $_POST["tel"]);
    $grup= mysqli_real_escape_string($cnnMySQL, $_POST["grup"]);
    $KAYITNO = mysqli_real_escape_string($cnnMySQL, $_POST["id"]);

    $SQL = "UPDATE telefonrehberi SET
                adisoyadi = '$adi',
                telefonu  = '$tel',
                grubu  = '$grup'
            WHERE id = '$KAYITNO'       ";
    $rows = mysqli_query($cnnMySQL, $SQL);
    echo "<p>Kayıt güncellendi...</p>";
    echo "<a href='index.php'>Ana Sayfa....</a>";
    die();
  }


  $KAYITNO = $_GET["kayitno"];
  $SQL  = "SELECT * FROM telefonrehberi WHERE id='$KAYITNO'  ";
  $rows = mysqli_query($cnnMySQL, $SQL);
  $row  = mysqli_fetch_assoc($rows);

?>
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Kayıt Güncelle</h1>

   <form action="" method="post">

    <p> Adı Soyadı: <input type="text" name="adi" value="<?=$row["adisoyadi"]?>" /> </p>
    <p> Telefonu:   <input type="text" name="tel" value="<?=$row["telefonu"]?>"/> </p>
    <p> Grubu:
        <?php
          $SQL = "SELECT * FROM gruplar ORDER BY grupadi ";
          $rowsGrubu = mysqli_query($cnnMySQL, $SQL);
          $Secenekler = "";
          while($rowGrup = mysqli_fetch_assoc($rowsGrubu)) {
            if( $rowGrup["id"] == $row["grubu"] ) $Secili = " selected "; else $Secili = "";
            $Secenekler .= sprintf("<option value='%s' $Secili>%s</option>\n", $rowGrup["id"], $rowGrup["grupadi"]);
          }
        ?>
        <select name="grup">
          <?php echo $Secenekler; ?>
        </select>
    </p>
    <p>
        <input type="submit" value="Güncelle" />
        <input type="hidden" name="id" value="<?=$row["id"]?>"/>
        <a href="index.php">Vazgeç...</a>
    </p>

  </form>


</body>
</html>
