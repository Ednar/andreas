<?php

include_once 'IConnectToDatabase.php';
class DBConncetion implements IConnectToDatabase {
    private $host = IConnectToDatabase::HOST;
    private $user = IConnectToDatabase::USER;
    private $passwd = IConnectToDatabase::PASSWD;
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO($this->host, $this->user, $this->passwd);
        } catch (PDOException $e) {
            throw new Exception('Fel vid databasanslutning');
        }
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
            throw new Exception('Fel vid databasanslutning');
        }
    }
}
