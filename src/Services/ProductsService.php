<?php

namespace App\Services;

use App\Repository\ProductsRepository;

class ProductsService
{

    protected ProductsRepository $repository;

    public function __construct()
    {
        $this->repository = new ProductsRepository();
    }

    public function getProductCategory($params = []): array
    {
        $result = [];
        $resp = $this->repository->getProductCategory($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getTrendingProducts($params = []): array
    {
        $result = [];
        $resp = $this->repository->getTrendingProducts($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getCategoryShowcase($params = []): array
    {
        $result = [];
        $resp = $this->repository->getCategoryShowcase($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }

    public function getProduct($params = [], $orderBy = "", $limit = ""): array
    {
        $result = [];
        $resp = $this->repository->getProduct($params, $orderBy, $limit);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }


    public function getProductsPricing($params = []): array
    {
        $result = [];
        $resp = $this->repository->getProductsPricing($params);
        if (!empty($resp['dataArray'])) {
            $result = $resp['dataArray'];
        }
        return $result;
    }


    public function paginateProducts($params = [], $where_condition = ""): array
    {
        $result = [];
        $resp = $this->repository->paginateProducts($params, $where_condition);
        if (!empty($resp['dataArray'])) {
            $result = [
                'result' => $resp['dataArray'],
                'pagination' => $this->repository->pagination
            ];
        }
        return $result;
    }


}