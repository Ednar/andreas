<?php

include_once 'IConnectionManager.php';

class MySQLConnectionManager implements IConnectionManager {
    private $host = IConnectionManager::HOST;
    private $user = IConnectionManager::USER;
    private $passwd = IConnectionManager::PASSWD;
    private $pdo;

    private function connect() {
        try {
            if(is_null($this->pdo)) {
                $this->pdo = new PDO($this->host, $this->user, $this->passwd);
            }
            return $this->pdo;
        }
        catch (PDOException $ex) {
            throw new Exception($ex->getMessage() . ' error info: '.  $ex->errorInfo);
        }
    }

    private function disconnect() {
        $this->pdo = null;
    }

    public function request($sql, $inputParams = array(), $fetch) {
        $this->connect();
        $statement = $this->pdo->prepare($sql);
        $statement->execute($inputParams);
        $result = $statement->$fetch();
        $this->disconnect();
        return $result;
    }

    public function push($sql, $inputParams = array()) {
        $this->connect();
        $statement = $this->pdo->prepare($sql);
        $statement->execute($inputParams);
        $this->disconnect();
    }
}