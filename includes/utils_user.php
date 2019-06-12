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

   if($user->init_by_username($username, md5($password))){
       $_SESSION['user'] = $user;
       return true;
   }

   return false;

}


/**
 * permet d'inscrire un utilisateur dans la base
 * @param string $username Le username de l'utilisateur
 * @param string $password Mot de passe de l'utilisateur
 * @param string $role Rôle de l'utilisateur
 * @return bool|int Faux en cas d'erreur, l'ID de l'utilisateur créé si l'inscription s'est bien faite
 */
function insert_user($username, $password, $role){
    global $db;

    $password = md5($password);

    $req = "INSERT INTO users(username, password, role) VALUES(?, ?, ?)";
    $args = array($username, $password, $role);

    if(!$db->prepare($req)) return false;

    if($db->execute_prepared_query($args)){
        $req = "SELECT id FROM users WHERE username = ?";

        if(!$db->prepare($req)) return false;

        return $db->execute_prepared_query(array($username))[0]['id'];
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

function is_importateur($user_id){
    $user = new User();
    $user->init_by_id($user_id);
    return $user->get('role') == 'importateur';
}

function is_exportateur($user_id){
    $user = new User();
    $user->init_by_id($user_id);
    return $user->get('role') == 'exportateur';
}