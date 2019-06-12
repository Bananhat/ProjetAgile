
<?php include('../includes/class_user.php');
include('../includes/class_users.php');
include('../includes/utils_user.php');
include('../includes/utils_page.php');?>

get_header();

<?php
    global $db;
    $req = "select * from user where role like('%initiateur%')";
    foreach ($req as $user)
    {
        echo $user->get();
    }?>

get_footer();