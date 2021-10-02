<?php
error_reporting(0);
session_start();
require_once('header.php');
require_once('config.php');
$password = $password2 = '';
$hash = $_SESSION['hash'];
$email = $_SESSION['email'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$password=MD5($password);
$password2=MD5($password2);
if ($password == $password2)
{
  $sql = "UPDATE users SET password='$password' WHERE email='$email' AND hash='$hash'";
  $result = mysqli_query($db, $sql);
  if($result){
  echo "password has changed.";
  $hash = MD5(rand());
  $sql2 = "UPDATE users SET hash='$hash' WHERE email='$email'";
  $result2 = mysqli_query($db, $sql2);
  echo "<meta http-equiv='refresh' content='2;URL=index.php'>";

  }
  else{
  echo "there is an error.";
  echo "<meta http-equiv='refresh' content='2;URL=index.php'>";

  }
}
else{
  echo "<font color='red' size='72'>passwords are not same.</font>";
  echo "<meta http-equiv='refresh' content='3;URL=index.php'>";


}


?>
