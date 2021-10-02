<?php
require_once('header.php');
require_once('config.php');
session_start();
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$_SESSION['id'] = $id;
$_SESSION['email'] = $email;
$name = $surname = $email = $username = '';
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$name = $row["name"];
		$surname = $row["surname"];
		$email = $row["email"];
		$username = $row["username"];
		$kontrol = "SELECT admin FROM users WHERE email='$email'";
		$kontrol2=mysqli_query($db,$kontrol);
		$sonuc = $kontrol2->fetch_array(MYSQLI_NUM);
		if($sonuc[0] > 0)
		{
			$admin_paneli="<div style='justify-content: center; display: flex; margin-top:-50px;'>
<a href='/digituslogin/admin.php'><button type='button' class='btn btn-primary'>Admin Paneli</button></a></div>";
		}
}
}
else {

		header("Location: index.php");
}


?>
<div class="jumbotron">
	<center>
		<h1>Welcome <?php echo $username.", ".$name." ".$surname; ?></h1><br>
	<br><br><? echo $admin_paneli; ?><br>
		<a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>

	</center>
</div>
