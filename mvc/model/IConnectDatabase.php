<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author noworries
 */
interface IConnectDatabase {
    CONST HOST='mysql:host=localhost;dbname:andreas';
    CONST USER='andreas';
    CONST PASSWORD='andreas';
    public static function connect();
}
