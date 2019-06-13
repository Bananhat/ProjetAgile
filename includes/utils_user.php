<?php

include_once('../settings.php');


/**
 * Permet de connecter un utilisateur grâce à son username
 * @param string $username Username de l'utilisateur
 * @param string $password Mot de passe de l'utilisateur
 * @return bool Vrai si l'utilisateur est connecté, faux sinon
 */
function authenticate_user_by_username($username, $password){

    if(empty($username) || empty($password)){
        return false;
}

    $user = new User();

   if($user->init_by_username($username, $password))
   {
           $_SESSION['user'] = $user;
           return true;
   }

   return false;

}
/**
 * Permet de récupérer l'instance de l'utilisateur actuellement connecté
 * @return User|null L'instance de l'utilisateur s'il est connecté, null sinon
 */
function get_logged_user(){
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if(!$user) return null;

        return $user;
    }

    return null;
}

/**
 * Permet de déconnecter l'utilisateur actuellement connecté
 */
function disconnect_current_user(){
    if(get_logged_user() != null){
        unset($_SESSION['user']);
    }
}

function is_admin($user_id){
    $user = new User();
    $user->init_by_id($user_id);
    return $user->get('role') == 'admin';
}