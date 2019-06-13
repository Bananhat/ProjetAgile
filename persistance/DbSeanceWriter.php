<?php declare(strict_types=1);

class DbSeanceWriter
{
    private $dbConnector;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function writeNewSeance($student_id, $Date, $id_skill1, $id_skill2, $id_skill3) : bool
    {
        try {
            $pdo = $this->dbConnector->getConnection();
        } catch (Exception $e) {
            $this->dbConnector::outlog($e);

            return false;
        }

        $statement = $pdo->prepare('INSERT INTO `seance`(`student_id`,`date`, `id_skill1`, `id_skill2`, `id_skill3`)
            VALUES (:student_id,:date, :id1, :id2, :id3)');

        $statement->bindParam(':student_id', $student_id);
        $statement->bindParam(':date', $Date);
        $statement->bindParam(':id1', $id_skill1);
        $statement->bindParam(':id2', $id_skill2);
        $statement->bindParam(':id3', $id_skill3);

        $suc = $statement->execute();

        return $suc;
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