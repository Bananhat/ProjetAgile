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
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);
            return false;
        }

        $statement = $pdo->prepare('UPDATE user set role = :userrole where id = :userid');

        $statement->bindParam(':userrole', $newUserRole);
        $statement->bindParam(':userid', $userid);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");
        return $suc;
    }

    public function updateUserName($userid, $newfirstname, $newname) : bool
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

        $statement = $pdo->prepare('UPDATE user set FirstName = :firstname, Name = :username where id = :userid');

        $statement->bindParam(':firstname', $newfirstname);
        $statement->bindParam(':userid', $userid);
        $statement->bindParam(':username', $newname);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");
        return $suc;
    }

    public function deleteUser($userid) : bool
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

        $statement = $pdo->prepare('delete from user where id = :userid');

        $statement->bindParam(':userid', $userid);
        $suc = $statement->execute();
        $this->dbConnector::outlog(preg_replace( "/\r|\n/", "", $statement->queryString )  ." Successfull: $suc");
        return $suc;
    }
}
