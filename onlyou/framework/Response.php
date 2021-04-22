<?php
namespace Onlyou\Framework;

use Exception;

class Response{
    public function render($filename,$data)
    {
        $filename = str_replace('.','/',$filename);
        $filename = APP_ROOT.'view/'.$filename.'.php';
        if(!file_exists($filename)) throw new Exception(sprintf('template %s not found',$filename));

        foreach($data as $k=>$v){
            ${"{$k}"} = $v;
        }
        ob_start();
        include($filename);
        return ob_get_contents();
    }
}