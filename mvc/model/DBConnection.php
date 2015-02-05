<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Description of DBConnection
 *
 * @author noworries
 */
include_once 'IConnectDatabase.php';

class DBConnection implements IConnectDatabase {

    private static $server = IConnectDatabase::HOST;
    private static $user = IConnectDatabase::USER;
    private static $pass = IConnectDatabase::PASSWORD;
    private static $pdo;

    public static function connect() {
        try {
            if (self::$pdo == NULL) {
                self::$pdo = new PDO(self::$server, self::$user, self::$pass);
                return self::$pdo;
            } else {
                return self::$pdo;
            }
        } catch (PDOException $e) {
            throw Exception('Något gick med med databasanslutningen: ', $e->getMessage());
        }
    }

}
