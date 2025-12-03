<?php

namespace App\Services;

use App\Repository\OrderRepository;

class OrderService
{
    protected OrderRepository $repository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
    }

    public function getOrder($params = []): array
    {
        $result = [];
        $resp = $this->repository->getOrder($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;

    }

    public function paginateOrder($params = [], $where_condition = ""): array
    {
        $result = [];
        $resp = $this->repository->paginateOrder($params, $where_condition);
        if (!empty($resp['dataArray'])) {
            $result = [
                'result' => $resp['dataArray'],
                'pagination' => $this->repository->pagination
            ];
        }
        return $result;
    }

    public function createOrder($params = []): array
    {
        $result = [];
        $resp = $this->repository->createOrder($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }

    public function updateOrder($params = []): array
    {
        $result = [];
        $resp = $this->repository->updateOrder($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }


    public function getOrderProduct($params = []): array
    {
        $result = [];
        $resp = $this->repository->getOrderProduct($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;

    }

    public function createOrderProduct($params = []): array
    {
        $result = [];
        $resp = $this->repository->createOrderProduct($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }

    public function updateOrderProduct($params = []): array
    {
        $result = [];
        $resp = $this->repository->updateOrderProduct($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }


}