<?php


namespace App\Model;

use App\Lib\Connection;
use DateTime;
use Exception;

class Model
{
    static public function getModel($table) {
        switch ($table) {
            case Order::class:
            default:
                return new Order();
        }
    }
}