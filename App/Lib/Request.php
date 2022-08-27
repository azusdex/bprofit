<?php

namespace App\Lib;

class Request
{
    public array $params;
    public string $req_method;
    public string $content_type;

    public function __construct($params = []) {
        $this->params = $params;
        $this->req_method = trim($_SERVER['REQUEST_METHOD']);
        $this->content_type = $_SERVER['CONTENT_TYPE'] ?? '';
    }
}