<?php

class DatabaseHandle {

    private static $pdo;

    public function __construct($file = 'dbsettings.ini') {
        $ini = parse_ini_file($file);
        try {
            if(is_null(self::$pdo)) {
                self::$pdo = new PDO($ini['host'], $ini['username'], $ini['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        catch (PDOException $ex) {
            throw new Exception($ex->getMessage() . ' error info: '.  $ex->errorInfo);
        }
        return self::$pdo;
    }

    public function __destruct() {
        self::$pdo = null;
    }

    public function request($sql, $inputParams = array(), $fetchMode = 'fetchAll') {
        $statement = self::$pdo->prepare($sql);
        $statement->execute($inputParams);
        if ($fetchMode)
        $result = $statement->$fetchMode();
        return $result;
    }

    public function push($sql, $inputParams = array()) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($inputParams);
    }
}