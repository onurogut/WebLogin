<!--
Into this file, we create a layout for welcome page.
-->

<?php
error_reporting(0);
require_once('header.php');
require_once('config.php');
$hash = $_GET['hash'];
$email = $_GET['email'];
$kontrol = "SELECT hash FROM users WHERE hash='$hash' AND email='$email'";
$kontrol2=mysqli_query($db,$kontrol);
$sonuc = $kontrol2->fetch_array(MYSQLI_NUM);
if($sonuc> 0)
{
    $sql="UPDATE users SET active ='1' WHERE hash='$hash' AND email='$email'";
    if ($db->query($sql) === TRUE) {
        echo "Hesabınız başarıyla onaylandı.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
      } else {
        echo "Hesap onayında hata: " . $db->error;
      }
}
else{
    echo "Onay kodunuz eşleşmiyor.";
}
?>
