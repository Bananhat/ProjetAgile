<?php declare(strict_types=1);
include "DbConnector.php";
include "../settings.php";

$reader = new DbSkillReader(new DbConnector());
var_dump($reader->getAllSkills());


class DbSkillReader
{

    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function getAllSkills() : array
    {
        $pdo = $this->dbConnector->getConnection();
        $statement = $pdo->prepare('SELECT * from skill');
        $statement->execute();
        return $statement->fetchAll(FETCH_ASSOC);
    }

    public function getSkillFromId(int $id) : array
    {
        $pdo = $this->dbConnector->getConnection();
        $statement = $pdo->prepare('SELECT * from skill where id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(FETCH_ASSOC);
        return $result;
    }

}
