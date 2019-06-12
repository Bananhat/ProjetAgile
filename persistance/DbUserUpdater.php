<?php declare(strict_types=1);

require_once ("./../settings.php");
require_once ("DbConnector.php");

$dbConnector = new DbConnector();
$dbUserWriter = new DbUserUpdater($dbConnector);

var_dump($dbUserWriter->updateUserName(1, "Neubert", "test"));

class DbUserUpdater
{
    private $pdo;

    public function __construct(DbConnector $dbConnector)
    {
        $this->pdo = $dbConnector;
    }


    public function updateUserRole($userid, $newUserRole) : bool
    {
        try {
            $pdo = $this->pdo->getConnection();
        } catch (Exception $e) {
            return false;
        }

        $statement = $pdo->prepare('UPDATE USER set Role = :userrole where id = :userid');

        $statement->bindParam(':userrole', $newUserRole);
        $statement->bindParam(':userid', $userid);
        return $statement->execute();
    }

    public function updateUserName($userid, $newfirstname, $newname) : bool
    {
        try
        {
            $pdo = $this->pdo->getConnection();
        }
        catch(Exception $e)
        {
            return false;
        }

        $statement = $pdo->prepare('UPDATE USER set FirstName = :firstname, Name = :username where id = :userid');

        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);
        return $statement->execute();
    }

    public function deleteUserName($userid) : bool
    {
        try
        {
            $pdo = $this->pdo->getConnection();
        }
        catch(Exception $e)
        {
            return false;
        }

        $statement = $pdo->prepare('delete from USER where id = :userid');

        $statement->bindParam(':userid', $userid);
        return $statement->execute();
    }
}
