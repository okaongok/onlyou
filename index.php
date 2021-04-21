<?php

require_once(__DIR__.'/onlyou/App.php');

use Onlyou\App;

define('APP_ROOT',__DIR__);

$config = [
    
];

App::createApp($config,'debug');