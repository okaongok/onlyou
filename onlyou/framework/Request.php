<?php
namespace Onlyou\Framework;

class Request{
    protected $query;
    protected $data;
    protected $raw_data;

    public function __construct()
    {
        $this->_query = $_GET;
        $this->_data = $_POST;
        $this->_raw_data = 'php://input';
    }

    public function query(string $key,string|int $default=null)
    {
        if(!isset($_GET[$key])) return $default;
        if($_GET[$key] === '') return $default;
        return $_GET[$key];
    }
}