<?php
include_once('../includes/utils_page.php');
get_header();

$user = get_logged_user();

try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}

if($user)
{
    $reqUser=$db->query("SELECT * FROM USER WHERE role = 'student'");
}

get_footer();?>