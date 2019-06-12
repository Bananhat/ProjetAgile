<?php
include_once('../includes/utils_page.php');
get_header();

if(isset($_GET['disconnect'])){
    if(get_logged_user()){
        disconnect_current_user(); //a modif avec modele
    }
}

if(isset($_POST['submit'])){
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0){

    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        $auth = authenticate_user_by_username($username, $password); //modele

        if(!$auth){
            echo '<div class="notification is-danger">Erreur</div>';
        }
        else{
            header('Location: signup_initiateur.php');
        }
    }
}
?>