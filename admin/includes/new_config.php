<?php

// DATABASE CONNECTION
define('DB_HOST','gamamdkpicnyou.mysql.db');
define('DB_USER','gamamdkpicnyou');
define('DB_PASS','RootPicnYou1');
define('DB_NAME','gamamdkpicnyou');

$connection = mysqli_connect('gamamdkpicnyou.mysql.db', 'gamamdkpicnyou', 'RootPicnYou1', 'gamamdkpicnyou');
$connection->set_charset('utf8mb4');
?>