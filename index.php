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
<html>
<head>
  <meta charset="utf-8" />
  <title>CRUD Örneği</title>
</head>
<body>
  <h1>Telefon Rehberi</h1>
<?php
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği
## Veritabanından kayıt çekme ve TABLE ile listeleme örneği

$SQL = "SELECT * FROM telefonrehberi";
$rows = mysqli_query($cnnMySQL, $SQL);
$RowCount = mysqli_num_rows($rows);
if($RowCount == 0) { // Kayıt yok...
  echo "Rehberde Kayıt bulunamadı...";
} else { // Kayıt var
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
            <td><a href=''>Sil</a></td>
         </tr>";
  } // while
  echo "</table>";
} // Kayıt var
?>

<p>
  <a href="crud.add.php">Yeni kayıt ekle...</a>
</p>

</body>
</html>
