<?php/
error_reporting(0);
require_once('header.php');
require_once('config.php');
$email = $_POST['email'];
if(!empty($_POST['email'])) {
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($db, $sql);
  if(mysqli_num_rows($result) <= 0)
  {
    $email_not = "<div class='alert alert-danger' role='alert'>E-mail is not registered.</div>";
  }
  else {
    {
      $email_suc = "<div class='alert alert-info' role='alert'>Check your inbox.</div>";
    }
  }

}


$hash=MD5(rand());
$sql = "UPDATE users SET hash='$hash' WHERE email='$email'";
$result = mysqli_query($db, $sql);
$url = 'http://'.$_SERVER['SERVER_NAME'];
$link=$url.'/digituslogin/newpassword.php?hash='.$hash.'&email='.$email;
if($result){
	  $to = $email;
    $subject = "Digitus Şifre Sıfırla";
    $message = "<a href='$link'>Şifre Sıfırla</a>";
    $headers = "From: admin@digitus.login";
    $headers .= "MIME-Version DigitusLogin Şifre Sıfırlama" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to,$subject,$message,$headers);
    if (mail($recipent, $subject, $message, $headers))
{
	echo "Please check your inbox.";
	echo "<meta http-equiv='refresh' content='3;URL=index.php'>";

}
else
{
	echo "";
}

}
else{
echo "";
}
?>
<form class="form-horizontal" method="POST" name="passwordreset" action="passwordreset.php">
  <div class="mb-3">
    <div align="center">
  <img src="onur.png" width="151" height="50"><br><br> </div>

    <? echo $email_not; echo $email_suc;?>

    <label for="exampleInputEmail1" class="form-label">Email:</label>
    <input type="email" class="form-control" name="email" id="email">
    <div id="emailHelp" class="form-text">Feel free.</div>

  </div>
  <div class="mb-3 form-check">
  </div>
  <button type="submit" class="btn btn-success">Sıfırla</button>
</form>
