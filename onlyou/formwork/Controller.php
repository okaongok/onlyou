<?php
namespace Onlyou\Formwork;

class Controller{
    public $request;
    public $response;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
    }

    public function render($filename,$data=[])
    {
        $this->response->render($filename,$data);
    }

    public function action404()
    {
        header("HTTP/1.1 404 Not Found");
        echo '404';
    }
}