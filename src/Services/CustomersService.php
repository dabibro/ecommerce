<?php

namespace App\Services;

use App\Repository\CustomersRepository;

class CustomersService
{
    public CustomersRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomersRepository();
    }

    public function getCustomer($params = []): array
    {
        $result = [];
        $resp = $this->repository->getCustomer($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;

    }

    public function createCustomer($params = []): array
    {
        $result = [];
        $resp = $this->repository->createCustomer($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }

    public function updateCustomer($params = []): array
    {
        $result = [];
        $resp = $this->repository->updateCustomer($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }


    public function getShipping($params = []): array
    {
        $result = [];
        $resp = $this->repository->getShipping($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;

    }

    public function createShipping($params = []): array
    {
        $result = [];
        $resp = $this->repository->createShipping($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }

    public function updateShipping($params = []): array
    {
        $result = [];
        $resp = $this->repository->updateShipping($params);
        if (!empty($resp)) {
            $result = $resp;
        }
        return $result;
    }

}