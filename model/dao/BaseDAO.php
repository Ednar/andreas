<?php

class BaseDAO {

    protected static $pdo;

    public function __construct() {
        $ini = parse_ini_file('dbsettings.ini');
        try {
            if(is_null(self::$pdo)) {
                self::$pdo = new PDO($ini['host'], $ini['username'], $ini['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        catch (PDOException $ex) {
            throw new Exception($ex->getMessage() . ' error info: '.  $ex->errorInfo);
        }
    }

    public function __destruct() {
        self::$pdo = null;
    }
}