<?php declare(strict_types=1);
/*
require_once("../settings.php");
require_once("DbConnector.php");

$db = new DbCompetenceWriter(new DbConnector());
var_dump($db->writeNewCompetence("testname", "niveau"));
*/

class DbCompetenceWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewCompetence($competenceName, $niveau) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `competences`(`name`,	`niveau` )
            VALUES (:name, :niveau)');

        $statement->bindParam(':name', $competenceName);
        $statement->bindParam(':niveau', $niveau);

        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }

    public function updateCompetenceName($id, $name) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }

        $statement = $pdo->prepare('UPDATE competences set name = :name where competence_id = :id');
        $statement->bindParam(':name', $name);
        $statement->bindParam(':id', $id);
        $success = $statement->execute();
        $this->dbConnector::outlog($statement->errorInfo());
        return $success;
    }
    public function deleteCompetence(int $id) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }
        $statement = $pdo->prepare('DELETE from competences where competence_id = :id');
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
