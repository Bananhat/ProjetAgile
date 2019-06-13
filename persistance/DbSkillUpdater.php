<?php declare(strict_types=1);

include "DbConnector.php";
include "../settings.php";

$updater = new DbSkillUpdater(new DbConnector());
$updater->updateSkillCompetence(1, 3);

class DbSkillUpdater
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function deleteSkill(int $id) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }
        $statement = $pdo->prepare('DELETE from skill where id = :id');
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

    public function updateSkillName(int $id, string $name) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }

        $statement = $pdo->prepare('UPDATE skill set skill = :name where id = :id');
        $statement->bindParam(':name', $name);
        $statement->bindParam(':id', $id);
        $success = $statement->execute();
        $this->dbConnector::outlog($statement->errorInfo());
        return $success;
    }

    public function updateSkillCompetence(int $id, int $competence_id) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }

        $statement = $pdo->prepare('UPDATE skill set competence_id = :competence_id where id = :id');
        $statement->bindParam(':competence_id', $competence_id);
        $statement->bindParam(':id', $id);
        $success = $statement->execute();
        $this->dbConnector::outlog($statement->errorInfo());
        return $success;
    }
}
