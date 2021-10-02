<?php
error_reporting(0);
session_start();
require_once('header.php');
require_once('config.php');
$password = $password2 = '';
$hash=$_GET['hash'];
$email=$_GET['email'];
$_SESSION['hash'] = $hash;
$_SESSION['email'] = $email;
$sql = "SELECT * FROM users WHERE hash='$hash' AND email='$email'";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) <= 0)
{
  Header("Location:index.php");
}
?>

<form class="form-horizontal" method="POST" action="changepassword.php">
  <div class="mb-3">
    <div align="center">
  <img src="digitus.png" width="151" height="50"><br><br> </div>
    <label for="exampleInputEmail1" class="form-label">New Password</label>
    <input type="password" class="form-control" name="password" id="password">
    <div id="emailHelp" class="form-text">Feel free.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Re-New Password</label>
    <input type="password" class="form-control" name="password2" id="password">
  </div>
  <div class="mb-3 form-check">
  </div>
  <button type="submit" class="btn btn-success">Set New Password</button>
</form>
