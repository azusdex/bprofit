<?php

namespace App\Lib;

class Router
{
    public static function on($route, $callback) {
        $params = $_SERVER['REQUEST_URI'];
        $params = (strpos($params, "/") !== 0)
            ? "/" . $params
            : $params;
        $regex = str_replace("/", "\/", $route);
        $is_match = preg_match("/^" . ($regex) . "$/", $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            array_shift($matches);
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $callback(new Request($params), new Response());
        }
    }

    public static function get($route, $callback) {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback);
    }
}