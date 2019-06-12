<?php

ini_set('display_errors','off');

define('DB_USER', 'agile1');
define('DB_PASSWORD', 'Lociimae1Auchi9U');
define('DB_HOST', 'localhost');
define('DB_NAME', 'agile1_bd');



include_once('includes/class_database.php');
include_once('includes/class_user.php');
include_once('includes/class_users.php');
include_once('includes/utils_user.php');


session_start();