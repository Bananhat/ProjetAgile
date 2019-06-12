<?php

function getInstanceOfDb()
{

        $dsn = "mysql:host=" . DB_HOST. ";dbname=" . DB_NAME . ';charset=utf8';
        try {
            $pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
        } catch (\PDOException $exception) {
            throw new \Exception("No connection to database");
        }
        return $pdo;
}