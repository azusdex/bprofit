<?php

require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controllers\Main;

/**
 * Net sales
 */
Router::get('/sales', function (Request $request, Response $response) {
    $result = (new Main())->netSales();

    $status = empty($result) ? Response::HTTP_STATUS_ERROR : Response::HTTP_STATUS_SUCCESS;
    $response->status($status)->toJSON($result);
});

/**
 * Product costs
 */
Router::get('/costs', function (Request $request, Response $response) {
    $result = (new Main())->productionCost();

    $status = empty($result) ? Response::HTTP_STATUS_ERROR : Response::HTTP_STATUS_SUCCESS;
    $response->status($status)->toJSON($result);
});

/**
 * Gross profit
 */
Router::get('/profit', function (Request $request, Response $response) {
    $result = (new Main())->grossProfit();

    $status = empty($result) ? Response::HTTP_STATUS_ERROR : Response::HTTP_STATUS_SUCCESS;
    $response->status($status)->toJSON($result);
});

/**
 * Gross margin
 */
Router::get('/margin', function (Request $request, Response $response) {
    $result = (new Main())->grossMargin();

    $status = empty($result) ? Response::HTTP_STATUS_ERROR : Response::HTTP_STATUS_SUCCESS;
    $response->status($status)->toJSON($result);
});

/**
 * Upload data from external service
 */
Router::get('/upload', function (Request $request, Response $response) {
    $result = (new Main())->uploadData();
    $status = empty($result) ? Response::HTTP_STATUS_ERROR : Response::HTTP_STATUS_SUCCESS;

    $response->status($status)->toJSON($result);
});

/**
 * Its works!
 */
Router::get('/', function(Request $request, Response $response) {
    $result = (new Main())->index();

    $response->status(Response::HTTP_STATUS_SUCCESS)->toJSON($result);
});

App::run();