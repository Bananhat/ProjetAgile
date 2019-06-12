<?php

/**
 * Cette classe représente un utilisateur du site. Elle permet de récupérer des informations le concernant mais aussi de les modifier avec la méthode <b>set</b> puis la méthode <b>save</b>.
 */
class User
{

    /**
     * @var int ID de l'utilisateur
     */
    public $ID = -1;

    /**
     * @var array Tableau associatif contenant les attributs de la table users
     *
     * Liste des attributs :
     * username
     * email
     */
    public $attr = array();

    /**
     * Constructeur de la classe User
     */
    public function __construct(){

    }

    /**
     * Tente de retrouver l'utilisateur correspondant à l'identifiant donné
     * @param string|int $user_id L'ID de l'utilisateur recherché
     * @return bool Faux en cas d'erreur, vrai sinon
     */
    public function init_by_id($user_id){
        global $db;

        $req = "SELECT * FROM users WHERE id = ?";
        $db->prepare($req);
        $row = $db->execute_prepared_query(array($user_id))[0];

        if(!$row){
            return false;
        }

        $this->ID = $row['id'];


        unset($row['id']);
        unset($row['password']);

        foreach($row as $key=>$value){
            $this->attr[$key] = $value;
        }

        return true;
    }


    /**
     * Tente de retrouver l'utilisateur correspondant au username et au password
     * @param string $username Username de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return bool Vrai si l'utilisateur est retrouvé, faux sinon
     */
    public function init_by_username($username, $password){
        if(empty($username) || empty($password)){
            return false;
        }

        global $db;

        $req = "SELECT * FROM users WHERE username = ? AND password = ?";
        $db->prepare($req);
        $row = $db->execute_prepared_query(array($username, $password))[0];

        if(!$row){
            return false;
        }

        $this->ID = $row['id'];


        unset($row['id']);
        unset($row['password']);

        foreach($row as $key=>$value){
            $this->attr[$key] = $value;
        }

        return true;
    }



    /**
     * Méthode permettant de récupérer la valeur d'un attribut de l'utilisateur
     * @param string $key Attribut souhaité
     * @return int|mixed L'ID si celui-ci est demandé, l'attribut demandé sinon
     */
    public function get($key){
        if(mb_strtolower($key) == 'id')
            return $this->ID;

        if(isset($this->attr[$key])){
            return $this->attr[$key];
        }
        else{

        }

    }

    /**
     * Permet de changer la valeur d'un attribut de l'utilisateur
     * @param string $key Attribut à changer
     * @param mixed $value Valeur à attribuer à $key
     * @return bool Faux si on tente de set l'ID, vrai si la mutation s'est bien faite.
     */
    public function set($key, $value){
        if(mb_strtolower($key) == 'id'){
            return false;
        }

        $this->attr[$key] = $value;
        return true;
    }


    /**
     * Permet de sauvegarder l'utilisateur dans la base de données. Cette fonction doit être appelée notamment quand on change des attributs de l'utilisateur, avec la méthode <b>set</b> par exemple
     * @return bool|mixed Faux en cas d'erreur ou si l'instance n'est pas initialisée, Vrai sinon.
     */
    public function save(){
        if($this->ID == -1) return false;

        $req = "UPDATE users SET ";

        $args = array();

        foreach($this->attr as $key=>$value){
            $req .= "$key = ?, ";
            $args[] = $value;
        }

        $req = substr($req, 0, strlen($req) - 2);

        $req .= " WHERE id = ?";
        $args[] = $this->ID;

        global $db;
        if(!$db->prepare($req)) return false;

        return $db->execute_prepared_query($args);
    }

}

