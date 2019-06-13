<?php


class DbStudentWriter
{

    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewStudent($firstName,$name,$level) : bool
    {

        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {

            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `student`(`firstName`, `name`,`level`) VALUES (:firstName,:name,:level)');

        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':level', $level);

        $suc = $statement->execute();
        return $suc;
    }
}