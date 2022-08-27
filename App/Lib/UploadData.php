<?php

namespace App\Lib;


use App\Lib\Connection;
use App\Model\Order;
use Exception;

class UploadData
{
    private int $chunk_size = 100;
    private array $tempRow = [];
    private int $index = 0;
    private Connection $manager;
    private Order $model;
    private array $fields;
    private string $url;
    private string $user;
    private string $pass;

    public function __construct($url, $user, $password)
    {
        $this->url = $url;
        $this->user = $user;
        $this->pass = $password;
        $this->manager = new Connection();
        $this->model = new Order();
        $this->fields = $this->model->getFields();
    }

    public function run()
    {
        $this->manager = new Connection();
        $this->model = new Order();
        $this->fields = $this->model->getFields();

        try {
            $data = $this->getData();

            if ($data['success'] && $data['data']) {
                $this->read($data['data']);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function read($data)
    {
        foreach ($data as $order) {
            $this->tempRow[] = $order;

            if ($this->index % $this->chunk_size === 0) {
                $this->commit();
            }
        }

        $this->commit();
    }


    private function commit()
    {
        $this->manager->insertTo('orders', $this->tempRow);
        $this->tempRow = [];
    }

    public function getData()
    {
        if (empty($this->user) || empty($this->pass)) {
            throw new Exception("Upload data fail: Authorization fail, check credentials.");
        }

        $headers = [
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode("$this->user:$this->pass")
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        $return = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return json_decode($return, true);
    }

}