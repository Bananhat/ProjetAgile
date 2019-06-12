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

    public function writeNewUser($firstName, $name, $email, $password, $role) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            return false;
        }
        echo "Hello";

        $password = sodium_crypto_pwhash_str(
            $password,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE
        );

        $statement = $pdo->prepare('INSERT INTO `USER`(`FirstName`, `Name`, `E-mail`, `Password`, `Role`)
            VALUES (:firstname, :name, :email, :password, :role)');

        $statement->bindParam(':firstname', $firstName);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $role);
        return $statement->execute();
    }
}
