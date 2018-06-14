<?php

namespace Core;

use App\Config;

class Database
{
    public static function getInstance() {

        if(!isset($pdo)) {
            $pdo = new \PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8', Config::DB_USER, Config::DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $pdo;
    }
}