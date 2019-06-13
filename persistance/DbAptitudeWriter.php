<?php declare(strict_types=1);
require_once ("../settings.php");
require_once("DbConnector.php");
$db = new DbAptitudeWriter(new DbConnector());
var_dump($db->writeNewAptitude("aptname", "true"));


class DbAptitudeWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewAptitude($aptitudeName, $validated) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {

            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `aptitude`(`aptitude`,	`validated` )
            VALUES (:aptitude, :validated)');

        $statement->bindParam(':aptitude', $aptitudeName);
        $statement->bindParam(':validated', $validated);

        $suc = $statement->execute();
        return $suc;
    }
}
