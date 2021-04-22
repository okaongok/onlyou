<?php

namespace Onlyou\Framework;

use PDO;

class Model
{
    static public $db;
    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    /**
     * @param array $config
     * @return \PDO
     */
    static public function setDbConnection(array $config)
    {
        if(!(self::$db instanceof PDO)){
            self::$db = new PDO($config['dsn'],$config['user'],$config['pass'],$config['options']);
        }
    }

}