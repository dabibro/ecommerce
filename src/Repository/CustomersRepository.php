<?php

namespace App\Repository;

use App\DB\SQLQueryBuilder;

class CustomersRepository extends SQLQueryBuilder
{
    public function getCustomer($params = []): array
    {
        $query = $this->select()->from($this->customers)->where('delete_status=0');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        return $query->getQueryArray();
    }

    public function createCustomer($params = []): array
    {
        return $this->insert($this->customers, $params)->getQuery();

    }

    public function updateCustomer($params = []): array
    {
        return $this->update($this->customers, $params)->getQuery();

    }

    public function getShipping($params = []): array
    {
        $query = $this->select()->from($this->shipping_details)->where('1');
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $query->aand(" " . $param . " = '$value' ");
            }
        }
        $query->orderBy('created_on DESC');
        return $query->getQueryArray();
    }

    public function createShipping($params = []): array
    {
        return $this->insert($this->shipping_details, $params)->getQuery();

    }

    public function updateShipping($params = []): array
    {
        return $this->update($this->shipping_details, $params)->getQuery();

    }

}