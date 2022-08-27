<?php


namespace App\Model;


use App\Lib\Connection;
use DateTime;
use Exception;
use PDO;

class Order extends Model
{
    protected array $fields = [
        'order_ID',
        'shop_ID',
        'closed_at',
        'created_at',
        'updated_at',
        'total_price',
        'subtotal_price',
        'total_weight',
        'total_tax',
        'currency',
        'financial_status',
        'total_discounts',
        'name',
        'processed_at',
        'fulfillment_status',
        'country',
        'province',
        'total_production_cost',
        'total_items',
        'total_order_shipping_cost',
        'total_order_handling_cost'
    ];

    public function getFields()
    {
        return $this->fields;
    }

    public function getNetSales()
    {
        $sql = 'SELECT SUM(total_price) AS total FROM orders WHERE financial_status = :status1 OR financial_status = :status2';

        try {
            $manager = (new Connection())->manager();
            $query = $manager->prepare($sql);
            $query->execute([
                'status1' => 'paid',
                'status2' => 'partial_paid'
            ]);
            $result = $query->fetchAll();

            return !empty($result[0]) ? $result[0]['total'] : 0;
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function getProductionCost()
    {
        $sql = 'SELECT SUM(total_production_cost) AS total FROM orders WHERE fulfillment_status = :fulfillment AND (financial_status = :status1 OR financial_status = :status2)';

        try {
            $manager = (new Connection())->manager();
            $query = $manager->prepare($sql);
            $query->execute([
                'fulfillment' => 'fulfilled',
                'status1' => 'paid',
                'status2' => 'partial_paid'
            ]);
            $result = $query->fetchAll();

            return !empty($result[0]) ? $result[0]['total'] : 0;
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}