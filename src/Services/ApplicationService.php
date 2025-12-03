<?php

namespace App\Services;

use App\Repository\ApplicationRepository;

class ApplicationService
{
    protected ApplicationRepository $repository;

    public function __construct()
    {
        $this->repository = new ApplicationRepository();
    }

    public function getAppConfig($params = []): array
    {
        $result = [];
        $resp = $this->repository->getAppConfig($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getStoreConfig($params = []): array
    {
        $result = [];
        $resp = $this->repository->getStoreConfig($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getDeliveryOption($params = []): array
    {
        $result = [];
        $resp = $this->repository->getDeliveryOption($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getPaymentOption($params = []): array
    {
        $result = [];
        $resp = $this->repository->getPaymentOption($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }


}