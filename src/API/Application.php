<?php

namespace App\API;

use App\Services\ApplicationService;

class Application
{
    protected ApplicationService $service;

    public function __construct()
    {
        $this->service = new ApplicationService();
    }

    public function getConfig($params = []): array
    {
        return $this->service->getAppConfig($params);
    }


    public function getStore($params = []): array
    {
        return $this->service->getStoreConfig($params);
    }

    public function getDeliveryOption($params = []): array
    {
        return $this->service->getDeliveryOption($params);
    }

    public function getPaymentOption($params = []): array
    {
        return $this->service->getPaymentOption($params);
    }

}