<?php
/**
 * Description of DBConncetion
 *
 * @author noworries
 */

include_once 'IConnectToDatabase.php';
class DBConncetion implements IConnectToDatabase {
    private static $host = IConnectToDatabase::HOST;
    private static $user = IConnectToDatabase::USER;
    private static $passwd = IConnectToDatabase::PASSWD;
    
    public static function connect() {
        try {
            if(is_null(self::PDO)) {
                self::$pdo = new PDO(self::$host, self::$user, self::$passwd);
                return self::$pdo;
            }
            else {
                return self::$pdo;
            }
        } catch (PDOException $ex) {
            throw new Exception('Fel vid databasanslutning: ', $ex->getMessage());
        }
        
    }

}
