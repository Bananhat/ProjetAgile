<?php declare(strict_types=1);

// An example for reading and processing the data from DbReader functions / classes
/*
include "DbConnector.php";
include "../settings.php";

$reader = new DbSkillReader(new DbConnector());
$result = $reader->getAllSkills();

var_dump($result);
*/

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
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString ));

        $result = $this->dbConnector->execStatement($statement);
        return $result;
    }

    public function getSkillFromId(int $id) : array
    {
        $pdo = $this->dbConnector->getConnection();
        $statement = $pdo->prepare('SELECT * from skill where id = :id');
        $statement->bindParam(':id', $id);
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString ));
        $result = $this->dbConnector->execStatement($statement);
        return $result;
    }

}
