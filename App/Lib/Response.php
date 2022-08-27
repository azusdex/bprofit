<?php

namespace App\Lib;

class Response
{
    const HTTP_STATUS_SUCCESS = 200;
    const HTTP_STATUS_ERROR = 500;

    private int $status;

    public function status(int $code = self::HTTP_STATUS_SUCCESS) {
        $this->status = $code;

        return $this;
    }

    public function toJSON($data = []) {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}