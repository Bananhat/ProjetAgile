<?php declare(strict_types=1);


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
}
