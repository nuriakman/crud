<?php require_once("_config.php"); ?>
<?php
  @session_start(); // Bu yazılmadan SESSION değişkenlerine erişilemez!
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Telefon Rehberi</h1>

  <?php
  $SQL = "SELECT * FROM gruplar ORDER BY grupadi ";
  $rowsGrubu   = mysqli_query($cnnMySQL, $SQL);
  $Secenekler  = "";
  $Secenekler .= "<option value='0'>** HEPSİ **</option>\n";
  while($rowGrup = mysqli_fetch_assoc($rowsGrubu)) {
    $Secenekler .= sprintf("<option value='%s'>%s</option>\n", $rowGrup["id"], $rowGrup["grupadi"]);
  }
  ?>

  <form method="get">
    <p>
      Tel. Bul: <input type="text" name="aranantel" placeholder="Telefonda ara" style="width: 100px;" />
      İsim Bul: <input type="text" name="aranan" placeholder="Arama yapın" style="width: 100px;" />
      Birim Süz: <select name="grup">
        <?php echo $Secenekler; ?>
      </select>
      <input type="submit" value="Ara!" />
    </p>
  </form>

<?php
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği

if( isset($_GET["aranan"]) ) {

  $ARANANAD   = $_GET["aranan"];
  $ARANANGRUP = $_GET["grup"];
  $ARANANTEL  = $_GET["aranantel"];

  $arrKosul = array();
  $arrKosul[] = 1;

  if( $ARANANGRUP > 0 ) { // Grup Süz :: Sadece grupta ara
    $arrKosul[] = " telefonrehberi.grubu = '$ARANANGRUP' ";
  }

  if( $ARANANAD != "" ) { // İsimde Ara
    $arrKosul[] = " adisoyadi like '%$ARANANAD%' ";
  }

  if( $ARANANTEL != "" ) { // Telefonda Ara
    $arrKosul[] = " telefonu like '%$ARANANTEL%' ";
  }

  $Kosul = implode(" AND ", $arrKosul);

  $SQL = "  SELECT
                telefonrehberi.*,
                gruplar.grupadi
            FROM
                telefonrehberi,
                gruplar
            WHERE
               $Kosul AND
               telefonrehberi.grubu = gruplar.id
            ORDER BY
              adisoyadi             ";

} else {
  $SQL = "  SELECT
                telefonrehberi.*,
                gruplar.grupadi
            FROM
                telefonrehberi,
                gruplar
            WHERE
               telefonrehberi.grubu = gruplar.id
            ORDER BY
              adisoyadi             ";
}
$rows = mysqli_query($cnnMySQL, $SQL);
$RowCount = mysqli_num_rows($rows);
if($RowCount == 0) { // Kayıt yok...
  echo "Rehberde Kayıt bulunamadı...";
} else { // Kayıt var


  if( $_SESSION["yetkili"] == 1 ) {  // YÖNETİCİNİN GÖRECEĞİ EKRAN
      // Tablo başlığını yazdıralım
      echo "<table class='table table-hover' border=1 cellpadding=10 cellspacing=0>
              <tr>
                  <th>SıraNo</th>
                  <th>Adı Soyadı</th>
                  <th>Telefonu</th>
                  <th>Grubu</th>
                  <th>Güncelle</th>
                  <th>Sil</th>
               </tr>";
      $c=0;
      while($row = mysqli_fetch_assoc($rows)) {
        extract($row); // "Key" adında değişkenler oluştur :)
        $c++;
        // Tablo başlığını yazdıralım
        echo "<tr>
                <td>$c</td>
                <td>$adisoyadi</td>
                <td>$telefonu</td>
                <td>$grupadi</td>
                <td><a href='crud.update.php?kayitno=$id'>Güncelle</a></td>
                <td><a href='crud.delete.php?kayitno=$id'>Sil</a></td>
             </tr>";
      } // while
      echo "</table>";
  } // if( $_SESSION["yetkili"] == 1 ) {



  if( $_SESSION["yetkili"] != 1 ) {  // KULLANICININ GÖRECEĞİ EKRAN
      // Tablo başlığını yazdıralım
      echo "<table class='table table-hover' border=1 cellpadding=10 cellspacing=0>
              <tr>
                  <th>SıraNo</th>
                  <th>Adı Soyadı</th>
                  <th>Telefonu</th>
                  <th>Grubu</th>
               </tr>";
      $c=0;
      while($row = mysqli_fetch_assoc($rows)) {
        extract($row); // "Key" adında değişkenler oluştur :)
        $c++;
        // Tablo başlığını yazdıralım
        echo "<tr>
                <td>$c</td>
                <td>$adisoyadi</td>
                <td>$telefonu</td>
                <td>$grupadi</td>
             </tr>";
      } // while
      echo "</table>";
  } // if( $_SESSION["yetkili"] == 1 ) {




} // Kayıt var
?>

<?php if( $_SESSION["yetkili"] == 1 ) { ?>
<p> <a href="crud.add.php">Yeni kayıt ekle...</a> </p>
<p> <a href="crud.logout.php">Oturumu Kapat...</a> </p>
<?php } ?>

<p> <a href="crud.login.php">Yönetici Girişi...</a> </p>

</body>
</html>
