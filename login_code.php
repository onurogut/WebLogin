<?php
require_once('header.php');
require_once('config.php');
require_once('online_users.php');
session_start();
$start_time = microtime(true);
$id = $_SESSION['id'];
$_SESSION['id'] = $id;
$email = $password = $pwd = '';
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($db, $sql);
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
		echo "Your account is not verified yet. Please check your inbox.";
		echo "<meta http-equiv='refresh' content='3;URL=index.php'>";

	}
}
else{
	echo "Invalid password or mail";
	echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
}
$end_time = microtime(true);
$final_time = $end_time - $start_time;
$sqltime    = "INSERT INTO taken_time(time)VALUES('$final_time')";
$sqltimex 	= mysqli_query($db, $sqltime);

?>
