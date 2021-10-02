<style>
input[type=text],input[type=password],input[type=email] {
  width:220px;
}
</style>


<?php
require_once('header.php');
error_reporting(0);
require_once "config.php";
if ($result = $db -> query("SELECT username FROM users")) {
    $row = $result->fetch_array(MYSQLI_NUM);
    $result -> free_result();
}
$name = $lastname = $active = $admin = $username = $email = $password = $pwd = '';
$name = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);
$hash=MD5(rand());
$active = $admin = "0";
$url = 'http://'.$_SERVER['SERVER_NAME'];
$sql = "INSERT INTO users (username,email,password,name,surname,active,hash,admin) VALUES ('$username','$email','$password','$name','$lastname','$active','$hash','$admin')";
if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) )
{
$result = mysqli_query($db, $sql);
$link=$url.'/digituslogin/verify.php?hash='.$hash.'&email='.$email;
if($result)
{
	  $to = $email;
    $subject = "Account Verification";
    $message = "<a href='$link'>Hesabını Onayla</a>";
    $headers = "From: admin@digituslogin";
    $headers .= "MIME-Version DigitusLogin Onay Kodu" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to,$subject,$message,$headers);
    if (mail($recipient, $subject, $message, $headers))
{
    echo "";
}
else
{
  $registered = "<div class='alert alert-info' role='alert'>Please check your inbox.</div>";
}


}
else
{
  $registered = "<div class='alert alert-danger' role='alert'>E-mail or username is <br>already registered.</div>";
}
}
?>
<form class="form-horizontal" action="register.php" method="POST">
  <div class="mb-3">
    <div align="center">
  <img src="onur.png" width="151" height="50"><br><br> </div>
<? echo $registered; ?>
  <label for="digitusname" class="form-label">Name</label>
    <input type="text" class="form-control" name="firstname" id="firstname" required>

    <label for="digitususurname" class="form-label">Surname</label>
    <input type="text" class="form-control" name="lastname" id="lastname" required >


  <label for="digitususername" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="username" required>


    <label for="digitusemail" class="form-label">Email address</label>
    <input type="email" class="form-control" name ="email" id="email" required>


    <label for="digituspassword" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" required>

  </div>
  <a href="index.php"><button type="button" class="btn btn-primary"><- Login</button></a>
  <button type="submit" class="btn btn-success">Register</button>
  </div>


</form>

</div>
