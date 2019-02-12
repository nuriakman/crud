<?php require_once("_config.php"); ?>
<?php require_once("crud.yetki.kontrolu.php"); ?>
<?php
  if(isset($_POST["id"])) {
    ## Veritabanına kayıt ekleme
    ## Veritabanına kayıt ekleme
    // SQL içine konulacak değişkenlere MUTLAKA bu işlem uygulanmalıdır. Bunun sebebi GÜVENLİK'tir.
    $KAYITNO = mysqli_real_escape_string($cnnMySQL, $_POST["id"]);

    $SQL = "DELETE FROM telefonrehberi WHERE id = '$KAYITNO'       ";
    $rows = mysqli_query($cnnMySQL, $SQL);
    echo "<p>Kayıt Silindi...</p>";
    echo "<a href='index.php'>Ana Sayfa....</a>";
    die();
  }


  $KAYITNO = $_GET["kayitno"];
  $SQL = "  SELECT
                telefonrehberi.*,
                gruplar.grupadi
            FROM
                telefonrehberi,
                gruplar
            WHERE
               telefonrehberi.id = '$KAYITNO' AND
               telefonrehberi.grubu = gruplar.id
            ORDER BY
              adisoyadi             ";
  $rows = mysqli_query($cnnMySQL, $SQL);
  $row  = mysqli_fetch_assoc($rows);

?>
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Kayıt Silme</h1>

   <form action="" method="post">

    <p> Adı Soyadı: <?=$row["adisoyadi"]?> </p>
    <p> Telefonu:   <?=$row["telefonu"]?> </p>
    <p> Grubu:      <?=$row["grupadi"]?> </p>
    <p>
        <input type="submit" value="KAYDI SİL" />
        <input type="hidden" name="id" value="<?=$row["id"]?>"/>
        <a href="index.php">Vazgeç...</a>
    </p>

  </form>


</body>
</html>
