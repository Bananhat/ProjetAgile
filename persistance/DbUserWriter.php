<?php declare(strict_types=1);
/*
require_once ("../settings.php");
require_once ("DbConnector.php");

$dbConnector = new DbConnector();
$dbUserWriter = new DbUserWriter($dbConnector);

var_dump($dbUserWriter->writeNewUser("Maik", "Neubert", "neubert_maik@test.de", "123456", "initiator"));
*/

class DbUserWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewUser($firstName, $name, $email, $password, $role, $formation) : bool
    {

        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `user`(`firstName`, `name`, `email`, `password`, `role`,`levelFormation` )
            VALUES (:firstname, :name, :email, :password, :role, :form)');

        $statement->bindParam(':firstname', $firstName);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $role);
        $statement->bindParam(':form', $formation);

        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }
}
