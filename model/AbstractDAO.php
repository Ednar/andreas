<?php

class AbstractDAO {

    protected $databaseManager;

    public function __construct($databaseManager) {
        try {
            $this->databaseManager = $databaseManager;
        } catch (InvalidDatabaseConnectionException $e) {
            echo $e->getMessage();
        }
    }


}

class InvalidDatabaseConnectionException extends Exception {

    public function __construct($message = null) {
        parent::$message = $message;
    }

}