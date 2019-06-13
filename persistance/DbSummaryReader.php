<?php declare(strict_types=1);

require_once("../settings.php");
require_once("DbConnector.php");
/*
$db = new DbSummaryReader(new DbConnector());
<<<<<<< Updated upstream
var_dump($db->readSummaryFromStudentId(3));
=======
var_dump($db->getSkillCountFromId(3));
>>>>>>> Stashed changes
*/

$test = new DbSummaryReader(new DbConnector());
var_dump($test->getDates(3));


class DbSummaryReader
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function getSkillCountFromCompetenceId($id)
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }
        $statement = $pdo->prepare("SELECT *, count(*) FROM `skill` where competence_id = :id");
        $statement->bindParam(':id', $id);

        return $this->dbConnector->execStatement($statement);
    }

    public function getSkillsFromCompetenceId($id)
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }
        $statement = $pdo->prepare("SELECT * FROM skill where competence_id = :id");
        $statement->bindParam(':id', $id);
        return $this->dbConnector->execStatement($statement);
    }

    public function getDates($studentId)
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare("SELECT date FROM studendtrials WHERE student_id=:id order by date");
        $statement->bindParam(':id', $studentId);
        return $this->dbConnector->execStatement($statement);
    }

    #SELECT competence_id, count(*) FROM `skill` group by competence_id having competence_id = :id;

    public function getCompetencesFromStudentId($studentId)
    {
        $pdo = $this->dbConnector->getConnection();

        $statement = $pdo->prepare("SELECT * FROM competences WHERE niveau = (SELECT level FROM student WHERE id_student = :id)");
        $statement->bindParam(':id', $studentId);

        return $this->dbConnector->execStatement($statement);
    }

    public function readSummaryFromStudentId($studentId) : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select * from student
                                    left join studendtrials on studendtrials.student_id = student.id_student
                                    left join skill on skill_id = studendtrials.skill_id
                                    left join competences on competences.id = skill.competence_id
                                    where student.id_student = :studid order by competences.id asc');

        $statement->bindParam(':studid', $studentId);
        //$statement->execute();
        //$statement->fetchAll(2);
        //var_dump($statement);
        return $this->dbConnector->execStatement($statement);
    }

    public function getStudentNames() : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select name, firstName from student');

        return $this->dbConnector->execStatement($statement);
    }

    public function getCompetences() : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select name, niveau from competences');

        return $this->dbConnector->execStatement($statement);
    }

    public function getAptitudes() : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select aptitude, validated from aptitude');

        return $this->dbConnector->execStatement($statement);
    }

    public function getCommentFromStudent($studid) : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select comment from student where student.id_student = :studid');

        $statement->bindParam(':studid', $studid);


        return $this->dbConnector->execStatement($statement);
    }

    public function getStudentsInAptitude() : array
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('select * from student
                                    inner join studendtrials on student.id_student = studendtrials.student_id
                                    where studendtrials.validated = false');


        return $this->dbConnector->execStatement($statement);
    }


}
