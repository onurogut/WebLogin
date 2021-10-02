<!--
Into this file, we write a code for logout.
-->
<?php
require_once('header.php');
session_start();
session_destroy();
header("Location: index.php");
?>