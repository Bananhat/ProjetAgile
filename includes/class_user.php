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

        try {
            $db = getInstanceOfDb();
        } catch (Exception $e) {

            return false;
        }


        $prep=$db->prepare('SELECT * FROM USER WHERE id = :id');

        $prep->bindParam(':id', $user_id);

        $suc = $prep->execute();
        $resultat = $prep->fetch();

        $this->ID = $resultat['id'];

        unset($resultat['id']);
        unset($resultat['password']);

        foreach($resultat as $key=>$value)
        {
            $this->attr[$key] = $value;
        }

        return $suc;
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

        try {
            $db = getInstanceOfDb();
        } catch (Exception $e) {

            return false;
        }

        $prep=$db->prepare('SELECT * FROM USER WHERE email = :email AND password = :pass');
        $prep->bindParam(':email', $username);
        $prep->bindParam(':pass', $password);
        $suc = $prep->execute();

        $resultat = $prep->fetch();

        $this->ID = $resultat['id'];

        unset($resultat['id']);
        unset($resultat['password']);

        foreach($resultat as $key=>$value)
        {
            $this->attr[$key] = $value;
        }

        return $suc;
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

}

