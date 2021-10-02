<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'db_username');
define('DB_PASSWORD', 'db_password');
define('DB_NAME', 'db_name');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$db) {
    die('Bağlanamadı: ' . mysql_error());
}
