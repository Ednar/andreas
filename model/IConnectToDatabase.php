<?php

/**
 *
 * @author noworries
 */
interface IConnectToDatabase {
    CONST HOST = 'mysql:host=localhost;dbname=andreas';
    CONST USER = 'andreas';
    CONST PASSWD = 'andreas';
    
    public function connect();
}
