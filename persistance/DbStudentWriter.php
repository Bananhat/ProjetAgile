<?php declare(strict_types=1);




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

        $statement = $pdo->prepare('INSERT INTO `student`(`name`, `firstName`,`level`) VALUES (:firstName,:name,:level)');

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
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('UPDATE student set firstName = :firstname, name = :username where id_student = :userid');
        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);

       // var_dump($pdo->errorInfo());
        $suc = $statement->execute();

        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }

    public function deleteStudent($userid) : bool
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        }
        catch(Exception $e)
        {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('delete from student where id_student = :userid');

        $statement->bindParam(':userid', $userid);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");
        return $suc;
    }
}