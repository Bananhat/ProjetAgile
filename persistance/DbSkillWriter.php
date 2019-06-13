<?php declare(strict_types=1);

class DbSkillWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function addSkill(string $name, int $competence_id) : bool
    {
        $pdo = $this->dbConnector->getConnection();

        $statement = $pdo->prepare('INSERT INTO `skill` (`skill`, `competence_id`)
                                            VALUES (:skill, :competence_id)');

        $statement->bindParam(':skill', $name);
        $statement->bindParam(':competence_id', $competence_id);
        $success =  $statement->execute();
        return $success;
    }

}
