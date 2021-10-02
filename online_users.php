<?php
require_once('config.php');
session_start();
$session    = session_id();
$time       = time();
$time_check = $time-60;
$sql    = "SELECT * FROM online_users WHERE session='$session'";
$result = mysqli_query($db, $sql);
$count  = mysqli_num_rows($result);
if ($count == "0") {
  $sql1    = "INSERT INTO online_users(session, time)VALUES('$session', '$time')";
  $result1 = mysqli_query($db, $sql1);
} else {
  $sql2    = "UPDATE online_users SET time='$time' WHERE session = '$session'";
  $result2 = mysqli_query($db, $sql2);
}
$sql3              = "SELECT * FROM online_users";
$result3           = mysqli_query($db, $sql3);
$count_user_online = mysqli_num_rows($result3);
$sql4    = "DELETE FROM online_users WHERE time<$time_check";
$result4 = mysqli_query($db, $sql4);
?>
