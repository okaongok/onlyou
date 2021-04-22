<?php
namespace Onlyou;

use Onlyou\Formwork\Controller;

class App{
    const ENV_DEBUG = 'debug';

    static public function createApp($config,$env=self::ENV_DEBUG){
        return new WebApp($config,$env);
    }

    static function loader($name){
        
        include_once(APP_ROOT.'/onlyou/formwork/controller.php');
        if(strpos($name,'App') == 0){
            $name = str_replace('\\','/',$name);
            $names = pathinfo($name);
            $basename = strtolower($names['dirname']);
            $filename = $names['filename'];
            $path = APP_ROOT.'/'.$basename.'/'.$filename.'.php';
            if(file_exists($path)){
                include(APP_ROOT.'/'.$basename.'/'.$filename.'.php');
            }
            
        }
    }
}

spl_autoload_register([App::class,'loader']);

class  WebApp extends App{
    public $config;
    public $controller;
    public $action;
    public $parames;

    public function __construct($config,$env){
        $this->config = $config;
        $this->initRequest();
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