<?php


interface IConnectionManager {

    CONST HOST = 'mysql:host=localhost;dbname=andreas';
    CONST USER = 'andreas';
    CONST PASSWD = 'andreas';

    public function connect();
    public function disconnect();
}