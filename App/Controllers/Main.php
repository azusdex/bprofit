<?php

namespace App\Controllers;

use App\Lib\UploadData;
use App\Lib\Config;
use App\Model\Model;
use App\Model\Order;

class Main
{
    private Model $model;

    public function __construct()
    {
        $this->model = Model::getModel(Order::class);
    }

    public function netSales()
    {
        return ['Net Sales SUM' => number_format((float)$this->model->getNetSales(), 2)];
    }

    public function productionCost()
    {
        return ['Production Cost SUM' => number_format((float)$this->model->getProductionCost(), 2)];
    }

    public function grossProfit()
    {
        $profit = $this->model->getNetSales() - $this->model->getProductionCost();

        return ['Gross Profit' => number_format((float)$profit, 2)];
    }

    public function grossMargin()
    {
        $revenue = $this->model->getNetSales();
        $margin = ($revenue - $this->model->getProductionCost()) / ($revenue * 100);

        return ['Gross Margin' => $margin * 100 . '%'];
    }

    public function uploadData()
    {
        return (new UploadData(Config::get('BP_URL'), Config::get('BP_USER'), Config::get('BP_PASS')))->run();
    }

    public function index() {
        return 'Hello friend from BeProfit :)';
    }
}