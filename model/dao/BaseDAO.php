<?php

/**
 * Class BaseDAO
 *
 * Handles the connections to the database.
 * It is recommended that any DAO class inherits from this base class to
 * gain automatic connection handling
 *
 */
class BaseDAO {

    /**
     * @var PDO
     */
    protected static $pdo;

    /**
     * Creates a connection to the database
     *
     * @throws PDOException thrown for any connection error
     */
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

    /**
     *  Closes the connection to the database
     */
    public function __destruct() {
        self::$pdo = null;
    }
}