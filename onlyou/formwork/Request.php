<?php
namespace Onlyou\Formwork;

class Request{
    public $query;
    public $data;
    public $raw_data;

    public function __construct()
    {
        $this->query = $_GET;
        $this->data = $_POST;
        $this->raw_data = 'php://input';
    }
}