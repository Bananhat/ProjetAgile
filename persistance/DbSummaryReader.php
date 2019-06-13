<?php declare(strict_types=1);
/*
require_once("../settings.php");
require_once("DbConnector.php");

$db = new DbSummaryReader(new DbConnector());
var_dump($db->readSummaryFromStudentId(3));
*/

class DbSummaryReader
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function readSummaryFromStudentId($studentId) : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select * from studendtrials inner join skill on studendtrials.skill_id = skill.id
							inner join competences on skill.competence_id = competences.id 
							inner join student on student.id_student = studendtrials.student_id 
							where student.id_student = :studid');

        $statement->bindParam(':studid', $studentId);

        return $this->dbConnector->execStatement($statement);
    }
}
