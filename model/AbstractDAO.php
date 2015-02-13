<?php

class AbstractDAO {

    protected $databaseHandle;

    public function __construct($databaseHandle) {
        try {
            $this->databaseHandle = $databaseHandle;
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