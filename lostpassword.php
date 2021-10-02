<?php
require_once('header.php');
error_reporting(0);
// Include config file
require_once "config.php";
if ($result = $db -> query("SELECT username FROM users")) {
    $row = $result->fetch_array(MYSQLI_NUM);
    echo $row[0];// remove $row[1]  because it fills only the $row[0]
    $result -> free_result();


}
$name = $lastname = $active = $username = $email = $password = $pwd = '';
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
$result = mysqli_query($db, $sql);
$link=$url.'/digituslogin/verify.php?hash='.$hash.'&email='.$email;
if($result)
{
	$to = $email;
    $subject = "Email Verification";
    $message = "<a href='$link'>Hesabını Onayla</a>";
    $headers = "From: admin@digituslogin";
    $headers .= "MIME-Version DigitusLogin Onay Kodu" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to,$subject,$message,$headers);
    if (mail($recipient, $subject, $message, $headers))
{
    echo "wdwdwdwd";
}
else
{
    echo "Please check your inbox.";
    echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
}
    // header("Location: index.php");

}
else
{
	echo "Error :".$sql;
}
?>
