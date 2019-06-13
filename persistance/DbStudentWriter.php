<?php declare(strict_types=1);
/*
require_once("../settings.php");
require_once("DbConnector.php");

$db = new DbStudentWriter(new DbConnector());
//$db->writeNewStudent("test", "firstname", "lastname", 5);
$db->updateStudentName("test", "test", "name");
*/

class DbStudentWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewStudent($id, $firstName,$name,$level) : bool
    {

        try {
            $pdo = $this->dbConnector->getConnection();

        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `student`(`id_student`, `firstName`, `name`,`level`) VALUES (:id, :firstName,:name,:level)');

        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':level', $level);
        $statement->bindParam(':id', $id);

        $suc = $statement->execute();
        var_dump($statement->errorInfo());
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

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

        $statement = $pdo->prepare('UPDATE student set firstname = :firstname, name = :username where id_student = :userid');
        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);
        $suc =  $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");

        return $suc;
    }
}