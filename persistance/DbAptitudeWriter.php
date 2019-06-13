<?php declare(strict_types=1);

/*
require_once("../settings.php");
require_once("DbConnector.php");

$db = new DbAptitudeWriter(new DbConnector());
var_dump($db->writeNewAptitude("aptName", "1"));
*/

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
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `aptitude`(`aptitude`,	`validated` )
            VALUES (:aptitude, :validated)');

        $statement->bindParam(':aptitude', $aptitudeName);
        $statement->bindParam(':validated', $validated);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }

    public function validateAptitude($studentid, $skillid, $validated) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();

        } catch (Exception $e) {

            return false;
        }


        $statement = $pdo->prepare('update `studendtrials` set validated = :validated where student_id = :aptid and skill_id = :skillid');
        $statement->bindParam(':aptid', $studentid);
        $statement->bindParam(':skillid', $skillid);
        $statement->bindParam(':validated', $validated);

        $suc = $statement->execute();
        return $suc;
    }

    public function deleteAptitude($aptitudeId) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {

            return false;
        }

        $statement = $pdo->prepare('delete from `aptitude` where id_apt = :aptid');

        $statement->bindParam(':aptid', $aptitudeId);
        $this->dbConnector::outlog("Executing: " . $statement);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }
}
