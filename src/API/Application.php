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


}