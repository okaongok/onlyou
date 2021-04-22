<?php
namespace Onlyou;

use Onlyou\Framework\Controller;
use Onlyou\Framework\Model;

define('SYSTEM_ROOT',__DIR__);

class App{
    const ENV_DEBUG = 'debug';

    static public function init(string $env){
        if($env == self::ENV_DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors',1);
        }
    }

    static public function createApp($config,$env=self::ENV_DEBUG){
        self::init($env);
        return new WebApp($config);
    }

    static function loader(string $name){
        if(strpos($name,'Onlyou') === 0){
            $name = str_replace('\\','/',$name);
            $name = str_replace('Onlyou','',$name);
            $names = pathinfo($name);
            $basename = strtolower($names['dirname']);
            $filename = $names['filename'];
            $path = SYSTEM_ROOT.$basename.'/'.$filename.'.php';
            if(file_exists($path)){
                include_once(SYSTEM_ROOT.$basename.'/'.$filename.'.php');
            } 
        }elseif(strpos($name,'App') === 0){
            $name = str_replace('\\','/',$name);
            $name = str_replace('App/','',$name);
            $names = pathinfo($name);
            $basename = strtolower($names['dirname']);
            $filename = $names['filename'];
            $path = APP_ROOT.$basename.'/'.$filename.'.php';
            if(file_exists($path)){
                include_once(APP_ROOT.$basename.'/'.$filename.'.php');
            } 
        }
    }

    static public function mainerror(int $errno , string $errstr , string $errfile, int $errline){
        die($errstr);
    }
}

// set_error_handler([App::class,'mainerror']);
spl_autoload_register([App::class,'loader']);

class  WebApp extends App{
    public $config;
    public $controller;
    public $action;
    public $parames;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->initRequest();
        if(!empty($this->config['db'])){
            Model::setDbConnection($this->config['db']);
        }
        $this->do();
    }

    private function initRequest()
    {
        if(empty($_SERVER['PATH_INFO'])) 
            $path_arr = ['default','index'];
        else
            $path_arr = explode('/',ltrim($_SERVER['PATH_INFO'],'/'));

        if(count($path_arr) == 1 or $path_arr[1] == '') $path_arr[1] = 'index';

        list($this->c,$this->a) = $path_arr;
    }

    public function do(){
        $c = 'App\\Controller\\'.ucfirst($this->c).'Controller';
        $action = 'action'.ucfirst($this->a);

        if(!class_exists($c)){
            call_user_func([new Controller,'action404']);
        }elseif(!method_exists(new $c,$action)){
            call_user_func([new $c,'action404']);
        }else{
            call_user_func([new $c,$action]);
        }
    }
        
}