<?php

namespace App\API;

use App\Infrastructure\DataHandlers;
use App\Infrastructure\StringHelper;
use App\Services\OrderService;
use Random\RandomException;

class Orders
{
    protected $service;

    public function __construct()
    {
        $this->service = new OrderService();
    }

    public function getOrder($params = []): array
    {
        return $this->service->getOrder($params);
    }

    public function getOrderPagination($params = [], $where_condition = ""): array
    {
        return $this->service->paginateOrder($params, $where_condition);
    }

    /**
     * @throws RandomException
     */
    public function createOrder($params = []): array
    {
        $response = ['success' => false, 'response' => 400, 'message' => "Bad Request", 'errors' => []];
        if (!empty($params)) {
            $reference = $params['reference'];
            $getOrder = $this->service->getOrder(['reference' => $reference]);
            if (!empty($getOrder)) {
                $resp = ['success' => false, 'response' => 400, 'errors' => []];
                if (StringHelper::upper(StringHelper::trim($getOrder[0]['reference'])) === StringHelper::upper(StringHelper::trim($reference))) {
                    $resp['message'] = 'Order with reference <b>' . $reference . "</b> already exits";
                }
                return $resp;
            }
            $result = $this->service->createOrder($params);
            if ($result['response'] !== 200) {
                return ['success' => false, 'response' => $result['response'], 'message' => $result['message']];
            }
            return ['success' => true, 'response' => $result['response'], 'message' => $result['message']];
        }
        return $response;
    }

    public function updateOrder($params = []): array
    {
        return $this->service->updateOrder($params);
    }

    public function getOrderProduct($params = []): array
    {
        return $this->service->getOrderProduct($params);
    }

    public function getOrderProducts($params = []): array
    {

    }

    public function createOrderProduct($params = []): array
    {
        return $this->service->createOrderProduct($params);
    }

    public function updateOrderProduct($params = []): array
    {

    }

    public function deleteOrderProduct($params = []): array
    {

    }


}