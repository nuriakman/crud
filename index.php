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

  <form method="get">
    <p>
      İsim Bul: <input type="text" name="aranan" placeholder="Arama yapın" />
      <input type="submit" value="Ara!" />
    </p>
  </form>

<?php
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği

if( isset($_GET["aranan"]) ) {
  $ARANAN = $_GET["aranan"];
  $SQL = "SELECT * FROM telefonrehberi WHERE adisoyadi like '$ARANAN%' ";
} else {
  $SQL = "SELECT * FROM telefonrehberi";
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
