<?php

include_once 'IConnectionManager.php';

class MySQLConnectionManager implements IConnectionManager {
    private $host = IConnectionManager::HOST;
    private $user = IConnectionManager::USER;
    private $passwd = IConnectionManager::PASSWD;
    private $pdo;

    public function __construct() {
    }

    public function connect() {
        try {
            if(is_null($this->pdo)) {
                $this->pdo = new PDO($this->host, $this->user, $this->passwd);
                return $this->pdo;
            } else {
                return $this->pdo;
            }
        }
        catch (PDOException $ex) {
            throw new Exception($ex->getMessage() . ' error info: '.  $ex->errorInfo);
        }
    }

    public function disconnect()
    {
        $this->pdo = null;
    }
}
