<?php

namespace App\API;

use App\Services\ProductsService;

class Products
{

    protected ProductsService $service;

    public function __construct()
    {
        $this->service = new ProductsService();
    }

    public function getCategory($params = []): array
    {
        return $this->service->getProductCategory($params);
    }

    public function getTrending($params = []): array
    {
        return $this->service->getTrendingProducts();
    }

    public function getCategoryShowcase($params = []): array
    {
        return $this->service->getCategoryShowcase();
    }

    public function getProduct($params = [], $orderBy = "", $limit = ""): array
    {
        return $this->service->getProduct($params, $orderBy, $limit);
    }

    public function getProductsPricing($params = []): array
    {
        return $this->service->getProductsPricing($params);
    }

    public function getProductsPagination($params = [], $where_condition = ""): array
    {
        return $this->service->paginateProducts($params, $where_condition);
    }

}