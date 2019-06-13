<?php


class DbStudentWriter
{
<<<<<<< HEAD
=======

>>>>>>> 684dc74a316342a4c2c92446f5b9c009fbb65ac7
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

    public function updateStudentName($userid, $newfirstname, $newname) : bool
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();

        }
        catch(Exception $e)
        {
            return false;
        }

        $statement = $pdo->prepare('UPDATE student set firstName = :firstname, name = :username where id = :userid');

        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);

        return $statement->execute();
    }
}