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
    public $c;
    public $a;

    public function __construct($config,$env){
        $this->config = $config;
        $this->c = $_GET['c'];
        $this->a = $_GET['a'];
        $this->do();
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