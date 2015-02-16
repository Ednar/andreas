<?php

class DatabaseHandle {

    private static $pdo;


    /**
     * Sets up a connection to the database
     *
     * @param string $file optional database settings
     * @throws Exception
     */
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

    /**
     * Closes the database connection
     */
    public function __destruct() {
        self::$pdo = null;
    }

    /**
     * Takes an sql query and returns the result
     *
     * @param string $sql
     * @param array $inputParams
     * @param string $fetchMode optional fetch mode. Defaults to fetchAll.
     * @return mixed
     */
    public function request($sql, $inputParams = array(), $fetchMode = 'fetchAll') {
        $statement = self::$pdo->prepare($sql);
        $statement->execute($inputParams);
        if ($fetchMode)
        $result = $statement->$fetchMode();
        return $result;
    }

    /**
     * Takes and executes an sql query
     *
     * @param $sql
     * @param array $inputParams
     */
    public function push($sql, $inputParams = array()) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($inputParams);
    }
}