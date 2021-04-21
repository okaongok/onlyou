<?php
namespace Onlyou\Formwork;

class Controller{
    public function action404()
    {
        header("HTTP/1.1 404 Not Found");
        echo '404';
    }
}