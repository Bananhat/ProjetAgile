<?php

ini_set('display_errors','off');

define('DB_USER', 'root');
define('DB_PASSWORD', '123456');
define('DB_HOST', '172.21.0.1');
define('DB_NAME', 'agile1_bd');



include_once('includes/class_database.php');
include_once('includes/class_user.php');
include_once('includes/class_users.php');
include_once('includes/utils_user.php');


session_start();