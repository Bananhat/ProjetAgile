<?php

/**
 * Cette classe est une classe plus générale que la classe <b>User</b> en le fait qu'elle ne gère non pas un utilisateur mais permet d'agir sur des utilisateurs de manière plus souple.
 * Elle ne contient donc pas d'attributs mais simplement des méthodes utilitaires.
 */
class Users
{

    /**
     * Constructeur de la classe (ne fait rien)
     */
    public function __construct(){

    }


    /**
     * Cette méthode permet d'ajouter une entrée dans la table user_meta
     * Cette méthode est substituable à <b>update_meta</b>, car si la $meta_key existe, elle sera modifiée
     * @param string|int $user_id LID de l'utilisateur à qui ajouter la meta
     * @param string $meta_key Nom de la meta
     * @param string $meta_value Valeur donnée à la meta
     * @return bool|mixed|null Faux en cas d'erreur, Vrai si l'insertion a été faite
     */
    public function add_meta($user_id, $meta_key, $meta_value){
        global $db;

        $req = "SELECT id FROM users WHERE id = ?";

        if(!$db->prepare($req)) return false;

        if($db->execute_prepared_query(array($user_id))){


            /* Test si la meta existe déjà*/
            $req = "SELECT * FROM user_meta WHERE user_id = ? AND meta_key = ?";
            $args = array($user_id, $meta_key);

            if(!$db->prepare($req)) return false;

            if(count($db->execute_prepared_query($args)) > 0){
                return $this->update_meta($user_id, $meta_key, $meta_value);
            }

            $req = "INSERT INTO user_meta(user_id, meta_key, meta_value) VALUES(?, ?, ?)";
            $args = array($user_id, $meta_key, $meta_value);

            if(!$db->prepare($req)) return false;

            return $db->execute_prepared_query($args);
        }
        else
            return false;
    }


    /**
     * Permet de récupérer la valeur d'une meta pour un utilisateur donné
     * @param string|int $user_id ID de l'utilisateur
     * @param string $meta_key Nom de la meta à récupérer
     * @return mixed|null La valeur de la meta ou null en cas d'erreur
     */
    public function get_meta($user_id, $meta_key){
        global $db;

        $req = "SELECT id FROM users WHERE id = ?";

        if(!$db->prepare($req)) return null;

        if($db->execute_prepared_query(array($user_id))){
            $req = "SELECT meta_value FROM user_meta WHERE user_id = ? AND meta_key = ?";
            $args = array($user_id, $meta_key);

            if(!$db->prepare($req)) return null;

            return $db->execute_prepared_query($args)[0]['meta_value'];
        }
        else
            return null;
    }


    /**
     * Permet de modifier la valeur d'une meta pour un utilisateur donné
     * Cette méthode est substituable à <b>add_meta</b>, car si la $meta_key n'existe pas l'entrée sera insérée
     * @param string|int $user_id ID de l'utilisateur
     * @param string $meta_key Nom de la meta
     * @param string $meta_value Valeur donnée à la meta
     * @return bool|mixed|null Faux en cas d'erreur, Vrai si la modification a été faite
     */
    public function update_meta($user_id, $meta_key, $meta_value){
        global $db;

        $req = "SELECT id FROM users WHERE id = ?";

        if(!$db->prepare($req)) return null;

        if($db->execute_prepared_query(array($user_id))){

            /* Test si la meta n'existe pas*/
            $req = "SELECT * FROM user_meta WHERE user_id = ? AND meta_key = ?";
            $args = array($user_id, $meta_key);

            if(!$db->prepare($req)) return false;

            if(count($db->execute_prepared_query($args)) == 0){
                return $this->add_meta($user_id, $meta_key, $meta_value);
            }




            $req = "UPDATE user_meta SET meta_value = ? WHERE user_id = ? AND meta_key = ?";
            $args = array($meta_value, $user_id, $meta_key);

            if(!$db->prepare($req)) return null;

            return $db->execute_prepared_query($args);
        }
        else
            return null;
    }

}

global $users;
$users = new Users();