<?php declare(strict_types=1);

class DbSeanceWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewSeance($Date, $id_skill1, $id_skill2, $id_skill3) : bool
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

    public function updateSeanceName($id, $date, $id_skill1, $id_skill2, $id_skill3) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }

        $statement = $pdo->prepare('SELECT * FROM seance where id_seance = :id');
        $statement->bindParam(':id', $id);
        $attribut = $statement->execute();

        var_dump($attribut);

        if($id_skill1 == null)
        {
            $id_skill1 = $attribut['id_skill1'];
        }
        if($id_skill2 == null)
        {
            $id_skill2 = $attribut['id_skill2'];
        }
        if($id_skill3 == null)
        {
            $id_skill3 = $attribut['id_skill3'];
        }

        var_dump($id_skill1);
        var_dump($id_skill1);
        var_dump($id_skill1);

        $statement = $pdo->prepare('UPDATE seance set date = :date, id_skill1 = :id_skill1,id_skill2 = :id_skill2 ,id_skill3 = :id_skill3 where competence_id = :id');
        $statement->bindParam(':date', $date);
        $statement->bindParam(':id_skill1', $id_skill1);
        $statement->bindParam(':id_skill2', $id_skill2);
        $statement->bindParam(':id_skill3', $id_skill3);
        $statement->bindParam(':id', $id);

        $success = $statement->execute();
        $this->dbConnector::outlog($statement->errorInfo());
        return $success;
    }

    public function deleteSeance(int $id) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (\Exception $exception) {
            $this->dbConnector::outlog($exception);
        }
        $statement = $pdo->prepare('DELETE from seance where id_seance = :id');
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}