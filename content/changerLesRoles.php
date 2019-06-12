
<?php include('../includes/class_user.php');
include('../includes/class_users.php');
include('../includes/utils_user.php');?>

<?php $users = get_logged_user();/*recup tous les utilisateurs*/
        foreach ($users as $user)
        {
            echo $user->get();
        }?>
