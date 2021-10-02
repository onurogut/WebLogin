<?php
require_once('header.php');
require_once('config.php');
require_once('online_users.php');
session_start();
$email = $_SESSION['email'];
$hmnu = $_POST['hmnu'];
$hlit = $_POST['hlit'];
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
}
$kontrol = "SELECT admin FROM users WHERE email='$email'";
$kontrol2=mysqli_query($db,$kontrol);
$sonuc = $kontrol2->fetch_array(MYSQLI_NUM);
if($sonuc[0] > 0)
{
  $admin_paneli="<div style='justify-content: center; display: flex; margin-top:-50px;'>
<a href='/digituslogin/admin.php'><font size='4'>Admin Paneli</font></a></div>";
$sql = "SELECT * FROM users WHERE active='0' AND DATEDIFF(created_at,now())";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0)
{
  $didntverify="Users didn't verify their account for more than 1 day: \n". mysqli_num_rows($result);
}
}
else {
  header("Location: index.php");
}
}
else {
		header("Location: index.php");
}
$logtime      = "SELECT AVG(time) FROM taken_time WHERE DAY(day) = DAY('$hlit')";
$logtimex     = mysqli_query($db, $logtime);
$logtimex     = mysqli_fetch_assoc($logtimex);
$logtimetaken = $logtimex['AVG(time)'];
$hmny = "SELECT * FROM users WHERE active='1' AND created_at >= now() - interval '$hmnu' day";
$hmny = mysqli_query($db, $hmny);
if(mysqli_num_rows($hmny) > 0)
{
  $hmnyu=mysqli_num_rows($hmny)." new users registered within $hmnu day.";
}
?>
<div class="jumbotron">
	<center>
		<h1>Welcome <?php echo $username.", ".$name." ".$surname; ?></h1>
		<br><a href="logout.php">Logout</a><br><br>
    <form class="form-horizontal" method="POST" action="admin.php">
      <b>Users Online:</b><? echo $count_user_online; ?><br>
      <b>How many new users are successfully registered within a time period:</b> <? echo $hmnyu; ?>
    <input type="text" name="hmnu" style="width:75px;">
    <input type="submit" value="?"><br>
    <b>How long it takes to complete login (in seconds):</b> <? echo $logtimetaken; ?>
    <input type="date" name="hlit" value="<?php echo date('Y-m-d h:i:s'); ?>" />
    <input type="submit" value="?"><br>


    <? echo $didntverify; ?><br>



	</center>
</div>
