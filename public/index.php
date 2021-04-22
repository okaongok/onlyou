<?php

define('WWW_ROOT',__DIR__);
define('APP_ROOT',__DIR__.'/../app/');

require_once(WWW_ROOT.'/../onlyou/App.php');

use Onlyou\App;

$config = [
    
];

App::createApp($config,App::ENV_DEBUG);