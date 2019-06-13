<?php declare(strict_types=1);

$GLOBALS["db_logpath"] = 'php.log';
$GLOBALS["bEchoLogs"] = false;
$GLOBALS["bEnableLogging"] = true;
$GLOBALS["bWriteLogs"] = true;

class DbConnector
{
    /**
     * @throws \Exception
     */
    public function getConnection()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ';charset=utf8';
        try {
            $pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
        } catch (\PDOException $exception) {
            throw new \Exception("No connection to database");
        }
        $this::outlog("Connected to Database with connstring: $dsn");
        return $pdo;
    }

    public function execStatement($statement) : array
    {
        $statement->execute();
        $this::outlog("ErrorInfo: " . $statement->errorInfo());

        return $statement->fetchAll(2); // FETCH_ASSOC
    }

    static function outlog($e)
    {
        $calling_func = str_pad(debug_backtrace()[1]['function'], 20, " ");
        if ($GLOBALS["bEnableLogging"])
        {
            $logmsg =  date('Y-m-d H:i:s') . " [$calling_func] $e";
            if ($GLOBALS["bEchoLogs"])
            {
                echo "<br>" .$logmsg;
            }
            if ($GLOBALS["bWriteLogs"])
            {
                file_put_contents($GLOBALS["db_logpath"], $logmsg . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        }
    }
}
