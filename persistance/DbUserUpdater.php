<?php declare(strict_types=1);



class DbUserUpdater
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }


    public function updateUserRole($userid, $newUserRole) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
<<<<<<< HEAD
=======

>>>>>>> e38a4d9c86ac2dc011c68d820db32115110ed306
        } catch (Exception $e) {
            return false;
        }

        $statement = $pdo->prepare('UPDATE user set role = :userrole where id = :userid');

        $statement->bindParam(':userrole', $newUserRole);
        $statement->bindParam(':userid', $userid);
        return $statement->execute();
    }

    public function updateUserName($userid, $newfirstname, $newname) : bool
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        }
        catch(Exception $e)
        {
            return false;
        }

        $statement = $pdo->prepare('UPDATE user set FirstName = :firstname, Name = :username where id = :userid');

        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);
        return $statement->execute();
    }

    public function deleteUser($userid) : bool
    {
        try
        {
            $pdo = $this->dbConnector->getConnection();
        }
        catch(Exception $e)
        {
            return false;
        }

        $statement = $pdo->prepare('delete from user where id = :userid');

        $statement->bindParam(':userid', $userid);
        return $statement->execute();
    }
}
