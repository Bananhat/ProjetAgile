<?php
include('../includes/utils_page.php');
get_header();


    if(isset($_POST['submit']))
    {
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
        }

        if(count($non_remplis) > 0)
        {
            echo 'Veuillez remplir ces champs : <br />';

            foreach($non_remplis as $non_rempli)
            {
                echo $non_rempli.'<br />';
            }
        }
    else
        {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role'];

    if($confirmPassword == $password) {
        $user_id = insert_user($username, $password, $role);

        if(!$user_id)
        {
            echo '<div class="notification is-danger">Erreur</div>';
        }
    }
    else {
        echo '<div class="notification is-danger">Les mots de passe doivent correspondre!</div>';
    }


    header('Location: signup_initiateur.php');
    }
}
?>