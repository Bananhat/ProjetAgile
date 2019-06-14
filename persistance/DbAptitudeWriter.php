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

    public function addApt($idskill, $idstud,$state, $comment, $date)
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `studendtrials`(`student_id`,	`skill_id`, `validated`, `date`, `commentaire`) 
            VALUES (:student_id, :skill_id, :validated, :date, :commentaire)');

        $statement->bindParam(':student_id', $idstud);
        $statement->bindParam(':skill_id', $idskill);
        $statement->bindParam(':validated', $state);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':commentaire', $comment);
        $suc = $statement->execute();

        return $suc;
    }

    public function validateAptitude($studentid, $skillid, $validated, $date) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();

        } catch (Exception $e) {

            return false;
        }


        $statement = $pdo->prepare('update `studendtrials` set validated = :validated where student_id = :aptid and skill_id = :skillid and date = :date');
        $statement->bindParam(':aptid', $studentid);
        $statement->bindParam(':skillid', $skillid);
        $statement->bindParam(':validated', $validated);
        $statement->bindParam(':date', $date);

        $suc = $statement->execute();
        return $suc;
    }
}
