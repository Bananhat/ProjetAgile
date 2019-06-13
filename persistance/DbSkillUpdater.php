<?php declare(strict_types=1);


class DbSkillUpdater
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function deleteSkill(int $id)
    {
        $pdo = $this->dbConnector->getConnection();

        $statement = $pdo->prepare('DELETE from skill where id = :id');
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
