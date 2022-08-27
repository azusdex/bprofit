<?php


namespace App\Lib;


class Migration
{
    public static function insertTables()
    {
        $table = "CREATE TABLE IF NOT EXISTS `orders` (
                `id` bigint(8) unsigned NOT NULL AUTO_INCREMENT,
                `order_id` bigint(8) NOT NULL UNIQUE,
                `shop_id` bigint(8) NOT NULL,
                `closed_at` timestamp NULL,
                `created_at` timestamp NULL,
                `updated_at` timestamp NULL,
                `total_price` decimal (6, 2) DEFAULT 0,
                `subtotal_price` decimal (6, 2) DEFAULT 0,
                `total_weight` int(10) DEFAULT 0,
                `total_tax` int DEFAULT 0,
                `currency` varchar (10),
                `financial_status` varchar (50) NULL,
                `total_discounts` int(2) DEFAULT 0,
                `name` varchar (255) NULL,
                `processed_at` timestamp NULL DEFAULT NULL,
                `fulfillment_status` varchar (50) NULL,
                `country` varchar (10) NULL,
                `province` varchar (10) NULL,
                `total_production_cost` int DEFAULT 0,
                `total_items` int NULL DEFAULT 0,
                `total_order_shipping_cost` decimal (6, 2) DEFAULT 0,
                `total_order_handling_cost` decimal (6, 2) DEFAULT 0,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        $db = new Connection();
        try {
            $result = $db->manager()->exec($table);
            if ($result !== false) {
                echo "Database updated.";
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}