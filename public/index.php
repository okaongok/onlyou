<?php

define('WWW_ROOT',__DIR__);
define('APP_ROOT',__DIR__.'/../app/');

require_once(WWW_ROOT.'/../onlyou/App.php');

use Onlyou\App;

$config = [
    'db'=>[
        'dsn'=>'mysql:host=localhost:3306;dbname=leiphone',
        'user'=>'www',
        'pass'=>'root',
        'options'=>[
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
        ]
    ]
];

App::createApp($config,App::ENV_DEBUG);