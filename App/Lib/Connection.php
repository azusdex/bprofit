<?php

namespace App\Lib;

use App\Model\Model;
use App\Model\Order;
use Exception;
use PDO;
use PDOException;

class Connection
{
    private PDO $conn;

    private function getManager()
    {
        if (empty($this->conn)) {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $db_host = Config::get('DB_HOST');
            $db_name = Config::get('DB_DATABASE');
            $db_user = Config::get('DB_USER');
            $db_pass = Config::get('DB_PASS');

            try {
                $this->conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, $options);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die;
            } catch (Exception $e) {
                echo $e->getMessage();
                die;
            }
        }

        return $this->conn;
    }

    public function manager()
    {
        return $this->getManager();
    }

    public function insertTo($table, $params)
    {
        $model = Model::getModel($table);
        $fields = $model->getFields();
        $values = [];
        $column_titles = [];
        $question_marks = [];

        foreach ($fields as $column) {
            $column_titles[] = strtolower($column);
            $question_marks[] = ':' . strtolower($column);
        }

        foreach ($params as $row) {
            $values[] = $this->prepareValuesToInsert($fields, $row);
        }

        try {
            $this->getManager()->beginTransaction();
            $str_columns = implode(',', $column_titles);
            $sql = "INSERT IGNORE INTO $table ($str_columns) VALUES (" . implode(', ', $question_marks) . ")";

            $prepare = $this->getManager()->prepare($sql);
            foreach ($values as $value) {
                $prepare->execute($value);
            }

            $this->getManager()->commit();
        } catch (Exception $e) {
            $this->getManager()->rollBack();
            echo $e->getMessage();
            die;
        }
    }

    private function prepareValuesToInsert($fields, $values)
    {
        $str_value = [];
        foreach ($fields as $column) {
            $str_value[strtolower($column)] = $values[$column];
        }

        return $str_value;
    }
}