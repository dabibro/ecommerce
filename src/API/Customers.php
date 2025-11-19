<?php

namespace App\API;

use App\Infrastructure\DataHandlers;
use App\Infrastructure\StringHelper;
use App\Services\CustomersService;
use Random\RandomException;

class Customers
{
    protected $service;

    public function __construct()
    {
        $this->service = new CustomersService();
    }

    /**
     * @throws RandomException
     */
    public function getCustomer($params = []): array
    {
        return $this->service->getCustomer($params);
    }

    /**
     * @throws RandomException
     */
    public function createCustomer($params = []): array
    {
        $response = ['success' => false, 'response' => 400, 'message' => "Bad Request", 'errors' => []];
        if (!empty($params)) {
            $email = $params['email'];
            $getCustomer = $this->service->getCustomer(['email' => $email]);
            if (!empty($getCustomer)) {
                $resp = ['success' => false, 'response' => 400, 'errors' => []];
                if (StringHelper::upper(StringHelper::trim($getCustomer[0]['email'])) === StringHelper::upper(StringHelper::trim($email))) {
                    $resp['message'] = 'Email address <b>' . $email . "</b> has been taken";
                }
                return $resp;
            }
            $params['customer_id'] = DataHandlers::generate_random_string(10, '01234567899876543210');
            $result = $this->service->createCustomer($params);
            if ($result['response'] !== 200) {
                return ['success' => false, 'response' => $result['response'], 'message' => $result['message']];
            }
            return ['success' => true, 'response' => $result['response'], 'message' => $result['message']];
        }

        return $response;
    }

    public function updateCustomer($params = []): array
    {
        return $this->service->updateCustomer($params);
    }


}