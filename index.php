<?php
require_once('header.php');
require_once('config.php');
require_once('online_users.php');
session_start();
$id = $_SESSION['id'];
$_SESSION['id'] = $id;
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0){
  header("Location:user.php");
}
$start_time = microtime(true);
$id = $_SESSION['id'];
$_SESSION['id'] = $id;
$email = $password = $pwd = '';
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($db, $sql);
if(!empty($_POST['email']) && !empty($_POST['password'])) {

if(mysqli_num_rows($result) > 0)
{
		$kontrol = "SELECT active FROM users WHERE email='$email'";
		$kontrol2=mysqli_query($db,$kontrol);
		$sonuc = $kontrol2->fetch_array(MYSQLI_NUM);
		if($sonuc[0] > 0)
		{
		while($row = mysqli_fetch_assoc($result))
		{
			$id = $row["id"];
			$email = $row["email"];
			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $email;
		}
		header("Location: user.php");
	}
	else
	{
		$checkinbox = "<div class='alert alert-warning' role='alert'>Your account is not verified yet. Please check your inbox.</div>";

	}
}
else{
	$invalidpass =  "<div class='alert alert-danger' role='alert'>Invalid password or mail.</div>";
}
}
else {
  if(!empty($_POST['email']) || !empty($_POST['password']) ) {
  $emptyvalue = "<div class='alert alert-warning' role='alert'>Don't leave a blank area.</div>"; }
}
$end_time = microtime(true);
$final_time = $end_time - $start_time;
$sqltime    = "INSERT INTO taken_time(time)VALUES('$final_time')";
$sqltimex 	= mysqli_query($db, $sqltime);
?>
<form class="form-horizontal" method="POST" action="index.php">
  <div class="mb-3">
    <div align="center">
  <img src="onur.png" width="151" height="50"><br><br> </div>
  <? echo $checkinbox; echo $invalidpass; echo $emptyvalue;?>
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="email" required>
    <div id="emailHelp" class="form-text">Feel free.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password" required>
  </div>

    <a href="passwordreset.php"><label>Forgot password?</label></a>
  <a href="register.php"><button type="button" class="btn btn-success">Register</button></a>
  <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
