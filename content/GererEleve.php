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
    $reqAjjStudent=$db->prepare("INSERT INTO `user`(`firstName`, `name`,'role') VALUES (:firstName,:name,'student')");
    $reqStudent=$db->query("SELECT * FROM USER WHERE role = 'student'");
}?>

<?php get_footer();?>